@extends('layouts.app')

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="my-4 fw-bold text-white">LISTE DES VOITURES</h1>
    
            @auth
                @if(auth()->user()->isadmin)
                    <a href="{{ route('cars.create') }}" class="btn btn-success mb-3 fw-bold fs-5" style="margin-right: 7.5%">AJOUTER UNE VOITURE</a>
                @endif
            @endauth
        </div>

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
    </div>
@endsection
