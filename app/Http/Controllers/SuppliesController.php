<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Supply;

class SuppliesController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Index
    public function index(Request $request)
    { if (Auth::user()->cannot('product-supply-read')) abort(403);
        $supplies = Supply::orderBy('updated_at', 'DESC')->paginate(20);
        
        return view('pages.supplies', ['supplies' => $supplies]);
    }

    // Create
    public function create()
    { if (Auth::user()->cannot('product-supply-create')) abort(403);
        $products = Product::orderBy('brand', 'ASC')->get();
        
        if(count($products) == 0) {
            session()->flash('info', 'Belum ada Produk untuk di tambah stock !');
            return redirect()->route('products.index');
        }
        
        return view('pages.supplies-create', ['products' => $products]);
    }
    public function store(Request $request)
    { if (Auth::user()->cannot('product-supply-create')) abort(403);
        $this->validate($request,[
            'product' => 'required',
            'stock' => 'required',
            'notes' => 'required',
        ]);
        
        $supply = Supply::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request['product'],
            'stock' => $request['stock'],
            'notes' => $request['notes'],
        ]);
        
        $product = Product::findOrFail($request['product']);
        
        $product->stock = $product->stock + $request['stock'];
		$product->save();
        
        session()->flash('success', 'Supply berhasil di tambahkan !');
        
        return redirect()->route('supplies.index');
    }

    // Edit
    public function edit($id)
    { if (Auth::user()->cannot('product-supply-update')) abort(403);
        $products = Product::orderBy('brand', 'ASC')->get();
        $supply = Supply::findOrFail($id);
        
        return view('pages.supplies-edit', ['supply' => $supply, 'products' => $products]);
    }
    public function update(Request $request, $id)
    { if (Auth::user()->cannot('product-supply-update')) abort(403);
        $supply = Supply::findOrFail($id);
        $product = Product::findOrFail($supply->product_id);
        
        $this->validate($request,[
            'stock' => 'required',
            'notes' => 'required',
        ]); 
        
        $newStock = $product->stock - ($supply->stock - $request->stock);
        
        $supply->stock = $request->stock;
        $supply->notes = $request->notes;
		$supply->save();
        
        $product->stock = $newStock;
        $product->save();

        session()->flash('success', 'Data Supply berhasil di perbarui !');
        
        return redirect()->route('supplies.index');
    }

    // Delete
    public function destroy($id)
    {
        $supply = Supply::findOrFail($id);
        $product = Product::findOrFail($supply->product_id);
        
        $product->stock = $product->stock - $supply->stock;
        $product->save();
        
        $supply->delete();
        
		session()->flash('success', 'Supply berhasil di hapus !');
		
        return redirect()->route('supplies.index');
    }
}
