@extends('layouts.main')

@section('title') TVIP - Settings @endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="container-fluid px-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Settings</li>
        </ol>
    </div>
    <!-- Main content -->
    <div class="content pb-50">
        <div class="container">
            <div class="jumbotron jumbotron-fluid p-4 bg-transparent">
                <div class="container text-center">
                    <h1 class="display-4">Settings</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle setting-photo" id="imageResult" src="{{ asset('img/users/'.Auth::user()->photo) }}" alt="photo" onerror="this.onerror=null;this.src='{{ asset('img/users/placeholder.jpg') }}';">
                            </div>
                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                            <p class="text-muted text-center">@foreach ( Auth::user()->getRoleNames() as $role ) {{ $role }} @endforeach</p>
                            <form method="POST" action="{{ route('settings.update', Auth::user()->id) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="input-group mb-2">
                                <div class="custom-file" id="customFile">
                                    <input type="file" class="custom-file-input" id="upload" aria-describedby="photoAddon" name="photo">
                                    <label class="custom-file-label" id="upload-label">Change Photo</label>
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
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control form-control-sm" id="name" value="{{ Auth::user()->name }}" name="name" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" placeholder="example@tvip.com" value="{{ Auth::user()->email }}" name="email">
                                    @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password"  name="password" autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control form-control-sm" id="password-confirm" name="password_confirmation" autocomplete="new-password">
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
