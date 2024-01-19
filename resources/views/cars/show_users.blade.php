@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-white">UTILISATEURS AYANT LOUÉ MA VOITURE {{ $car->id }}</h1>

        @if ($users->count() > 0)
            <ul>
                @foreach ($users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        @else
            <p class="fs-3 text-white">Aucun utilisateur n'a loué cette voiture.</p>
        @endif
    </div>
@endsection