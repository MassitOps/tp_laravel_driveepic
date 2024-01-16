@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Détails de la Voiture</h1>

        <div class="mb-3">
            <strong>ID:</strong> {{ $car->id }} <br>
            <strong>Marque:</strong> {{ $car->brand }} <br>
            <strong>Modele:</strong> {{ $car->model }} <br>
            <strong>Statut:</strong> {{ $car->status == 0 ? 'Disponible' : 'Occupé' }} <br>
            <strong>Prix:</strong> {{ $car->price }} <br>
        </div>

        @auth
            <div class="mb-3">
                <label for="days"><strong>Nombre de jours de location:</strong></label>
                <input type="number" id="days" name="days" min="1" value="1" onchange="updateTotal()">
                <p id="totalPrice" class="mt-2"><strong>Prix total: </strong><span id="calculatedPrice"> {{ $car->price }} FCFA</span></p>
            </div>

            <button onclick="rentCar()" class="btn btn-success">Louer</button>

            <div id="summary" style="display: none;">
                <a href="{{ route('cars.rent', ['car' => $car->id]) }}" class="btn btn-primary">Confirmer la location</a>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Se connecter pour Louer</a>
        @endauth

        <a href="{{ route('cars.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
    <script>
        let days = 1;

        function updateTotal() {
            days = document.getElementById('days').value;
            const price = {{ $car->price }};
            const totalPrice = (days * price) + " FCFA";

            document.getElementById('calculatedPrice').innerText = totalPrice;
        }

        function rentCar() {
            window.location.href = `{{ route('cars.rent', ['car' => $car->id]) }}?days=${days}`;
        }
    </script>
@endsection
