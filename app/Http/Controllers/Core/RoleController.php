<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware(['role:Super Admin','auth']);
    }
    
    // Index
    public function index()
    {
        $roles = Role::orderBy('name', 'asc')->paginate(10);
        
        return view('core.role', ['roles' => $roles]);
    }

    // Create
    public function create()
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
        
        return view('core.role-create', ['permissions' => $permissions]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
        ]);
        
        $role = Role::create([
            'name' => $request['name']
        ]);
        
        $role->syncPermissions($request['permission']);
        
        return redirect()->route('core.roles.index');
    }

    // Edit
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::orderBy('name', 'asc')->get();
        
        return view('core.role-edit', ['role' => $role, 'permissions' => $permissions]);
    }
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions($request['permission']);
        
        $this->validate($request,[
            'name' => ['required'],
        ]); 
        
        $role->name = $request->name;
		$role->save();
    

        return redirect()->route('core.roles.index');
    }

    // Delete
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('core.roles.index');
    }
}
