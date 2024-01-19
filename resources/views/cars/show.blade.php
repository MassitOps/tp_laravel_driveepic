@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="my-4 fw-bold text-white">DÉTAILS DE LA VOITURE</h1>
        
                <div class="mb-3 fs-5 text-white">
                    <strong>ID:</strong> {{ $car->id }} <br>
                    <strong>Marque:</strong> {{ $car->brand }} <br>
                    <strong>Modele:</strong> {{ $car->model }} <br>
                    <strong>Prix:</strong> {{ $car->price }} <br>
                    <strong>Statut:</strong> {{ $car->status == 0 ? 'DISPONIBLE' : 'OCCUPÉ' }} <br>
                </div>
        
                @if(!$car->status)
                    @auth
                        <div class="mb-3 fs-5 text-white">
                            <label for="start_date"><strong>Date de début:</strong></label><br/>
                            <input type="date" id="start_date" name="start_date" min="{{ now()->toDateString() }}" value="{{ now()->toDateString() }}" required onchange="updateEndDate()">
                        </div>
        
                        <div class="mb-3 fs-5 text-white">
                            <label for="end_date"><strong>Date de fin:</strong></label><br/>
                            <input type="date" id="end_date" name="end_date" readonly>
                        </div>
        
                        <div class="mb-3 fs-5 text-white">
                            <label for="days"><strong>Nombre de jours de location:</strong></label><br/>
                            <input type="number" id="days" name="days" min="1" value="1" required onchange="updateEndDate()" style="width: 175px;">
                            <p id="totalPrice" class="mt-2"><strong>Prix total: </strong><span id="calculatedPrice"> {{ $car->price }} FCFA</span></p>
                        </div>
        
                        <button onclick="rentCar()" class="btn btn-primary" style="margin-right: 20px">Louer</button>
                        <a href="{{ route('cars.index') }}" class="btn btn-primary">Retour à la liste</a>
        
                        <div id="summary" style="display: none;">
                            <a href="{{ route('cars.rent', ['car' => $car->id]) }}" class="btn btn-primary">Confirmer la location</a>
                        </div>
        
                        <div class="mt-3">
                            <a href="{{ route('cars.show_users', ['car' => $car->id]) }}" class="btn btn-primary">Voir les personnes ayant loué ce véhicule</a>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Se connecter pour Louer</a>
                    @endauth
                @endif
            </div>
            @php
                $brandLower = strtolower($car->brand);
                $modelLower = strtolower($car->model);
                $imgPathPNG = 'images/cars/' . $car->id . '_' . $brandLower . '_' . $modelLower . '.png';
                $imgPathJPG = 'images/cars/' . $car->id . '_'  . $brandLower . '_' . $modelLower . '_' . '.jpg';
            @endphp
            <div class="col-md-6 mt-5">
                @if(file_exists(public_path($imgPathPNG)))
                    <img src="{{ asset($imgPathPNG) }}" alt="{{ $car->brand }} {{ $car->model }}" class="img-fluid mt-5 border border-secondary bg-dark" style="border-radius: 15px">
                @else
                    <img src="{{ asset($imgPathJPG) }}" alt="{{ $car->brand }} {{ $car->model }}" class="img-fluid mt-5 border border-secondary bg-dark" style="border-radius: 15px">
                @endif
            </div>
        </div>
    </div>

    <script>
        function updateEndDate() {
            const startDate = new Date(document.getElementById('start_date').value);
            const days = parseInt(document.getElementById('days').value);

            if (!isNaN(startDate.getTime()) && !isNaN(days)) {
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + days);

                document.getElementById('end_date').valueAsDate = endDate;
                updateTotal();
            }
        }

        function updateTotal() {
            const days = parseInt(document.getElementById('days').value);
            const price = {{ $car->price }};
            const totalPrice = (days * price) + " FCFA";

            document.getElementById('calculatedPrice').innerText = totalPrice;
        }

        function rentCar() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const days = document.getElementById('days').value;
            const url = `{{ route('cars.rent', ['car' => $car->id]) }}?start_date=${startDate}&end_date=${endDate}&days=${days}`;
            window.location.href = url;
        }

        document.addEventListener('DOMContentLoaded', function () {
        var currentDate = new Date();
        currentDate.setDate(currentDate.getDate() + 1);
        var formattedDate = currentDate.toISOString().slice(0, 10);
        document.getElementById('end_date').value = formattedDate;
    });
    </script>
@endsection
