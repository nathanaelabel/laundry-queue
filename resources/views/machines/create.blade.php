@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Add Machine</h2>

        <form action="{{ route('machines.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Available">Available</option>
                    <option value="In Use">In Use</option>
                    <option value="Out of Service">Out of Service</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Machine</button>
        </form>
    </div>
@endsection
