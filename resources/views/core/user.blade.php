@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body text-right">
                    <a href="{{ route('core.users.create') }}" class="btn btn-sm btn-dark"><i class="fas fa-user-plus mr-2"></i>Create New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle text-center">#</th>
                                    <th scope="col" class="align-middle">Name</th>
                                    <th scope="col" class="align-middle">Email</th>
                                    <th scope="col" class="align-middle text-center">Role</th>
                                    <th scope="col" class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $i => $u)
                                <tr>
                                    <th scope="row" class="align-middle text-center">{{ $i+1 }}</th>
                                    <td class="align-middle">{{ $u->name }}</td>
                                    <td class="align-middle">{{ $u->email }}</td>
                                    <td class="align-middle text-center">
                                        @if(isset($u->roles[0]->name))
                                        <span class="badge badge-pill badge-light py-1 px-2">{{ $u->roles[0]->name }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <form action="{{ route('core.users.destroy', $u->id) }}" method="POST">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('core.users.edit',$u->id) }}" class="btn btn-sm btn-dark"><i class="fas fa-edit"></i></a>
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
                </div>
                @if ($users->hasPages())
                <div class="card-body">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
