@extends('layouts.app')

@section('body')

    <div class="row">
        <div class="col-12">
            <h3>Bill #{{ $bill->id }}</h3>

            <table class="table">
                <tr>
                    <th>Flat</th>
                    <td>{{ $bill->flat->flat_number }} ({{ $bill->building->name }})</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $bill->category->name }}</td>
                </tr>
                <tr>
                    <th>Month</th>
                    <td>{{ \Carbon\Carbon::parse($bill->month)->format('F Y') }}</td>
                </tr>
                <tr>
                    <th>Total Due</th>
                    <td>{{ number_format($bill->amount + $bill->due_previous, 2) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($bill->status) }}</td>
                </tr>
                <tr>
                    <th>Notes</th>
                    <td>{{ $bill->notes }}</td>
                </tr>
            </table>

            @if($bill->status === 'unpaid')
                <form method="POST" action="{{ route('owner.bills.pay', $bill) }}">
                    @csrf
                    <div class="mb-3">
                        <label>Amount to pay</label>
                        <input name="amount" class="form-control" required value="{{ $bill->amount + $bill->due_previous }}">
                    </div>
                    <div class="mb-3">
                        <label>Reference (optional)</label>
                        <input name="reference" class="form-control">
                    </div>
                    <button class="btn btn-success">Pay</button>
                </form>
            @endif
        </div>
    </div>

@endsection