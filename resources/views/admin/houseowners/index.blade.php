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
                                <th>House Owner Name</th>
                                <th>House Owner Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($owners as $key => $owner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $owner->name }}</td>
                                    <td>{{ $owner->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.houseowners.edit', $owner) }}"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('admin.houseowners.destroy', $owner) }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Are your sure to delete this owner?')"
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