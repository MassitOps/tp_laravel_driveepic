@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Cars List</h1>

        <a href="{{ route('cars.create') }}" class="btn btn-success mb-3">Create Car</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->status }}</td>
                        <td>
                            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
