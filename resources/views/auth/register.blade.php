@extends('layouts.app')

@section('body')

    <div class="container-xl mt-5 pt-5">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add User</h1>
            <a href="{{ route('login') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> User Login</a>
        </div>

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
                        {{-- Optional: Display all validation errors at the top --}}
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <strong class="font-bold">Whoops!</strong>
                                <span class="block sm:inline">There were some problems with your input.</span>
                                <ul class="mt-3 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="form-label col-3">Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-label col-3">Email</label>
                                <div class="col-9">
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-label col-3">Password</label>
                                <div class="col-9">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-label col-3">Role</label>
                                <div class="col-9">
                                    {{-- <select name="role_id" class="form-control">
                                        <option>......Select Access Label.....</option>
                                        <option value="1">Super Admin</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Executive</option>
                                    </select> --}}
                                    <select name="role_name" class="form-control">
                                        <option>......Select User Role.....</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-label col-3"></label>
                                <div class="col-9">
                                    <input type="submit" class="btn btn-primary" value="Create New User" name="btn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection