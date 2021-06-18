<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Auth;
use App\Models\Product;

class ProductsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->cannot('product-index')) abort(403);
        
        $products = Product::get();
        
        return view('pages.products', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->cannot('product-create')) abort(403);
        
        return view('pages.products-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->cannot('product-create')) abort(403);
        
        $this->validate($request,[
            'brand' => 'required',
            'variant' => 'required',
            'photo' => 'file|image|mimes:jpeg,png|max:2048',
        ]);
        
        $photo = $request->file('photo');
        $photo_filename =  time().'.'.$photo->getClientOriginalExtension();
        
        $product = Product::create([
            'photo' => $photo_filename,
            'brand' => $request['brand'],
            'variant' => $request['variant'],
            'stock' => 0,
        ]);
        
        Image::make($photo)->resize(512, 512)->save(public_path('img/products/'.$photo_filename));
        
        session()->flash('success', 'Produk berhasil di tambahkan !');
        
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Filter product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        if (Auth::user()->cannot('product-index')) abort(403);
        
        $filter = Product::query();
        $q = request()->all();
        
        if(count($q) == 1 || count($q['brand']) == 4) return redirect()->route('products.index');
        
        if(!empty($q['brand'])){
            $filter->whereIn('brand',$q['brand']);
        }
        
        $products = $filter->get();
        
        return view('pages.products', ['products' => $products, 'brand' => $q['brand']]);
    }
}
