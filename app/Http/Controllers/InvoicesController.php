<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Image;
use App\Models\Cart;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoicesController extends Controller
{
    // Construct
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Index
    public function index()
    { if (Auth::user()->cannot('view order')) abort(403);
        
        $expired = Invoice::where('created_at', '<=', Carbon::now()->subDay())->get();
     
        foreach ($expired as $data) {
            if($data->status == 'Menunggu Pembayaran') {
                $invoice = Invoice::findOrFail($data->id);
                $invoice->delete();
            }
        }
     
        $invoices = Invoice::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->paginate(20);
        
        if(Auth::user()->can('verify order')) {
            $invoices = Invoice::where('status', '!=' , 'Selesai')->orderBy('updated_at', 'DESC')->paginate(20);
        }
     
        if(Auth::user()->can('process order')) {
            $invoices = Invoice::where('status', 'Sedang di Proses')->orWhere('status', 'Sedang di Kirim')->orWhere('status', 'Selesai')->orderBy('updated_at', 'DESC')->paginate(20);
        }
     
        return view('pages.orders', ['invoices' => $invoices]);
    }

    // Create
    public function create()
    { if (Auth::user()->cannot('create order')) abort(403);
     
        return view('pages.checkout');
    }
    public function store(Request $request)
    { if (Auth::user()->cannot('create order')) abort(403);
     
        $carts = Cart::where('user_id', Auth::user()->id)->where('invoice_id', NULL)->get();
     
        foreach($carts as $item) $total[] = $item->product->price*$item->quantity;
     
        $total = array_sum($total);
     
        $this->validate($request,[
            'payment' => 'required',
            'telp' => 'required',
            'address' => 'required',
        ]);
        
        $status = 'Menunggu Pembayaran';
     
        if($request['payment'] == 'COD') $status = 'Sedang di Proses';
     
        $invoice = Invoice::create([
            'code' => 'INV'.time(),
            'user_id' => Auth::user()->id,
            'payment' => $request['payment'],
            'total' => $total,
            'telp' => $request['telp'],
            'address' => $request['address'],
            'status' => $status,
        ]);
     
        foreach($carts as $item) {
                
            $cart = Cart::findOrFail($item->id);
            
            $cart->invoice_id = $invoice->id;
            $cart->save();
        }
        
        session()->flash('success', 'Checkout berhasil !');
        
        return redirect()->route('orders.show',$invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { if (Auth::user()->cannot('view order')) abort(403);
     
        $invoice = Invoice::findOrFail($id);
        
        $products = Cart::where('invoice_id', $id)->get();
     
        return view('pages.invoice-show', ['invoice' => $invoice, 'products' => $products]);
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
    { if (Auth::user()->cannot('create order')) abort(403);
     
        $invoice = Invoice::findOrFail($id);

        $this->validate($request,[
            'photo' => 'required|file|image|mimes:jpeg,png|max:2048',
            'bank' => 'required',
            'account' => 'required',
            'name' => 'required',
        ]);

        $photo = $request->file('photo');
        $photo_filename =  time().'.'.$photo->getClientOriginalExtension();

        if($invoice->attachment !== NULL) $photo_filename = $invoice->attachment;

        Image::make($photo)->resize(512, 512)->save(public_path('img/uploads/'.$photo_filename));

        $invoice->attachment =  $photo_filename;
        $invoice->bank_name =  $request->bank;
        $invoice->bank_account_name =  $request->name;
        $invoice->bank_account =  $request->account;
        $invoice->status =  'Menunggu Verifikasi';
        $invoice->save();
        
		session()->flash('success', 'Upload berhasil !');
		
        return redirect()->route('orders.index');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function process($type, $id)
    { if (Auth::user()->cannot('create order')) abort(403);
        $invoice = Invoice::findOrFail($id);
        
        if($type == 'verify') {
            $invoice->status =  'Sedang di Proses';
            $invoice->save();
        }
        
        if($type == 'process') {
            $invoice->status =  'Sedang di Kirim';
            $invoice->save();
        }
        
        if($type == 'complete') {
            $invoice->status =  'Selesai';
            $invoice->save();
        }
        
		session()->flash('success', 'Pesanan di Proses !');
		
        return redirect()->back();
    }
}
