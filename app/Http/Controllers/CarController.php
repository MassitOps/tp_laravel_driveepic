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
        ]);

        $car = Car::findOrFail($id);
        $car->update($request->all());

        return redirect()->route('cars.index')->with('succès', 'Voiture modifiée avec succès.');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('succès', 'Voiture supprim"e avec succès.');
    }
}
