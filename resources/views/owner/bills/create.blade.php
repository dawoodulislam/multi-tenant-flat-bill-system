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

                    <form action="{{ route('owner.bills.store') }}" method="POST">
                        @csrf



                        <div class="form-group row">
                            <label class="form-label col-3">Building</label>
                            <div class="col-9">
                                <select name="building_id" class="form-control" required onchange="loadFlats(this)">
                                    <option value="">--select--</option>
                                    @foreach($buildings as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Flat</label>
                            <div class="col-9">
                                <select name="flat_id" id="flat_id" class="form-control" required>
                                    <option value="">Select Building first</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Categories</label>
                            <div class="col-9">
                                <select name="bill_category_id" class="form-control" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Date</label>
                            <div class="col-9">
                                <input type="date" name="month" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Amount</label>
                            <div class="col-9">
                                <input type="text" name="amount" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3">Notes</label>
                            <div class="col-9">
                                <textarea name="notes" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3"></label>
                            <div class="col-9">
                                <input type="submit" class="btn btn-primary" value="Create New Bill" name="btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const buildings = @json($buildings);
        function loadFlats(select) {
            const id = select.value;
            const flatsSelect = document.getElementById('flat_id');
            flatsSelect.innerHTML = '<option value="">--select--</option>';
            const building = buildings.find(b => b.id == id);
            if (building && building.flats) {
                building.flats.forEach(f => {
                    const opt = document.createElement('option');
                    opt.value = f.id;
                    opt.text = f.flat_number;
                    flatsSelect.appendChild(opt);
                });
            }
        }
    </script>
@endsection