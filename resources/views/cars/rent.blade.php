@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Récapitulatif de la Location</h1>

        <div class="mb-3">
            <strong>Nombre de Jours:</strong> {{ $days }} <br>
            <strong>Prix Total:</strong> {{ $car->price * $days }} <br>
        </div>

        <button class="btn btn-success">Louer</button>

        <a href="{{ route('cars.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
@endsection
