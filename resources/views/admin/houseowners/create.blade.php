@extends('layouts.app')

@section('body')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($message = Session::get(key: 'message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message  }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form action="{{ route('admin.houseowners.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="form-label col-3">House Owner Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="name">
                            <span>{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Email</label>
                        <div class="col-9">
                            <input name="email" type="email" class="form-control" required>
                            <span>{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Password</label>
                        <div class="col-9">
                            <input name="password" type="password" class="form-control" required>
                            <span>{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Confirm Password</label>
                        <div class="col-9">
                            <input name="password_confirmation" type="password" class="form-control" required>
                            <span>{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primary" value="Create New House Owner" name="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection