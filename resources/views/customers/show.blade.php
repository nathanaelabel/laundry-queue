@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Customer Detail</h2>

        <div>
            <p><strong>Name:</strong> {{ $customer->name }}</p>
            <p><strong>Phone Number:</strong> {{ $customer->phone_number }}</p>
            <p><strong>Address:</strong> {{ $customer->address }}</p>
        </div>

        <div class="mt-3">
            <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
@endsection
