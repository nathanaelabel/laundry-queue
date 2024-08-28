@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Customer List</h2>
            <a href="{{ route('customers.create') }}" class="btn btn-success">New Customer</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $index => $customer)
                    <tr>
                        <td>{{ $customers->firstItem() + $index }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <a href="{{ route('customers.show', $customer->customer_id) }}" class="btn btn-info btn-sm"><i
                                    class="bi bi-eye"></i></a>
                            <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning btn-sm"><i
                                    class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No customers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Include pagination partial -->
        @include('partials.pagination', ['data' => $customers])
    </div>
@endsection
