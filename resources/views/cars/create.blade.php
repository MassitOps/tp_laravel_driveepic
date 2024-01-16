@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Ajouter une Voiture</h1>

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="brand">Marque:</label>
                <input type="text" name="brand" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="model">Modele:</label>
                <input type="text" name="model" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Statut:</label>
                <select name="status" class="form-control" required>
                    <option value="0">Disponible</option>
                    <option value="1">Occupé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Prix:</label>
                <input type="number" name="price" class="form-control" value=0 min="0" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter la Voiture</button>
        </form>
    </div>
@endsection
