@extends('layouts.app')

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Succès!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Réservation éffectuée avec succès.
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        });
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
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal_{{ $car->id }}">
                                        Supprimer
                                    </button>

                                    <div class="modal fade" id="confirmDeleteModal_{{ $car->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel_{{ $car->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-dark text-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel_{{ $car->id }}">Confirmation de Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cette voiture ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form method="POST" action="{{ route('cars.destroy', ['car' => $car->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
