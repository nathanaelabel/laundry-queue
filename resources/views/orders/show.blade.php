@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Order Detail</h2>

        <div>
            <p></p>
            <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
            <p><strong>Machine:</strong>
                @if (in_array($order->orderStatus->order_status, ['Setrika', 'Selesai']))
                    Not needed
                @else
                    {{ $order->machine ? $order->machine->name : 'No machine assigned' }}
                @endif
            </p>
            <p><strong>Receipt Date and Time:</strong> {{ $order->receipt_date }} {{ $order->receipt_time }}</p>
            <p><strong>Finish Date and Time:</strong> {{ $order->finish_date }} {{ $order->finish_time }}</p>
            <p><strong>Weight:</strong> {{ $order->weight }}</p>
            <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
            <p><strong>Price:</strong> {{ $order->price }}</p>
            <p><strong>Order Status:</strong> {{ $order->orderStatus->order_status }}</p>
            <p><strong>Payment Status:</strong> {{ $order->paymentStatus->payment_status }}</p>
        </div>

        <div class="mt-3">
            <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
@endsection
