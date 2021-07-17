@extends('layouts.main')

@section('title') TVIP - Carts @endsection

@section('modal')
@can('order product')
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bb-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center py-0">
                <h4 class="modal-title mb-2"><strong>Are you sure?</strong></h4>
                <h6 class="modal-messages m-0">Are you really want to delete these records? This process cannot be undone.</h6>
            </div>
            <div class="modal-body text-center">
                <form action="javascript:void(0);" method="POST" id="DeleteForm"> 
                    <button class="btn btn-sm btn-light mx-1 px-4" data-dismiss="modal" aria-label="Close">Cancel</button> 
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-sm btn-danger mx-1 px-4">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endcan
@can('order product')
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" id="EditForm">
                @csrf @method('put')
                    <div class="input-group input-group-sm">
                        <input type="number" class="form-control quantity" value="" max="" min="1" name="type">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="submit"><i class="fas fa-save mr-2"></i>Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Keranjang</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Keranjang</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-sm m-0">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">#</th>
                                            <th width="10%">Product</th>
                                            <th width="25%"></th>
                                            <th width="5%" class="text-center">Quantity</th>
                                            <th width="20%" class=" text-right">Price</th>
                                            <th width="20%" class="text-right">Total</th>
                                            <th width="15%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            @if(count($carts) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm m-0">
                                    <tbody>
                                        @foreach ($carts as $no =>  $cart)
                                        <tr>
                                            <th width="5%" class="align-middle text-center">{{ $no+1 }}</th>
                                            <td width="10%"><img src="{{ asset('img/products/'.$cart->product->photo) }}" alt="" class="img-fluid"></td>
                                            <td width="25%" class="align-middle"><b>{{ $cart->product->brand }}</b><br><small>{{ $cart->product->variant }}</small></td>
                                            <td width="5%" class="align-middle text-center">
                                                <form method="POST" action="{{ route('carts.update', $cart->id) }}">
                                                @csrf @method('put')
                                                <div class="btn-group btn-group-sm btn-block" role="group" aria-label="Basic example">
                                                    <button type="submit" class="btn btn-secondary" name="type" value="decrease">-</button>
                                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#EditModal" data-uri="{{ route('carts.update', $cart->id) }}" data-quantity="{{ $cart->quantity }}" data-max="{{ $cart->quantity+$cart->product->stock }}">{{ $cart->quantity }}</button>
                                                    <button type="submit" class="btn btn-secondary" name="type" value="increase">+</button>
                                                </div>
                                                </form>
                                            </td>
                                            <td width="20%" class="align-middle text-right">Rp {{ number_format($cart->product->price,0,"",".") }}</td>
                                            <td width="20%" class="align-middle text-right">Rp {{ number_format($cart->product->price*$cart->quantity,0,"",".") }} @php $total[] = $cart->product->price*$cart->quantity @endphp</td>
                                            <td width="15%" class="align-middle text-center">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#DeleteModal" data-uri="{{ route('carts.destroy', $cart->id) }}"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="alert alert-light alert-dismissible fade show" role="alert">
                                Keranjang kamu masih kosong !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <a href="{{ route('products.index') }}" class="btn btn-primary">Lanjut Belanja</a>
                                <button class="btn btn-success" disabled>Checkout Sekarang</button>
                            </div>
                            @endif
                        </div>
                        @if(count($carts) > 0)
                        <div class="card-body">
                            <div class="table-responsive mb-4">
                                <table class="table table-borderless table-hover table-sm m-0">
                                    <thead>
                                        <tr>
                                            <th width="5%"></th>
                                            <th width="10%"></th>
                                            <th width="25%"></th>
                                            <th width="5%"></th>
                                            <th width="20%" class="align-middle text-right">Total</th>
                                            <th width="20%" class="align-middle text-right">Rp {{ number_format(array_sum($total),0,"",".") }}</th>
                                            <th width="15%"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.index') }}" class="btn btn-primary">Lanjut Belanja</a>
                                <a href="{{ route('orders.create') }}" class="btn btn-success">Checkout Sekarang</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection