<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
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
        $roles = $query->orderBy('id','DESC')->paginate(5);
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

        // if (empty($request->permission)) {
        //     return redirect()->back()->withErrors(['permission' => 'At least one permission is required.'])->withInput();
        // }

        $role = Role::create([
            'name' => $request->name,
        ]);

        if (!empty($request->permission))
        {
            foreach ($request->permission as $name){
                $role->givePermissionTo($name);
            }
        }
        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    public function show($id): View
    {
        $role = Role::findOrFail($id);
        return view('roles.show',compact('role'));
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
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id.',id'
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        if (!empty($request->permission))
        {
            $role->syncPermissions($request->permission);
        } else {
            $role->syncPermissions([]);
        }
        return redirect()->route('roles.index')->with('warning', 'Role updated successfully!');
    }

    public function destroy($id)
    {
        Role::find($id)->delete();
        return redirect()->route('roles.index')
            ->with('danger', 'Role deleted successfully');
    }
}
