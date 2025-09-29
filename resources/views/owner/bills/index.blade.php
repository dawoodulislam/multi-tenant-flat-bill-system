@extends('layouts.app')

@section('body')

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between mb-3">
                <h3>Flats</h3>
                <a href="{{ route('owner.bills.create') }}" class="btn btn-primary">+ New Bill</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Flat</th>
                        <th>Category</th>
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Due Previous</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bills as $bill)
                        <tr>
                            <td>{{ $bill->id }}</td>
                            <td>{{ $bill->flat->flat_number }}</td>
                            <td>{{ $bill->category->name }}</td>
                            <td>{{ $bill->month->format('F Y') }}</td>
                            <td>{{ number_format($bill->amount, 2) }}</td>
                            <td>{{ number_format($bill->due_previous, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $bill->status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($bill->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('owner.bills.show', $bill) }}" class="btn btn-sm btn-info">View</a>
                                @if($bill->status === 'unpaid')
                                    <form method="POST" action="{{ route('owner.bills.pay', $bill) }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="amount" value="{{ $bill->amount + $bill->due_previous }}">
                                        <button class="btn btn-sm btn-success">Mark Paid</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $bills->links() }}
        </div>
    </div>

@endsection