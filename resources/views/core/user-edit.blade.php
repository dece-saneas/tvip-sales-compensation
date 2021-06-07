@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>
                <div class="card-body text-right">
                    <a href="{{ route('core.users.index') }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left mr-2"></i>Back</a>
                </div>
                <form method="POST" action="{{ route('core.users.update',$user->id) }}">
                @csrf @method('put')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="input-name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="test" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Your Name" name="name" autocomplete="name" autofocus value="{{ $user->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="input-email" placeholder="example@mail.com" autocomplete="email" name="email" value="{{ $user->email }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select-role" class="col-sm-4 col-form-label">Role</label>
                        <div class="col-sm-8">
                            <select class="form-control @error('role') is-invalid @enderror" id="select-role" name="role" autocomplete="role">
                                @foreach ($roles as $r)
                                <option value="{{ $r->name }}" @foreach ($user->roles as $xr) @if($xr->name == $r->name) selected @endif @endforeach>{{ $r->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="input-password" name="password" autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-password-confirm" class="col-sm-4 col-form-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="input-password-confirm" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>
                </div>
                <div class="card-body text-right">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-save mr-2"></i>Save</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
