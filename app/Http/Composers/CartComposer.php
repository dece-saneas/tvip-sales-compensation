<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Claim;
use Auth;

class CartComposer
{
    public function compose(View $view)
    {
        $excluded = ['auth.login'];
        
        if(!in_array($view->getName() , $excluded))
        {
            $invoices = Invoice::where('user_id', Auth::user()->id)->where('status', '!=' , 'Selesai')->get();
            
            $claims = Claim::where('status', 'Sedang di Proses')->get();
            
            if(Auth::user()->can('create order')) {
                $claims = Claim::where('status', 'Sedang di Proses')->where('user_id', Auth::id())->get();
            }
            
            if(Auth::user()->can('verify order')) {
                $invoices = Invoice::where('status', 'Menunggu Pembayaran')->orWhere('status', 'Menunggu Verifikasi')->orderBy('updated_at', 'DESC')->paginate(20);
            }

            if(Auth::user()->can('process order')) {
                $invoices = Invoice::where('status', 'Sedang di Proses')->orderBy('updated_at', 'DESC')->paginate(20);
            }
            
            $data = [
                'carts'  => Cart::where('user_id', Auth::id() )->where('invoice_id', NULL)->orderBy('updated_at', 'DESC')->get(),
                'invoices'   => $invoices,
                'claims' => $claims
            ];

            $view->with('data', $data);
        }
    }
}