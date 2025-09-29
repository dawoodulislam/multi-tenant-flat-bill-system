@extends('layouts.app')

@section('body')

    <div class="row">
        <div class="col-12">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h3>Tenant: {{ $tenant->name }}</h3>
                <div>
                    <a href="{{ route('admin.tenants.edit', $tenant) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <a href="{{ route('admin.tenants.index') }}" class="btn btn-link btn-sm">Back to list</a>
                </div>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $tenant->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $tenant->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $tenant->email ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td>{{ $tenant->contact ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Building</th>
                    <td>{{ optional($tenant->building)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Flat</th>
                    <td>{{ optional($tenant->flat)->flat_number ?? '-' }}</td>
                </tr>
                {{-- If you store user_id, show it --}}
                @if(isset($tenant->user_id))
                    <tr>
                        <th>Linked User</th>
                        <td>{{ optional($tenant->user)->email ?? $tenant->user_id }}</td>
                    </tr>
                @endif
                <tr>
                    <th>Created</th>
                    <td>{{ $tenant->created_at ? $tenant->created_at->format('Y-m-d H:i') : '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection