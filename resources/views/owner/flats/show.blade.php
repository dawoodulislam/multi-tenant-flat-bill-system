@extends('layouts.app')

@section('body')

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Flat Details — {{ $flat->flat_number }}</h3>
                <div>
                    <a href="{{ route('owner.flats.edit', $flat) }}" class="btn btn-sm btn-secondary">Edit</a>

                    <form action="{{ route('owner.flats.destroy', $flat) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this flat?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>

                    <a href="{{ route('owner.flats.index') }}" class="btn btn-sm btn-link">Back to list</a>
                </div>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $flat->id }}</td>
                </tr>
                <tr>
                    <th>Flat Number</th>
                    <td>{{ $flat->flat_number }}</td>
                </tr>
                <tr>
                    <th>Building</th>
                    <td>{{ optional($flat->building)->name }} @if(optional($flat->building)->address) —
                    {{ $flat->building->address }} @endif</td>
                </tr>
                <tr>
                    <th>Owner (house owner)</th>
                    <td>{{ optional($flat->owner)->name }} ({{ optional($flat->owner)->email }})</td>
                </tr>
                <tr>
                    <th>Flat Owner Name</th>
                    <td>{{ $flat->flat_owner_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Flat Owner Contact</th>
                    <td>{{ $flat->flat_owner_contact ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Flat Owner Email</th>
                    <td>{{ $flat->flat_owner_email ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $flat->created_at ? $flat->created_at->format('Y-m-d H:i') : '-' }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $flat->updated_at ? $flat->updated_at->format('Y-m-d H:i') : '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection