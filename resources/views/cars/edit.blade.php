@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Edit Car</h1>

        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" name="brand" class="form-control" value="{{ $car->brand }}" required>
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" name="model" class="form-control" value="{{ $car->model }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" name="status" class="form-control" value="{{ $car->status }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Car</button>
        </form>
    </div>
@endsection
