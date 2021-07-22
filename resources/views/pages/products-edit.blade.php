@extends('layouts.main')

@section('title') TVIP - Edit Product @endsection

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
            <li class="breadcrumb-item active">Edit Produk</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Tambah Produk</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid" id="imageResult" src="{{ asset('img/products/'.$product->photo) }}" alt="photo">
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
                            @csrf @method('put')
                            <div class="input-group mb-2">
                                <div class="custom-file" id="customFile">
                                    <input type="file" class="custom-file-input" id="upload" aria-describedby="photoAddon" name="photo">
                                    <label class="custom-file-label" id="upload-label">Upload Photo</label>
                                </div>
                            </div>
                            @error('photo')
                            <span class="text-danger text-sm">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="form-group">
                                    <label for="brand">Merk</label>
                                    <select id="brand" class="form-control form-control-sm select @error('brand') is-invalid @enderror" name="brand">
                                        <option></option>
                                        <option value="Aqua" @if($product->brand == 'Aqua') selected @endif>Aqua</option>
                                        <option value="Vit" @if($product->brand == 'Vit') selected @endif>Vit</option>
                                        <option value="Mizone" @if($product->brand == 'Mizone') selected @endif>Mizone</option>
                                        <option value="Levite" @if($product->brand == 'Levite') selected @endif>Levite</option>
                                    </select>
                                    @error('brand')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="variant">Ukuran</label>
                                    <input id="variant" type="text" class="form-control form-control-sm @error('variant') is-invalid @enderror" name="variant" value="{{ $product->variant }}">
                                    @error('variant')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="variant">Harga</label>
                                    <input id="price" type="number" class="form-control form-control-sm @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}">
                                    @error('price')
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
