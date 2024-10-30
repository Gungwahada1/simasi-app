<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Events\Registered;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = DB::table('users');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
    
            $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('status_user', 'like', '%' . $searchTerm . '%');
        }
        $data = $query->paginate(5);

        return view('users.index', ['data' => $data])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'status_user' => 'required|in:Magang,Paruh Waktu,Pegawai Tetap'
        ]);
        if ($request->user_status == 'Pegawai Tetap') {
            $user_code = "TCH";
        } elseif ($request->user_status == 'Paruh Waktu') {
            $user_code = "FRL";
        } else{
            $user_code = "MGG";
        }
    
        $user = User::create([
            'id' => Str::uuid()->toString(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_code' => strval($user_code . rand(0, 999)),
            'first_name' => $request->name,
            'last_name' => $request->name,
            'username' => $request->name,
            'nip' => '',
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'created_by' => null,
            'updated_at' => Carbon::now(),
            'updated_by' => null,
            'deleted_at' => null,
            'deleted_by' => null,
        ]);
        // Assign the role based on the status_user field
        $user->assignRole($request->status_user);
    
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id): View
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    public function edit($id): View
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRole = $user->roles->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
