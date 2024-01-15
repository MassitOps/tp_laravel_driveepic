@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Create Car</h1>

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" name="brand" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" name="model" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" name="status" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Car</button>
        </form>
    </div>
@endsection
