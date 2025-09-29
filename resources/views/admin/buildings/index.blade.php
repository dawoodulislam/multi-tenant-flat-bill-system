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
                                <th>Building name</th>
                                <th>Building Address</th>
                                <th>Building Owner</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buildings as $key => $building)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $building->name }}</td>
                                    <td>{{ $building->address }}</td>
                                    <td>{{ $building->owner->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.buildings.show', $building) }}"
                                            class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('admin.buildings.edit', $building) }}"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('admin.buildings.destroy', $building) }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Are your sure to delete this Building?')"
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