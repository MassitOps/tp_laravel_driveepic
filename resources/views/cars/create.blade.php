@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 fw-bold text-white">AJOUTER UNE VOITURE</h1>

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="brand" class="text-white">Marque:</label>
                <input type="text" name="brand" class="form-control" required>
            </div>
            <br/>
            <div class="form-group">
                <label for="model" class="text-white">Modele:</label>
                <input type="text" name="model" class="form-control" required>
            </div>
            <br/>
            <div class="form-group">
                <label for="status" class="text-white">Statut:</label>
                <select name="status" class="form-control" required>
                    <option value="0">Disponible</option>
                    <option value="1">Occupé</option>
                </select>
            </div>
            <br/>
            <div class="form-group">
                <label for="price" class="text-white">Prix:</label>
                <input type="number" name="price" class="form-control" value=10000 min="10000" required>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Ajouter la Voiture</button>
        </form>
    </div>
@endsection
