@extends('layouts.app')

@section('content')
    <div class="container">
        
        <h1 class="my-4">Liste des Voitures</h1>

        <a href="{{ route('cars.create') }}" class="btn btn-success mb-3">Ajouter une Voiture</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marque</th>
                    <th>Modele</th>
                    <th>Statut</th>
                    <th>Prix Journalier</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>
                            @if ($car->status == 0)
                                Disponible
                            @else
                                Occupé
                            @endif
                        </td>
                        <td>{{ $car->price }} &nbsp; &nbsp; FCFA</td>
                        <td>
                            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info">Détails/Louer</a>
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
