<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\Product;

class CartsController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //Index
    public function index()
    { if (Auth::user()->cannot('create order')) abort(403);
        
        $carts = Cart::where('user_id', Auth::id() )->where('invoice_id', NULL)->orderBy('updated_at', 'DESC')->get();
     
        return view('pages.carts', ['carts' => $carts]);
    }

    // Create
    public function store(Request $request)
    { if (Auth::user()->cannot('create order')) abort(403);
     
        if(!empty(Cart::where('user_id', Auth::user()->id)->where('product_id',$request['product'])->where('invoice_id', NULL)->first())) {
            $cart = Cart::where('user_id', Auth::user()->id)->where('product_id',$request['product'])->where('invoice_id', NULL)->first();
            $cart->quantity = $cart->quantity + $request['qty'];
            $cart->save();
        }else {
            $cart = Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request['product'],
                'quantity' => $request['qty']
            ]);
        }
     
        $product = Product::findOrFail($request['product']);
        $product->stock = $product->stock - $request['qty'];
        $product->save();
     
        session()->flash('success', 'Produk berhasil di dimasukkan ke keranjang !');
        
        return redirect()->back();
    }
    
    // Edit
    public function update(Request $request, $id)
    { if (Auth::user()->cannot('create order')) abort(403);
     
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($cart->product_id);
     
        if($request['type'] == 'increase') {
            $cart->quantity = $cart->quantity+1;
            $cart->save();
            
            $product->stock = $product->stock-1;
            $product->save();
        }elseif($request['type'] == 'decrease') {
            $cart->quantity = $cart->quantity-1;
            $cart->save();
            
            $product->stock = $product->stock+1;
            $product->save();
        }else {
            $change = $request['type']-$cart->quantity;
            
            $cart->quantity = $cart->quantity+$change;
            $cart->save();
            
            $product->stock = $product->stock-$change;
            $product->save();
        }
     
        if($cart->quantity == 0) $cart->delete();
        
        return redirect()->route('carts.index');
    }

    // Delete
    public function destroy($id)
    { if (Auth::user()->cannot('create order')) abort(403);
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($cart->product_id);
        
        $product->stock = $product->stock + $cart->quantity;
        $product->save();
        
        $cart->delete();
        
		session()->flash('success', 'Produk berhasil di hapus !');
		
        return redirect()->route('carts.index');
    }
}
