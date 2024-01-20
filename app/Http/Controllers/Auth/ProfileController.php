<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('auth.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = auth()->user();
        $user->update($request->all());

        return redirect()->route('auth.profile.index')->with('success', 'Profil modifié avec succès.');
    }

    public function destroy()
    {
        $user = auth()->user();

        auth()->logout();

        $user->reservations()->delete();
        $user->delete();
    
        return redirect('/home')->with('success', 'Votre compte a été supprimé avec succès.');
    }
}