@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Add Order</h2>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer</label>
                <select class="form-select" id="customer_id" name="customer_id">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="machine_id" class="form-label">Machine</label>
                <select class="form-select" id="machine_id" name="machine_id">
                    @foreach ($machines as $machine)
                        <option value="{{ $machine->machine_id }}">{{ $machine->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="receipt_date" class="form-label">Receipt Date</label>
                <input type="date" class="form-control" id="receipt_date" name="receipt_date"
                    value="{{ old('receipt_date', now()->toDateString()) }}">
            </div>

            <div class="mb-3">
                <label for="receipt_time" class="form-label">Receipt Time</label>
                <input type="time" class="form-control" id="receipt_time" name="receipt_time"
                    value="{{ now('Asia/Jakarta')->format('H:i') }}">
            </div>

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

            <div class="mb-3">
                <label for="order_status_id" class="form-label">Order Status</label>
                <select class="form-select" id="order_status_id" name="order_status_id">
                    @foreach ($order_statuses as $status)
                        <option value="{{ $status->order_status_id }}">{{ $status->order_status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="payment_status_id" class="form-label">Payment Status</label>
                <select class="form-select" id="payment_status_id" name="payment_status_id">
                    @foreach ($payment_statuses as $payment_status)
                        <option value="{{ $payment_status->payment_status_id }}">{{ $payment_status->payment_status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="time_type" class="form-label">Time Type</label>
                <select class="form-select" id="time_type" name="time_type">
                    @foreach ($times as $time)
                        <option value="{{ $time->time_id }}">{{ $time->type }} -
                            {{ Carbon\Carbon::parse($time->duration)->format('H') }} hours</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Order</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
@endsection
