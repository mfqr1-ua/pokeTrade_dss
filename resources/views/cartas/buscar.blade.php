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
        text-align: left;
        color: white;
        border-radius: 10px;
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

    p {
        color: white;
        font-size: 16px;
        font-weight: bold;
        padding: 10px 20px;
        text-align: center;
        background-color: #C0C0C0;
        border-radius: 10px;
        margin-top: 10px;
        margin-bottom: 1px;
    }

    /* QUITAR SCROLL HORIZONTAL */
    html, body {
        overflow-x: hidden;
    }
</style>

<div class="container">
    <!-- <h1>Buscar cartas Pokémon</h1> -->

    <form method="GET" action="{{ route('cartas.buscar') }}" class="search-form">
    <input type="text" name="query" placeholder="Nombre o tipo" value="{{ request('query') }}" required>
    <button type="submit">Buscar</button>
</form>


    @if(isset($cartas))
        <div class="section-bar">Resultados</div>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
            @foreach($cartas as $carta)
                <div style="padding: 10px; text-align: center; border-radius: 8px; display: flex; flex-direction: column; align-items: center;">
                    <img src="{{ $carta['images']['small'] }}" alt="Carta" width="120">
                    <p><strong>Nombre:</strong> {{ $carta['name'] }}</p>

                    <div style="margin-top: auto; padding-top: 10px; width: 100%; display: flex; justify-content: center;">
                        @auth
                            <form method="GET" action="{{ route('cartas.create') }}">
                                <input type="hidden" name="id_carta_api" value="{{ $carta['id'] }}">
                                <input type="hidden" name="nombre_carta_api" value="{{ $carta['name'] }}">
                                <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
                                    Seleccionar esta carta
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; text-decoration: none; display: inline-block;">
                                Seleccionar esta carta
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
