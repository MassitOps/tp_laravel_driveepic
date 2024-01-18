<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function home()
    {
        $cars =  Car::take(4)->get();
        return view('home', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'status' => 'required',
        ]);

        Car::create($request->all());

        return redirect()->route('cars.index')->with('succès', 'Voiture crée avec succès.');
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.show', compact('car'));
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'status' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        $car = Car::findOrFail($id);
        $car->update($request->all());

        return redirect()->route('cars.index')->with('succès', 'Voiture modifiée avec succès.');
    }

    public function rent(Car $car)
    {
        return view('cars.rent', [
            'car' => $car,
            'days' => request('days'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
        ]);
    }

    public function showUsers($carId)
    {
        $car = Car::findOrFail($carId);
        $users = $car->users->unique();

        return view('cars.show_users', compact('car', 'users'));
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('succès', 'Voiture supprim"e avec succès.');
    }

    public function __construct()
    {
        $this->middleware('admin')->only('create', 'edit', 'destroy');
        $this->middleware('auth')->only('rent', 'showUsers');
    }
}
