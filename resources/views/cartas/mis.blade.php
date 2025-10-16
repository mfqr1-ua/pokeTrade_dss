@extends('layouts.app')

@section('content')

<style>
    body, html {
        overflow-x: hidden;
    }

    .container-cartas {
        max-width: 1200px;
        margin-left: 10px;
        padding: 20px;
    }

    .titulo-cartas {
        text-align: center;
        text-align: left;
        font-size: 22px;
        color: white;
        padding: 10px 20px;
        background-color: #606060;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: bold;
        margin-top: 10px;
        margin-left: 5px;
        margin-right: 5px;
    }

    .mensaje-exito {
        color: green;
        text-align: center;
        margin-bottom: 10px;
    }

    .grid-cartas {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 10px;
    }

    .carta-item {
        border: 1px solid #ccc;
        padding: 12px;
        border-radius: 6px;
        box-shadow: 1px 1px 6px rgba(0, 0, 0, 0.08);
        background: #ccc;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        font-size: 14px;
        color: white;
    }

    .carta-item p {
        margin: 4px 0;
    }

    .acciones-carta {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
    }

    .btn-editar {
        background-color: #007bff;
        color: white;
        padding: 6px 10px;
        text-decoration: none;
        border-radius: 4px;
    }

    .btn-eliminar {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-subir-carta {
        position: fixed;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #606060;
        color: white;
        padding: 14px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 18px;
        font-weight: bold;
    }
    .btn-subir-carta:hover {
        background-color: #505050;
    }
</style>

<div class="container-cartas">
    <h1 class="titulo-cartas">Mis cartas subidas</h1>

    @if(session('success'))
        <div class="mensaje-exito">{{ session('success') }}</div>
    @endif

    <div class="grid-cartas">
        @foreach($cartas as $carta)
            <div class="carta-item">
                <p><strong>Nombre:</strong> {{ $carta['nombre'] }}</p>
                <p><strong>Rareza:</strong> {{ $carta['rareza'] }}</p>
                <p><strong>Estado:</strong> {{ $carta['estado'] }}</p>
                <p><strong>Precio:</strong> {{ $carta['precio'] }} €</p>
                <p><strong>Fecha:</strong> {{ $carta['fecha_adquisicion'] }}</p>

                <div class="acciones-carta">
                    <a href="{{ route('cartas.edit', $carta['id']) }}" class="btn-editar">
                        Editar
                    </a>

                    <form action="{{ route('cartas.destroy', $carta['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div>
        <a href="{{ url('/cartas/buscar') }}" class="btn-subir-carta">
            + Subir nueva carta
        </a>
    </div>
</div>

@endsection
