@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ $role->name }}</div>
                <div class="card-body text-right">
                    <a href="{{ route('core.roles.index') }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left mr-2"></i>Back</a>
                </div>
                <form method="POST" action="{{ route('core.roles.update',$role->id) }}">
                @csrf @method('put')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="input-name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="test" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Role Name" name="name" autocomplete="name" autofocus value="{{ $role->name }}">
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
                            <select class="form-control @error('role') is-invalid @enderror" id="select-permission" multiple data-live-search="true" name="permission[]" autocomplete="permission">
                                @foreach ($permissions as $p)
                                <option value="{{ $p->name }}" @foreach ($role->permissions as $xp) @if($xp->name == $p->name) selected @endif @endforeach>{{ $p->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
