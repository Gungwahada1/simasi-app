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

        $query = DB::table('users')->whereNull('deleted_at');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
    
            $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('status_user', 'like', '%' . $searchTerm . '%');
        }
        $data = $query->paginate(10);

        return view('users.index', ['data' => $data])
            ->with('i', ($request->input('page', 1) - 1) * 10);
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
        if ($request->status_user == 'Pegawai Tetap') {
            $user_code = "TCH";
        } elseif ($request->status_user == 'Paruh Waktu') {
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
            'status_user' => $request->status_user,
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
        dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'status_user' => 'required|in:Magang,Paruh Waktu,Pegawai Tetap',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $user = User::findOrFail($id);

        // Buat user_code baru berdasarkan status_user
        if ($request->status_user == 'Pegawai Tetap') {
            $user_code = "TCH";
        } elseif ($request->status_user == 'Paruh Waktu') {
            $user_code = "FRL";
        } else {
            $user_code = "MGG";
        }

        // Periksa jika ada perubahan data
        $hasChanges = (
            $user->name !== $request->name ||
            $user->email !== $request->email ||
            $user->first_name !== $request->first_name ||
            $user->last_name !== $request->last_name ||
            $user->status_user !== $request->status_user ||
            !$user->hasRole($request->status_user)
        );

        if (!$hasChanges) {
            // Tidak ada perubahan, kembali ke edit dengan pesan
            return redirect()->route('users.edit', $user->id)
                ->with('info', 'No changes were made to the user.');
        }

        // Update data hanya jika ada perubahan
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'status_user' => $request->status_user,
            'user_code' => $user_code . rand(0, 999), // Atur ulang hanya jika status_user berubah
            'updated_at' => Carbon::now(),
        ]);

        // Update role user
        $user->syncRoles($request->status_user);

        return redirect()->route('users.index')
            ->with('warning', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('danger', 'User deleted successfully');
    }
}
