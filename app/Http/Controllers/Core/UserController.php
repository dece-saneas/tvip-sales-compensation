<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware(['role:Super Admin','auth']);
    }
    
    // Index
    public function index()
    {
        $users = User::orderBy('name', 'asc')->paginate(10);
        
        return view('core.user', ['users' => $users]);
    }

    // Create
    public function create()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        
        return view('core.user-create', ['roles' => $roles]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        
        $user->assignRole($request['role']);
        
        return redirect()->route('core.users.index');
    }

    // Edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'asc')->get();
        
        return view('core.user-edit', ['user' => $user, 'roles' => $roles]);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required'],
        ]);
        
        if(!empty($request['password'])) {
            $this->validate($request,[
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            
            $user->password = Hash::make($request['password']);
            $user->save();
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
		$user->save();
        
        $user->syncRoles([$request->role]);

        return redirect()->route('core.users.index');
    }

    // Delete
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('core.users.index');
    }
}
