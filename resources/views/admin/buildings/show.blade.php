@extends('layouts.app')

@section('body')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h3>Building: {{ $building->name }}</h3>
                    <p><strong>Address:</strong> {{ $building->address }}</p>
                    <p><strong>Building Owner:</strong> {{ $building->owner->name }}</p>

                    <br>
                    <h5>Flats</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Flat No</th>
                                <th>Owner</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($building->flats as $flat)
                                <tr>
                                    <td>{{ $flat->id }}</td>
                                    <td>{{ $flat->flat_number }}</td>
                                    <td>{{ $flat->flat_owner_name }}</td>
                                    <td>{{ $flat->flat_owner_contact }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection