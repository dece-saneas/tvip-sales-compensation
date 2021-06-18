<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Hash;
use App\Models\User;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.settings');
    }

    /**
     * Update profile.
     *
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        // change email
        $this->validate($request,[
            'email' => 'required',
        ]);
        
		$user->email = $request->email;
		$user->save();
        
        // change password
        if(!empty($request->password)){
             $this->change_password($request);
        }
        
        // change photo
        if($request->hasFile('photo')){
            
            $this->validate($request,[
                'photo' => 'file|image|mimes:jpeg,png|max:2048',
            ]);
            
            $photo = $request->file('photo');
            $photo_filename =  time().'.'.$photo->getClientOriginalExtension();
            
            if(!empty($user->photo)) {
                $photo_filename = $user->photo;
            }
            
            $user->photo = $photo_filename;
            $user->save();
            
            Image::make($photo)->resize(160, 160)->save(public_path('img/users/'.$photo_filename));
        }
        
        session()->flash('success', 'Profile berhasil di ubah !');
        return redirect()->back();
    }
}
