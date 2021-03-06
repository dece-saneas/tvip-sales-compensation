@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Permissions</div>
                <div class="card-body text-right">
                    <a href="{{ route('core.permissions.create') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus mr-2"></i>Create New</a>
                </div>
                @if (count($permissions) > 0)
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="align-middle text-center">#</th>
                                <th scope="col" class="align-middle">Name</th>
                                <th scope="col" class="align-middle text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $i => $p)
                            <tr>
                                <th scope="row" class="align-middle text-center">{{ $i+1 }}</th>
                                <td class="align-middle">{{ $p->name }}</td>
                                <td class="align-middle text-center">
                                    <form action="{{ route('core.permissions.destroy', $p->id) }}" method="POST">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('core.permissions.edit',$p->id) }}" class="btn btn-sm btn-dark"><i class="fas fa-edit"></i></a>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
                                    </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                @if ($permissions->hasPages())
                <div class="card-body">
                    {{ $permissions->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
