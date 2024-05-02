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
                <label for="receipt_date" class="form-label">Receipt Date</label>
                <input type="date" class="form-control" id="receipt_date" name="receipt_date">
            </div>

            <div class="mb-3">
                <label for="receipt_time" class="form-label">Receipt Time</label>
                <input type="time" class="form-control" id="receipt_time" name="receipt_time">
            </div>

            <div class="mb-3">
                <label for="finish_date" class="form-label">Finish Date</label>
                <input type="date" class="form-control" id="finish_date" name="finish_date">
            </div>

            <div class="mb-3">
                <label for="finish_time" class="form-label">Finish Time</label>
                <input type="time" class="form-control" id="finish_time" name="finish_time">
            </div>

            <div class="mb-3">
                <label for="order_status_id" class="form-label">Order Status</label>
                <select class="form-select" id="order_status_id" name="order_status_id">
                    @foreach ($order_statuses as $order_status)
                        <option value="{{ $order_status->order_status_id }}">{{ $order_status->order_status }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Order</button>
        </form>
    </div>
@endsection
