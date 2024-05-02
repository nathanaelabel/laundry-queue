@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Edit Machine</h2>

        <form action="{{ route('machines.update', $machine->machine_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $machine->name }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" {{ $machine->status == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="inactive" {{ $machine->status == 'In Use' ? 'selected' : '' }}>In Use</option>
                    <option value="inactive" {{ $machine->status == 'Out of Service' ? 'selected' : '' }}>Out of Service
                    </option>
                </select>

                <button type="submit" class="btn btn-primary">Update Machine</button>
        </form>
    </div>
@endsection
