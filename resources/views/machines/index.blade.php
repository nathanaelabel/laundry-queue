@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Machine List</h2>
            <a href="{{ route('machines.create') }}" class="btn btn-success">New Machine</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($machines as $machine)
                    <tr>
                        <td>{{ $machine->machine_id }}</td>
                        <td>{{ $machine->name }}</td>
                        <td>{{ $machine->status }}</td>
                        <td>
                            <a href="{{ route('machines.show', $machine->machine_id) }}"
                                class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('machines.edit', $machine->machine_id) }}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No machines found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Include pagination partial -->
        @include('partials.pagination', ['data' => $machines])
    </div>
@endsection
