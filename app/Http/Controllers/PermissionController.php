<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
        $permissions = $query->orderBy('created_at','DESC')->paginate(10);
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
            'name.*' => 'nullable|string|unique:permissions,name',
        ]);

        if (empty(array_filter($request->name))) {
            return redirect()->back()
                ->withErrors(['name' => 'At least one permission name is required.'])
                ->withInput();
        }
        
        foreach ($request->name as $permissionName) {
            if (!empty($permissionName)) {
                Permission::create(['uuid' => Str::uuid()->toString(),'name' => $permissionName]);
            }
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
    public function edit($uuid): View
    {
        $permission = Permission::where('uuid', $uuid)->firstOrFail(); // Ambil data permission
        
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $permission = Permission::where('uuid', $uuid)->firstOrFail();
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $uuid . ',uuid',
        ]);

        $input = $request->only('name');
        $changes = array_diff_assoc($input, $permission->only('name'));

        if (empty($changes)) {
            return redirect()->route('permissions.edit', $uuid)
                ->with('info', 'No changes were made to the permission.');
        }
        
        DB::table('permissions')->where('uuid', $uuid)->update($input);

        return redirect()->route('permissions.index')->with('warning', 'Permission updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        DB::table('permissions')->where('uuid', $uuid)->delete();
        return redirect()->route('permissions.index')
            ->with('danger', 'Permission deleted successfully');
    }
}
