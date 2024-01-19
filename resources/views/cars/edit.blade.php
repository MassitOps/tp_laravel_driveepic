@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 fw-bold text-white">MODIFIER LES DÉTAILS DE LA VOITURE</h1>

        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="brand" class="text-white">Marque:</label>
                <input type="text" name="brand" class="form-control" value="{{ $car->brand }}" required>
            </div>
            <br/>
            <div class="form-group">
                <label for="model" class="text-white">Modele:</label>
                <input type="text" name="model" class="form-control" value="{{ $car->model }}" required>
            </div>
            <br/>
            <div class="form-group">
                <label for="status" class="text-white">Statut:</label>
                <select name="status" class="form-control" required>
                    <option value="0" @if($car->status == 0) selected @endif>Disponible</option>
                    <option value="1" @if($car->status == 1) selected @endif>Occupé</option>
                </select>
            </div>
            <br/>
            <div class="form-group">
                <label for="price" class="text-white">Prix:</label>
                <input type="number" name="price" class="form-control" value="{{ $car->price }}" min="0" required>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
