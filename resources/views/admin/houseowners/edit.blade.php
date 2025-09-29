@extends('layouts.app')

@section('body')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($message = Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message  }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form action="{{ route('admin.houseowners.update' , $houseowner) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group row">
                        <label class="form-label col-3">House Owner Name</label>
                        <div class="col-9">
                            <input type="text" value="{{ $houseowner->name }}" class="form-control" name="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">House Owner Email</label>
                        <div class="col-9">
                            <input type="email" value="{{ $houseowner->email }}" class="form-control" name="email">
                            <span>{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">New Password (optional)</label>
                        <div class="col-9">
                            <input name="password" type="password" class="form-control">
                            <span>{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Confirm Password</label>
                        <div class="col-9">
                            <input name="password_confirmation" type="password" class="form-control">
                            <span>{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primary" value="Update House Owner" name="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection