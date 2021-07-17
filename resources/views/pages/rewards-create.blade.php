@extends('layouts.main')

@section('title') TVIP - Create Reward @endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/select.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/select.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.js') }}"></script>
<script src="{{ asset('js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tambah Reward</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Tambah Reward</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid" id="imageResult" src="{{ asset('img/rewards/placeholder.jpg') }}" alt="photo">
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('rewards.store') }}" enctype="multipart/form-data">
                            @csrf
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
                                    <label for="title">Judul</label>
                                    <input id="title" type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" name="title">
                                    @error('title')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="product">Pilih Produk</label>
                                    <select id="product" class="form-control form-control-sm select @error('product') is-invalid @enderror" name="product">
                                        <option></option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->brand }} {{ $product->variant }}</option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <input id="target" type="number" class="form-control form-control-sm @error('target') is-invalid @enderror" name="target" placeholder="0">
                                    @error('target')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="period">Periode</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input id="period" type="text" class="form-control form-control-sm @error('period') is-invalid @enderror" name="period">
                                    </div>
                                    @error('period')
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
