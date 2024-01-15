@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Car Details</h1>

        <div class="mb-3">
            <strong>ID:</strong> {{ $car->id }}<br>
            <strong>Brand:</strong> {{ $car->brand }}<br>
            <strong>Model:</strong> {{ $car->model }}<br>
            <strong>Status:</strong> {{ $car->status }}<br>
        </div>

        <a href="{{ route('cars.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection
