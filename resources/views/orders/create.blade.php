@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Add Order</h2>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <!-- Customer Selection -->
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer</label>
                <select class="form-select" id="customer_id" name="customer_id">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Automatically Set Today's Date for Receipt -->
            <div class="mb-3">
                <label for="receipt_date" class="form-label">Receipt Date</label>
                <input type="date" class="form-control" id="receipt_date" name="receipt_date" value="{{ now()->toDateString() }}">
            </div>

            <div class="mb-3">
                <label for="receipt_time" class="form-label">Receipt Time</label>
                <input type="time" class="form-control" id="receipt_time" name="receipt_time" value="{{ now()->format('H:i') }}">
            </div>

            <!-- Inputs for Weight, Quantity, and Price -->
            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="text" class="form-control" id="weight" name="weight" required>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>

            <!-- Order Status Selection -->
            <div class="mb-3">
                <label for="order_status_id" class="form-label">Order Status</label>
                <select class="form-select" id="order_status_id" name="order_status_id">
                    @foreach ($order_statuses as $status)
                        <option value="{{ $status->order_status_id }}">{{ $status->order_status }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Order</button>
        </form>
    </div>
@endsection
