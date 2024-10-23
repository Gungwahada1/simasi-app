<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
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

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        // Mengambil daftar roles
        $roles = Role::pluck('name', 'name')->all();

        // Hanya mengirimkan roles, tidak perlu mengirim user
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        // Menyimpan input dan mengenkripsi password
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        // Membuat user baru
        $user = User::create($input);
        
        // Menetapkan role untuk user
        $user->assignRole($request->input('roles'));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified user.
     */
    public function show($id): View
    {
        // Menemukan user berdasarkan ID atau gagal dengan 404
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id): View
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        // Mengambil roles yang dimiliki user
        $userRole = $user->roles->pluck('name', 'name')->all();

        // Mengirimkan user, roles, dan userRole ke view
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified user in the database.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input, khusus email diabaikan jika sama dengan data user saat ini
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        // Menyimpan input
        $input = $request->all();

        // Jika password diisi, hash dan simpan, jika tidak, hilangkan dari input
        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->input('password'));
        } else {
            $input = Arr::except($input, ['password']);
        }

        // Menemukan user dan mengupdate data
        $user = User::findOrFail($id);
        $user->update($input);

        // Sinkronisasi roles untuk user
        $user->syncRoles($request->input('roles'));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified user from the database.
     */
    public function destroy($id): RedirectResponse
    {
        // Menemukan user dan menghapus data
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
