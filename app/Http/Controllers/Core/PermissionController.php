<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware(['role:Super Admin','auth']);
    }
    
    // Index
    public function index()
    {
        $permissions = Permission::orderBy('name', 'asc')->paginate(10);
        
        return view('core.permission', ['permissions' => $permissions]);
    }

    // Create
    public function create()
    {
        return view('core.permission-create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
        ]);
        
        Permission::create([
            'name' => $request['name']
        ]);
        
        return redirect()->route('core.permissions.index');
    }

    // Edit
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        
        return view('core.permission-edit', ['permission' => $permission]);
    }
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        
        $this->validate($request,[
            'name' => ['required'],
        ]); 
        
        $permission->name = $request->name;
		$permission->save();

        return redirect()->route('core.permissions.index');
    }

    // Delete
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        
        return redirect()->route('core.permissions.index');
    }
}
