@extends('layouts.app')

@section('body')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($msg = Session::get('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ $msg  }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Tenant Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Building</th>
                                <th>Flat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tenants as $key => $tenant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tenant->name }}</td>
                                    <td>{{ $tenant->contact ?? '-' }}</td>
                                    <td>{{ $tenant->email ?? '-' }}</td>
                                    <td>{{ optional($tenant->building)->name ?? '-' }}</td>
                                    <td>{{ optional($tenant->flat)->flat_number ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.tenants.show', $tenant) }}"
                                            class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('admin.tenants.edit', $tenant) }}"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('admin.tenants.destroy', $tenant) }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Are your sure to delete this Tenant?')"
                                                class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection