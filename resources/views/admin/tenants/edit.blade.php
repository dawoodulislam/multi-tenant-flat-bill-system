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
                    <form action="{{ route('admin.tenants.update', $tenant) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="form-group row">
                            <label class="form-label col-3">Tenant Name</label>
                            <div class="col-9">
                                <input type="text" class="form-control" name="name" value="{{ $tenant->name }}">
                                <span>{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Tenant Email</label>
                            <div class="col-9">
                                <input type="email" class="form-control" name="email" value="{{ $tenant->email }}">
                                <span>{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Tenant Contact</label>
                            <div class="col-9">
                                <input type="text" name="contact" class="form-control" value="{{ $tenant->contact }}">
                                <span>{{ $errors->has('contact') ? $errors->first('contact') : '' }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Building</label>
                            <div class="col-9">
                                <select name="building_id" id="building_id" class="form-control" required
                                    onchange="populateFlats()">
                                    <option value="">-- Select Building --</option>
                                    @foreach($buildings as $b)
                                        <option value="{{ $b->id }}" data-flats='@json($b->flats)' {{ (old('building_id', $tenant->building_id) == $b->id) ? 'selected' : '' }}>
                                            {{ $b->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('building_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Flat (optional)</label>
                            <div class="col-9">
                                <select name="flat_id" id="flat_id" class="form-control">
                                    <option value="">-- Select Flat --</option>
                                    @if($tenant->flat)
                                        <option value="{{ $tenant->flat->id }}" selected>{{ $tenant->flat->flat_number }}
                                        </option>
                                    @endif
                                </select>
                                @error('flat_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="form-label col-3"></label>
                            <div class="col-9">
                                <input type="submit" class="btn btn-primary" value="Update Building" name="btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function populateFlats() {
            const buildingSelect = document.getElementById('building_id');
            const flatSelect = document.getElementById('flat_id');
            flatSelect.innerHTML = '<option value="">-- Select Flat --</option>';

            const selectedOption = buildingSelect.options[buildingSelect.selectedIndex];
            if (!selectedOption) return;

            const flatsJson = selectedOption.getAttribute('data-flats');
            if (!flatsJson) return;

            try {
                const flats = JSON.parse(flatsJson);
                flats.forEach(f => {
                    const opt = document.createElement('option');
                    opt.value = f.id;
                    opt.text = f.flat_number ?? (f.id);
                    // if this flat matches tenant flat, mark selected
                    @if(old('flat_id', $tenant->flat_id))
                        if (f.id == "{{ old('flat_id', $tenant->flat_id) }}") {
                            opt.selected = true;
                        }
                    @endif
                    flatSelect.appendChild(opt);
                });
            } catch (err) {
                console.error('Invalid flats JSON', err);
            }
        }

        // run populate on page load to ensure flat list is correct for the selected building
        document.addEventListener('DOMContentLoaded', function () {
            populateFlats();
        });
    </script>
@endsection