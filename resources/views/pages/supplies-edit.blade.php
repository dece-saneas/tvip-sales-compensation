@extends('layouts.main')

@section('title') TVIP - Edit Supplies @endsection

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
            <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('supplies.index') }}">Supplies</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Edit Data Supply</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form method="POST" action="{{ route('supplies.update', $supply->id) }}">
                            @csrf @method('put')
                            <div class="tab-content">
                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <select id="product" class="form-control form-control-sm select @error('product') is-invalid @enderror" name="product" disabled>
                                        <option></option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}" @if($supply->product->id == $product->id) selected @endif>{{ $product->brand }} - {{ $product->variant }}</option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input id="stock" type="number" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="0" name="stock" value="{{ $supply->stock }}">
                                    @error('stock')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea id="notes" class="form-control form-control-sm @error('notes') is-invalid @enderror" rows="2" name="notes">{{ $supply->notes }}</textarea>
                                    @error('notes')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group text-right mb-0">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Save</button>
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
