{{-- @extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Machine List</h2>
            <a href="{{ route('machines.create') }}" class="btn btn-success">New Machine</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($machines as $index => $machine)
                    <tr>
                        <td>{{ $machines->firstItem() + $index }}</td>
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
@endsection --}}

@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Machine</h2>
            <a href="{{ route('machines.create') }}" class="btn btn-success">New Machine</a>
        </div>

        <div class="row justify-content-center">
            @forelse ($machines as $machine)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $machine->name }}</h5>
                            <p class="card-text">{{ $machine->status }}</p>
                            <a href="{{ route('machines.show', $machine->machine_id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('machines.edit', $machine->machine_id) }}" class="btn btn-info btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No machines found</p>
                </div>
            @endforelse
        </div>

        <!-- Include pagination partial -->
        @include('partials.pagination', ['data' => $machines])
    </div>
@endsection

