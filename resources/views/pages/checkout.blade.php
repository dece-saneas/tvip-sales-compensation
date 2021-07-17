@extends('layouts.main')

@section('title') TVIP - Add Supplies @endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/select.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/select.min.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('carts.index') }}">Keranjang</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Checkout</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="tab-content">
                                <div class="form-group">
                                    <label for="payment">Metode Pembayaran</label>
                                    <select id="payment" class="form-control form-control-sm select @error('payment') is-invalid @enderror" name="payment">
                                        <option></option>
                                        <option value="Bank">Bank Transfer</option>
                                        <option value="COD">Cash on Delivery (COD)</option>
                                    </select>
                                    @error('payment')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telp">No Telp</label>
                                    <input id="telp" type="number" class="form-control form-control-sm @error('telp') is-invalid @enderror" placeholder="+62" name="telp">
                                    @error('telp')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea id="address" class="form-control form-control-sm @error('address') is-invalid @enderror" rows="2" name="address"></textarea>
                                    @error('address')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group text-right mb-0">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-receipt mr-2"></i>Pesan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
