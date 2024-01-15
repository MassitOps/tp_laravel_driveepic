@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Détails de la Voiture</h1>

        <div class="mb-3">
            <strong>ID:</strong> {{ $car->id }}<br>
            <strong>Marque:</strong> {{ $car->brand }}<br>
            <strong>Modele:</strong> {{ $car->model }}<br>
            <strong>Statut:</strong> {{ $car->status == 0 ? 'Disponible' : 'Occupé' }}<br>
        </div>

        <a href="{{ route('cars.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
@endsection
