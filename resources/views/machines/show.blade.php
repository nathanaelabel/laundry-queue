@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Machine Detail</h2>

        <div>
            <p><strong>Name:</strong> {{ $machine->name }}</p>
            <p><strong>Status:</strong> {{ $machine->status }}</p>
        </div>

        <div class="mt-3">
            <a href="{{ route('machines.edit', $machine->machine_id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
@endsection
