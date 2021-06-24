<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth, Hash;
use App\Models\User;

class UsersController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index
    public function index()
    { if (Auth::user()->cannot('user-read')) abort(403);
     
        $users = User::orderBy('name', 'ASC')->paginate(20);
     
        if(Auth::user()->hasRole('Admin CRO')) {
            $users = User::role('Customer')->orderBy('name', 'ASC')->paginate(20);
        }
     
        return view('pages.users', ['users' => $users]);
    }
    
    // Create
    public function create()
    { if (Auth::user()->cannot('user-create')) abort(403);
        $roles = Role::orderBy('name', 'asc')->get();
     
        return view('pages.users-create', ['roles' => $roles]);
    }
    public function store(Request $request)
    { if (Auth::user()->cannot('user-create')) abort(403);
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
        
        session()->flash('success', 'User berhasil di tambahkan !');
     
        return redirect()->route('users.index');
    }
    
    // Edit
    public function edit($id)
    { if (Auth::user()->cannot('user-update')) abort(403);
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'asc')->get();

        if($user->id == 1) abort(404);
        if($user->id == Auth::user()->id) abort(404);
           
        if(Auth::user()->hasRole('Admin CRO')) {
            if($user->hasRole(['Super Admin', 'Manager', 'Admin Gudang', 'Admin CRO'])) {
                abort(404);
            }
        }
        
        return view('pages.users-edit', ['user' => $user, 'roles' => $roles]);
    }
    public function update(Request $request, $id)
    { if (Auth::user()->cannot('user-update')) abort(403);
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
        
        session()->flash('success', 'Data user berhasil di perbarui !');
     
        return redirect()->route('users.index');
    }
    
    // Delete
    public function destroy($id)
    { if (Auth::user()->cannot('user-delete')) abort(403);
        $user = User::findOrFail($id);
     
        $user->delete();
        
		session()->flash('success', 'User berhasil di hapus !');
		
        return redirect()->route('users.index');
    }
    
    
}
