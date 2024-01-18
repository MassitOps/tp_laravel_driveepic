@extends('layouts.app')

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@section('content')
    <div class="container">

        <div class="jumbotron mt-4">
            <h1 class="display-4 fw-bold text-white">BIENVENUE CHEZ DRIVEEPIC !</h1>
            <p class="lead fs-3 text-white">Votre partenaire de confiance pour une expérience de conduite exceptionnelle.</p>
            <hr class="my-3 border-top border-white">
            <p class="text-white fs-3">Nous vous proposons une large gamme de véhicules, allant des voitures élégantes aux SUV spacieux, pour répondre à tous vos besoins de déplacement.</p>
        </div>
        
        <br/>
        <br/>
        <br/>
        <br/>

        <h1 class="my-4 fw-bold text-white">DÉCOUVREZ NOS VOITURES</h1>

        <table class="table">
            <thead>
                <tr>
                    <th class="text-white">ID</th>
                    <th class="text-white">Marque</th>
                    <th class="text-white">Modele</th>
                    <th class="text-white">Statut</th>
                    <th class="text-white">Prix Journalier</th>
                    <th class="text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td class="text-white">{{ $car->id }}</td>
                        <td class="text-white">{{ $car->brand }}</td>
                        <td class="text-white">{{ $car->model }}</td>
                        <td class="text-white">
                            @if ($car->status == 0)
                                Disponible
                            @else
                                Occupé
                            @endif
                        </td>
                        <td class="text-white">{{ $car->price }} &nbsp; &nbsp; FCFA</td>
                        <td class="text-white">
                            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Détails/Louer</a>
                            @auth
                                @if(auth()->user()->isadmin)
                                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary">Modifier</a>
                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br/>
        <div class="text-center">
            <a href="{{ route('cars.index') }}" class="btn btn-primary fs-5 fw-bold" style="width: 120px;">Voir Plus</a>
        </div>
    </div>
@endsection
