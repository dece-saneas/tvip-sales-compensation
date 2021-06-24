<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Hash;
use App\Models\User;

class SettingsController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index
    public function index()
    {
        return view('pages.settings');
    }

    // Update
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        $this->validate($request,[
            'email' => 'required',
        ]);
        
		$user->email = $request->email;
		$user->save();
        
        if(!empty($request['password'])){
             $this->validate($request,[
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            
            $user->password = Hash::make($request['password']);
            $user->save();
        }
        
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
