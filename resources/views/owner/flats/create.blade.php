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

                    <form action="{{ route('owner.flats.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="form-label col-3">Building <span class="text-danger">*</span></label>
                            <div class="col-9">
                                <select name="building_id" class="form-control" required>
                                    <option value="">-- Select Building --</option>
                                    @forelse($buildings as $b)
                                        <option value="{{ $b->id }}" {{ old('building_id') == $b->id ? 'selected' : '' }}>
                                            {{ $b->name }} @if($b->address) - {{ $b->address }} @endif
                                        </option>
                                    @empty
                                        <option value="">No buildings found. Create a building first.</option>
                                    @endforelse
                                </select>
                                @error('building_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Flat Number <span class="text-danger">*</span></label>
                            <div class="col-9">
                                <input type="text" name="flat_number" class="form-control" value="{{ old('flat_number') }}"
                                    required>
                                @error('flat_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Flat Owner Name</label>
                            <div class="col-9">
                                <input type="text" name="flat_owner_name" class="form-control"
                                    value="{{ old('flat_owner_name') }}">
                                @error('flat_owner_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Flat Owner Contact</label>
                            <div class="col-9">
                                <input type="text" name="flat_owner_contact" class="form-control"
                                    value="{{ old('flat_owner_contact') }}">
                                @error('flat_owner_contact') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label col-3">Flat Owner Email</label>
                            <div class="col-9">
                                <input type="email" name="flat_owner_email" class="form-control"
                                    value="{{ old('flat_owner_email') }}">
                                @error('flat_owner_email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3"></label>
                            <div class="col-9">
                                <input type="submit" class="btn btn-primary" value="Create New Flat" name="btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection