<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\ReservationUpdated;

class ReservationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $reservations = Reservation::where('user_id', $userId)->orderByDesc('start_date')->orderByDesc('end_date')->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'car_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $reservation = Reservation::create($request->all());

        event(new ReservationUpdated($reservation));

        return redirect()->route('cars.index')->with('success', 'Réservation créée avec succès!');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'La réservation a été supprimée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'end_date' => 'required'
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'La réservation a été terminée avec succès.');
    }
}
