@extends('layouts.main')

@section('title') TVIP - Create User @endsection

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
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">User</a></li>
            <li class="breadcrumb-item active">Tambah User</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Tambah User</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="tab-content">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select id="role" class="form-control form-control-sm select @error('role') is-invalid @enderror" name="role">
                                        <option></option>
                                        @if(Auth::user()->hasRole('Admin CRO'))
                                        <option value="Customer">Customer</option>
                                        @else
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="input-password">Password</label>
                                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="input-password" name="password" autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="input-password-confirm">Confirm Password</label>
                                    <input type="password" class="form-control form-control-sm" id="input-password-confirm" name="password_confirmation" autocomplete="new-password">
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
