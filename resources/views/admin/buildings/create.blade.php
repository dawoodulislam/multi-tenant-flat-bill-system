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
                <form action="{{ route('admin.buildings.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="form-label col-3">Buildings Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="name">
                            <span>{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Building Address</label>
                        <div class="col-9">
                            <textarea name="address" class="form-control"></textarea>
                            <span>{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="building_owner" class="form-label col-3">Select Building Owner</label>
                        <div class="col-9">
                            <select name="owner_id" id="building_owner" class="form-control" required>
                                <option>.....Select Building Owner.....</option>
                                @foreach ($owners as $owner)
                                    <option value="{{ $owner->id }}">
                                        {{ $owner->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primary" value="Create New Building" name="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection