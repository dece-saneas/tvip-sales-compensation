<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Image, File;
use App\Models\Product;
use App\Models\Reward;

class RewardsController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Create
    public function create()
    { if (Auth::user()->cannot('reward-create')) abort(403);
        $products = Product::orderBy('brand', 'ASC')->get();
     
        if(count($products) == 0) {
            session()->flash('info', 'Belum ada Produk untuk di tambah stock !');
            return redirect()->route('products.index');
        }
        
        return view('pages.rewards-create', ['products' => $products]);
    }
    public function store(Request $request)
    { if (Auth::user()->cannot('reward-create')) abort(403);
        
        $this->validate($request,[
            'photo' => 'file|image|mimes:jpeg,png|max:2048',
            'title' => 'required',
            'product' => 'required',
            'target' => 'required',
            'period' => 'required',
        ]);
     
        $photo = $request->file('photo');
        $photo_filename =  time().'.'.$photo->getClientOriginalExtension();
        
        $period = (explode(" / ",$request->period));
     
        $reward = Reward::create([
            'photo' => $photo_filename,
            'title' => $request['title'],
            'product_id' => $request['product'],
            'target' => $request['target'],
            'period_start' => $period[0],
            'period_end' => $period[1],
        ]);
     
        Image::make($photo)->resize(1024, 512)->save(public_path('img/rewards/'.$photo_filename));
     
        session()->flash('success', 'Reward berhasil di buat !');
        
        return redirect()->route('dashboard');
    }

    // Edit
    public function edit($id)
    { if (Auth::user()->cannot('reward-update')) abort(403);
        $products = Product::orderBy('brand', 'ASC')->get();
        $reward = Reward::findOrFail($id);
        
        return view('pages.rewards-edit', ['reward' => $reward, 'products' => $products]);
    }
    public function update(Request $request, $id)
    { if (Auth::user()->cannot('reward-update')) abort(403);
        $products = Product::orderBy('brand', 'ASC')->get();
        $reward = Reward::findOrFail($id);
     
        $this->validate($request,[
            'title' => 'required',
            'product' => 'required',
            'target' => 'required',
            'period' => 'required',
        ]);
     
        if($request->hasFile('photo')){
            
            $this->validate($request,[
                'photo' => 'file|image|mimes:jpeg,png|max:2048',
            ]);
            
            $photo = $request->file('photo');
            Image::make($photo)->resize(1024, 512)->save(public_path('img/rewards/'.$reward->photo));
        }
     
        $period = (explode(" / ",$request->period));
     
        $reward->title =  $request->title;
        $reward->product_id =  $request->product;
        $reward->target =  $request->target;
        $reward->period_start =  $period[0];
        $reward->period_end =  $period[1];
        $reward->save();
        
		session()->flash('success', 'Reward berhasil di perbarui !');
		
        return redirect()->route('dashboard');
    }

    // Delete
    public function destroy($id)
    { if (Auth::user()->cannot('reward-delete')) abort(403);
        $reward = Reward::findOrFail($id);
		
		if(File::exists('img/rewards/'.$reward->photo)) {
			File::delete('img/rewards/'.$reward->photo);
		}

        $reward->delete();
        
		session()->flash('success', 'Reward berhasil di hapus !');
		
        return redirect()->route('dashboard');
    }
}
