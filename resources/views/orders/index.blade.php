@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Order List</h2>
            <a href="{{ route('orders.create') }}" class="btn btn-success">New Order</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Receipt Date and Time</th>
                    <th>Finish Date and Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $index => $order)
                    <tr>
                        <td>{{ $orders->firstItem() + $index }}</td>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->orderStatus->order_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->receipt_date . ' ' . $order->receipt_time)->format('d M Y, H:i') }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->finish_date . ' ' . $order->finish_time)->format('d M Y, H:i') }}
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No orders found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Include pagination partial -->
        @include('partials.pagination', ['data' => $orders])
    </div>
@endsection
