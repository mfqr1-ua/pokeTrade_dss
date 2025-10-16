@extends('layouts.app')

@section('content')

<style>
    .container {
        max-width: 1200px;
        margin-left: 5px;
        margin-right: auto;
        padding: 20px;
        text-align: center;
    }

    .top-bar {
        background-color: #ddd;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }

    .section-bar {
        background-color: #606060;
        color: white;
        border-radius: 10px;
        text-align: left;
        padding: 10px 20px;
        font-size: 22px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: start;
        margin-top: 10px;
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        padding: 20px;
        justify-content: center;
    }

    .card img {
        width: 100%;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .card img:hover {
        transform: scale(1.05);
    }

    .search-form {
        margin: 20px auto;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .search-form input {
        padding: 10px;
        width: 1000px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .search-form button {
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    html, body {
        overflow-x: hidden;
    }

    a.card {
        text-decoration: none;
    }
</style>

<div class="section-bar">Catálogo</div>

<!-- Formulario de búsqueda -->
<form method="GET" action="{{ route('catalogo') }}" class="search-form">
    <input type="text" name="nombre" placeholder="Buscar cartas por nombre" value="{{ request('nombre') }}">
    <button type="submit">Buscar</button>
</form>

@if($cartas->isEmpty())
    <p style="text-align: center; margin-top: 20px;">No se encontraron cartas.</p>
@else
    <div class="cards-container">
        @foreach($cartas as $carta)
            @if(isset($carta['imagen']))
                <a href="{{ url('/cartas/' . $carta['id']) }}" class="card">
                    <img src="{{ $carta['imagen'] }}" alt="Carta Pokémon">
                </a>
            @endif
        @endforeach
    </div>
@endif

<div class="mt-6 flex justify-center">
    {{ $cartasOriginales->links('vendor.pagination.custom') }}
</div>

@endsection
