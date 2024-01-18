@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Utilisateurs ayant loué la voiture {{ $car->id }}</h1>

        @if ($users->count() > 0)
            <ul>
                @foreach ($users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        @else
            <p>Aucun utilisateur n'a loué cette voiture.</p>
        @endif
    </div>
@endsection