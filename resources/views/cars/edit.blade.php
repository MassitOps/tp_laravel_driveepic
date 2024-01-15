@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Modifier les détails de la Voiture</h1>

        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="brand">Marque:</label>
                <input type="text" name="brand" class="form-control" value="{{ $car->brand }}" required>
            </div>
            <div class="form-group">
                <label for="model">Modele:</label>
                <input type="text" name="model" class="form-control" value="{{ $car->model }}" required>
            </div>
            <div class="form-group">
                <label for="status">Statut:</label>
                <select name="status" class="form-control" required>
                    <option value="0" @if($car->status == 0) selected @endif>Disponible</option>
                    <option value="1" @if($car->status == 1) selected @endif>Occupé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
