@extends('layouts.app')

@section('content')
<div class="contenedor">
    <h1>Seleccionar Cartas para: {{ $categoria->nombre }}</h1>

    @if ($errors->any())
        <div class="alerta-errores">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categorias.cartas.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="catalogo-cartas">
            @foreach ($cartas as $carta)
                <label class="carta-card">
                    <div class="carta-info">
                        <img src="{{ $carta['imagen'] }}" alt="Carta Pokémon">
                    </div>
                    <input type="checkbox" name="id_carta[]" value="{{ $carta['id_carta_api'] }}">
                </label>
            @endforeach
        </div>

        <div class="acciones">
            <button type="submit">Guardar</button>

            <a href="{{ route('categorias.show', $categoria->id) }}"><button type="button">Cancelar</button></a>
        </div>
    </form>
</div>

<style>
    .contenedor {
        padding: 20px;
    }

    h1 {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        background-color: #606060;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        text-align: left;
        width: 93%;
    }

    .catalogo-cartas {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .carta-card {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 15px;
        background-color: #f9f9f9;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        gap: 10px;
        transition: background-color 0.2s ease;
    }

    .carta-imagen {
        width: 100%;
        height: auto;
        border-radius: 6px;
        object-fit: cover;
    }

    .carta-card:hover {
        background-color: #ececec;
    }

    .carta-card input {
        margin-right: 10px;
    }

    .carta-info img {
        align-items: center;
        width: 180px;
        height: auto;
    }

    .acciones {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 20px;
        z-index: 1000;
    }

    .acciones button {
        background-color: #606060;
        color: white;
        padding: 14px 20px;
        border-radius: 10px;
        border: none;
        font-size: 18px;
        font-weight: bold;
        width: 160px;
        cursor: pointer;
    }

    .acciones button:hover {
        background-color: #505050;
    }

    .alerta-errores {
        background-color: #ffdddd;
        color: #a94442;
        border: 1px solid #ebccd1;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
</style>
@endsection
