<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Permission::query();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
    
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }
        $permissions = $query->orderBy('id','DESC')->paginate(5);
        return view('permissions.index',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return(view('permissions.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|unique:permissions,name',
        ]);
    
        foreach ($request->name as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $permission = permission::findOrFail($id); // Ambil data permission
        
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$id.',id'
        ]);

        $permission->update([
            'name' => $request->name,
        ]);
        return redirect()->route('permissions.index')->with('warning', 'Permission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->route('permissions.index')
            ->with('danger', 'Permission deleted successfully');
    }
}
