@extends('layouts.app')

@section('content')
<div>
    <h1>{{ $categoria->nombre }}</h1>
    <p>{{ $categoria->descripcion }}</p>
</div>

<div>
    @if (count($cartasSeleccionadas) > 0)
        <div class="catalogo-cartas">
            @foreach ($cartasSeleccionadas as $carta)
                <a href="{{ route('cartas.show', $carta['id_carta_api']) }}" class="carta-card-link">
                    <div class="carta-card">
                        <img src="{{ $carta['imagen'] }}" class="carta-imagen">
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <p class="sin-cartas">Aún no se han elegido cartas para esta categoría.</p>
    @endif
</div>

<div class="botones-fijos">
    <a href="{{ route('categorias.index') }}" class="btn">
        <button> Volver </button>
    </a>

    <a href="{{ route('cartas.select_cartas', ['categoria' => $categoria->id]) }}" class="btn">
        <button> Añadir cartas </button>
    </a>
</div>

<style>
    body {
        overflow-x: hidden;
        margin-bottom: 100px;
    }

    h1 {
        width: 93%;
        text-align: left;
        font-size: 22px;
        font-weight: bold;
        color: white;
        padding: 10px 20px;
        background-color: #606060;
        border-radius: 10px;
    }

    p {
        width: 93%;
        text-align: left;
        font-size: 16px;
        font-weight: bold;
        color: #606060;
        padding: 10px 20px;
        background-color: #c0c0c0;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .botones-fijos {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 20px;
        z-index: 1000;
    }

    button {
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

    button:hover {
        background-color: #505050;
    }

    .catalogo-cartas {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
    }

    .carta-card {
        width: 250px;
    }

    .carta-card:hover {
        transform: scale(1.05);
    }

    .carta-imagen {
        width: 100%;
        height: auto;
        border-radius: 6px;
        object-fit: cover;
    }

    .sin-cartas {
        color: #a94442;
        font-weight: bold;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        padding: 10px 20px;
        margin: 10px 20px;
        border-radius: 6px;
        transform: translateX(-20px);
    }
</style>
@endsection