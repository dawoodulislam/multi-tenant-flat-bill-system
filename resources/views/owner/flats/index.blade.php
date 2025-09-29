@extends('layouts.app')

@section('body')

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between mb-3">
                <h3>Flats</h3>
                <a href="{{ route('owner.flats.create') }}" class="btn btn-primary">New Flat</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Building</th>
                        <th>Flat No</th>
                        <th>Owner Name</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flats as $flat)
                        <tr>
                            <td>{{ $flat->id }}</td>
                            <td>{{ $flat->building->name }}</td>
                            <td>{{ $flat->flat_number }}</td>
                            <td>{{ $flat->flat_owner_name }}</td>
                            <td>{{ $flat->flat_owner_contact }}</td>
                            <td>
                                <a href="{{ route('owner.flats.show', $flat) }}"
                                            class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('owner.flats.edit', $flat) }}" class="btn btn-sm btn-secondary">Edit</a>
                                <form action="{{ route('owner.flats.destroy', $flat) }}" method="post" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $flats->links() }}
        </div>
    </div>

@endsection