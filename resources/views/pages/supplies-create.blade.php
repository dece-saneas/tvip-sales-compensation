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
            <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active">Tambah Stok</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Tambah Stok</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form method="POST" action="{{ route('supplies.store') }}">
                            @csrf
                            <div class="tab-content">
                                <div class="form-group">
                                    <label for="product">Pilih Produk</label>
                                    <select id="product" class="form-control form-control-sm select @error('product') is-invalid @enderror" name="product">
                                        <option></option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->brand }} - {{ $product->variant }}</option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Jumlah Stok</label>
                                    <input id="stock" type="number" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="0" name="stock">
                                    @error('stock')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="notes">Catatan</label>
                                    <textarea id="notes" class="form-control form-control-sm @error('notes') is-invalid @enderror" rows="2" name="notes"></textarea>
                                    @error('notes')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group text-right mb-0">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
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
