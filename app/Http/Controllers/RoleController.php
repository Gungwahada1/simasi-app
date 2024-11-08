<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
    //     $this->middleware('permission:role-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }

    public function index(Request $request): View
    {
        $query = Role::query();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
    
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }
        $roles = $query->orderBy('created_at','DESC')->paginate(10);
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        // Buat Role baru dengan UUID
        $role = Role::create([
            'uuid' => Str::uuid()->toString(),
            'name' => $request->name,
        ]);

        // Cek apakah ada permissions yang dipilih
        if (!empty($request->permission)) {
            foreach ($request->permission as $permissionUuid) {
                // Cari permission berdasarkan UUID
                $permission = Permission::where('uuid', $permissionUuid)->first();

                if ($permission) {
                    // Masukkan data langsung ke tabel role_has_permissions
                    DB::table('role_has_permissions')->insert([
                        'permission_id' => $permission->uuid,
                        'role_id' => $role->uuid
                    ]);
                }
            }
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    public function show($uuid): View
    {
        // Mengambil role dan permissions-nya menggunakan query builder
        $role = DB::table('roles')->where('roles.uuid', $uuid)->first();

        $permissions = DB::table('permissions')
            ->join('role_has_permissions', 'permissions.uuid', '=', 'role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id', $role->uuid)
            ->select('permissions.name')
            ->get();

        // Mengonversi hasil ke bentuk yang sesuai untuk tampilan
        $role = (object) array_merge((array) $role, ['permissions' => $permissions]);

        return view('roles.show', compact('role'));
    }

    public function edit($uuid): View
    {
        // Ambil role berdasarkan uuid
        $role = DB::table('roles')->where('uuid', $uuid)->first();
        // Ambil semua permissions
        $permission = DB::table('permissions')->get();
        // Ambil permissions yang dimiliki oleh role tertentu
        $hasPermissions = DB::table('permissions')
            ->join('role_has_permissions', 'permissions.uuid', '=', 'role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id', $role->uuid)
            ->pluck('permissions.name'); // pluck nama permission untuk mengecek centang

        // Ubah $role menjadi objek dan tambahkan hasPermissions ke dalamnya untuk konsistensi
        $role = (object) array_merge((array) $role, ['permissions' => $hasPermissions]);

        return view('roles.edit', compact('role', 'permission', 'hasPermissions'));
    }

    public function update(Request $request, $uuid)
    {
        $role = DB::table('roles')->where('uuid', $uuid)->first();
        // Validasi input
        $request->validate([
            'name' => 'required|unique:roles,name,' . $uuid . ',uuid',
        ]);

        // Cek apakah ada perubahan pada 'name' atau 'permission'
        $nameChanged = $role->name !== $request->name;
        $currentPermissions = DB::table('permissions')
            ->join('role_has_permissions', 'permissions.uuid', '=', 'role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id', $role->uuid)
            ->pluck('permissions.uuid')
            ->sort()
            ->values()
            ->toArray();
        $newPermissions = DB::table('permissions')
            ->whereIn('uuid', $request->permission ?? [])
            ->pluck('uuid')
            ->sort()
            ->values()
            ->toArray();
        $permissionsChanged = $currentPermissions !== $newPermissions;
    
        // Jika tidak ada perubahan, kembali ke halaman edit dengan pesan
        if (!$nameChanged && !$permissionsChanged) {
            return redirect()->route('roles.edit', $uuid)
                ->with('info', 'No changes were made to the role.');
        }
        // Update 'name' jika ada perubahan
        if ($nameChanged) {
            DB::table('roles')
                ->where('uuid', $uuid)
                ->update(['name' => $request->name]);
        }
        // Sinkronisasi permissions jika ada perubahan
        if ($permissionsChanged) {
            // Hapus permissions lama
            DB::table('role_has_permissions')
                ->where('role_id', $role->uuid)
                ->delete();
    
            // Tambahkan permissions baru
            $rolePermissions = array_map(function ($permissionId) use ($role) {
                return [
                    'role_id' => $role->uuid,
                    'permission_id' => $permissionId,
                ];
            }, $newPermissions);
    
            DB::table('role_has_permissions')->insert($rolePermissions);
        }

        // Jika ada perubahan, kembali ke index dengan pesan sukses
        return redirect()->route('roles.index')->with('warning', 'Role updated successfully!');
    }


    public function destroy($uuid)
    {
        DB::table('roles')->where('uuid', $uuid)->delete();
        return redirect()->route('roles.index')
            ->with('danger', 'Role deleted successfully');
    }
}
