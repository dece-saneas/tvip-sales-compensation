<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image, Auth, File;
use App\Models\Product;

class ProductsController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Index
    public function index(Request $request)
    { if (Auth::user()->cannot('view product')) abort(403);
        
        $filter = Product::query();
		
		if(!empty(request()->all())) {
			$request = request()->all();
			
			if(count($request['brand']) == 4) return redirect()->route('products.index');
			
			if(!empty($request['brand'])){
				$filter->whereIn('brand',$request['brand']);
			}
		}
        
        $products = $filter->get();
        
        return view('pages.products', ['products' => $products]);
    }

    // Create
    public function create()
    { if (Auth::user()->cannot('create product')) abort(403);
        
        return view('pages.products-create');
    }
    public function store(Request $request)
    { if (Auth::user()->cannot('create product')) abort(403);
        
        $this->validate($request,[
            'brand' => 'required',
            'variant' => 'required',
            'price' => 'required',
            'photo' => 'required|file|image|mimes:jpeg,png|max:2048',
        ]);
        
        $photo = $request->file('photo');
        $photo_filename =  time().'.'.$photo->getClientOriginalExtension();
        
        $product = Product::create([
            'photo' => $photo_filename,
            'brand' => $request['brand'],
            'variant' => $request['variant'],
            'price' => $request['price'],
            'stock' => 0,
        ]);
        
        Image::make($photo)->resize(512, 512)->save(public_path('img/products/'.$photo_filename));
        
        session()->flash('success', 'Produk berhasil di tambahkan !');
        
        return redirect()->route('products.index');
    }
    
    // Edit
    public function edit($id)
    { if (Auth::user()->cannot('edit product')) abort(403);
        $product = Product::findOrFail($id);
        
        return view('pages.products-edit', ['product' => $product]);
    }
    public function update(Request $request, $id)
    { if (Auth::user()->cannot('edit product')) abort(403);
        $product = Product::findOrFail($id);
        
        $this->validate($request,[
            'brand' => 'required',
            'variant' => 'required',
            'price' => 'required',
        ]);
     
        if($request->hasFile('photo')){
            
            $this->validate($request,[
                'photo' => 'required|file|image|mimes:jpeg,png|max:2048',
            ]);
            
            $photo = $request->file('photo');
            Image::make($photo)->resize(512, 512)->save(public_path('img/products/'.$product->photo));
        }
     
        $product->brand =  $request->brand;
        $product->variant =  $request->variant;
        $product->price =  $request->price;
        $product->save();
        
		session()->flash('success', 'Product berhasil di perbarui !');
		
        return redirect()->route('products.index');
    }

    // Delete
    public function destroy($id)
    { if (Auth::user()->cannot('delete product')) abort(403);
        $product = Product::findOrFail($id);
		
		if(File::exists('img/products/'.$product->photo)) {
			File::delete('img/products/'.$product->photo);
		}

        $product->delete();
        
		session()->flash('success', 'Produk berhasil di hapus !');
		
        return redirect()->route('products.index');
    }
}
