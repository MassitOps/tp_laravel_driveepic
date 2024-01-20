@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-white">LISTE DES RÉSERVATION</h1>

        <table class="table">
            <thead>
                <tr>
                    <th class="text-white">ID Réservation</th>
                    <th class="text-white">Voiture</th>
                    <th class="text-white">Date de Début</th>
                    <th class="text-white">Date de Fin</th>
                    <th class="text-white">Actions/État</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td class="text-white">{{ $reservation->id }}</td>
                        <td class="text-white">{{ $reservation->car->brand }} {{ $reservation->car->model }}</td>
                        <td class="text-white">{{ $reservation->start_date }}</td>
                        <td class="text-white">{{ $reservation->end_date }}</td>
                        <td class="text-white">
                            @if(strtotime($reservation->end_date) < strtotime('-1 day'))
                                Terminée
                            @elseif(strtotime($reservation->start_date) <= strtotime(now()))
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal_{{ $reservation->id }}" style="height: 30px">
                                    Terminer
                                </button>
                            @else
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal_{{ $reservation->id }}" style="height: 30px">
                                    Annuler
                                </button>                                                   
                            @endif
                        </td>
                    </tr>

                    <div class="modal fade" id="confirmUpdateModal_{{ $reservation->id }}" tabindex="-1" aria-labelledby="confirmUpdateModalLabel_{{ $reservation->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmUpdateModalLabel_{{ $reservation->id }}">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vreiment terminer votre réservation ?
                                    <form method="POST" action="{{ route('reservations.update', ['reservation' => $reservation->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" class="form-control" id="newEndDate" name="end_date" value="{{ date('Y-m-d', strtotime('-1 day')) }}">
                                        <div class="modal-footer" style="border-top: none;">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Accepter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="confirmDeleteModal_{{ $reservation->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel_{{ $reservation->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel_{{ $reservation->id }}">Confirmation de Suppression</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir annuler la réservation ? Cette action est irréversible.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <form id="deleteForm_{{ $reservation->id }}" method="POST" action="{{ route('reservations.destroy', ['reservation' => $reservation->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
