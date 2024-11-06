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
        $roles = $query->orderBy('uuid','DESC')->paginate(10);
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
        // Cari role berdasarkan UUID, bukan ID
        $role = Role::where('uuid', $uuid)->firstOrFail();
        dd(Role::with('permissions')->get());
        return view('roles.show', compact('role'));
        // $role = Role::where('uuid', $uuid)->with('permissions')->firstOrFail();
        // return view('roles.show', compact('role'));
    }

    public function edit($id): View
    {
        $role = Role::findOrFail($id);
        $permission = Permission::get();
        $hasPermissions = $role->permissions->pluck('name');
        
        return view('roles.edit', compact('role','permission','hasPermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id . ',id',
        ]);

        // Cek apakah ada perubahan pada 'name' atau 'permission'
        $nameChanged = $role->name !== $request->name;
        $permissionsChanged = !empty($request->permission) 
            ? $role->permissions->pluck('name')->sort()->values()->toArray() !== collect($request->permission)->sort()->values()->toArray()
            : $role->permissions->isNotEmpty();

        // Jika tidak ada perubahan, kembali ke halaman edit dengan pesan
        if (!$nameChanged && !$permissionsChanged) {
            return redirect()->route('roles.edit', $id)
                ->with('info', 'No changes were made to the role.');
        }
        // Update 'name' jika berubah
        if ($nameChanged) {
            $role->update([
                'name' => $request->name,
            ]);
        }
        // Sinkronisasi permissions jika berubah
        if ($permissionsChanged) {
            $role->syncPermissions($request->permission ?? []);
        }

        // Jika ada perubahan, kembali ke index dengan pesan sukses
        return redirect()->route('roles.index')->with('warning', 'Role updated successfully!');
    }


    public function destroy($id)
    {
        Role::find($id)->delete();
        return redirect()->route('roles.index')
            ->with('danger', 'Role deleted successfully');
    }
}
