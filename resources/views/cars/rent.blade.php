@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Récapitulatif de la Location</h1>

        @php
            setlocale(LC_TIME, 'fr_FR.utf8', 'fr_FR', 'fr');
        @endphp

        <div class="mb-3">
            <strong>Nombre de Jours:</strong> {{ $days }} <br>
            <strong>Prix Total:</strong> {{ $car->price * $days }} FCFA <br>
        </div>
        
        <div class="mb-3">
            <strong>Date de Début:</strong> {{ ucfirst(strftime('%A %e %B %Y', strtotime($start_date))) }} <br>
            <strong>Date de Fin:</strong> {{ ucfirst(strftime('%A %e %B %Y', strtotime($end_date))) }} <br>
        </div>
        
        <span>La Facture sera réglée lors de la récupération du véhicule à l'agence.</span><br/>

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">

            <button type="submit" class="btn btn-success">Louer</button>
        </form>

        <a href="{{ route('cars.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>

    @if(session('success'))
        <script>
            Toastr.success('{{ session('success') }}');
        </script>
    @endif
@endsection
