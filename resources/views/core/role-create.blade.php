@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">New Role</div>
                <div class="card-body text-right">
                    <a href="{{ route('core.roles.index') }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left mr-2"></i>Back</a>
                </div>
                <form method="POST" action="{{ route('core.roles.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="input-name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="test" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Role Name" name="name" autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select-permission" class="col-sm-4 col-form-label">Permission</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="select-permission" multiple data-live-search="true" name="permission[]" autocomplete="permission">
                                @foreach ($permissions as $p)
                                <option value="{{ $p->name }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body text-right">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-arrow-right mr-2"></i>Create</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
