@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 fw-bold text-white">RÉCAPITULATIF DE LOCATION</h1>

        @php
            setlocale(LC_TIME, 'fr_FR.utf8', 'fr_FR', 'fr');
        @endphp

        <div class="mb-3 fs-5 text-white">
            <strong>Nombre de Jours:</strong> {{ $days }} <br>
            <strong>Prix Total:</strong> {{ $car->price * $days }} FCFA <br>
        </div>
        
        <div class="mb-3 fs-5 text-white">
            <strong>Date de Début:</strong> {{ ucfirst(strftime('%A %e %B %Y', strtotime($start_date))) }} <br>
            <strong>Date de Fin:</strong> {{ ucfirst(strftime('%A %e %B %Y', strtotime($end_date))) }} <br>
        </div>
        
        <span class="fs-4 fw-bold text-white">La Facture sera réglée lors de la récupération du véhicule à l'agence.</span>
        <br/>
        <br/>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">
            
            <button type="submit" class="btn btn-primary">Louer</button>
            <a href="{{ route('cars.index') }}" class="btn btn-primary" style="margin-left: 20px">Retour à la liste</a>
        </form>

    </div>

    @if(session('success'))
        <script>
            Toastr.success('{{ session('success') }}');
        </script>
    @endif
@endsection
