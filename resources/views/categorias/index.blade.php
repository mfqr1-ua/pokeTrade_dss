@extends('layouts.app')

@section('content')
<div>
    <h1 class="titulo">Categorías</h1>
</div>

<div class="catalogo">
    @foreach ($categorias as $categoria)
        <a href="{{ route('categorias.show', $categoria->id) }}" class="categoria-card">
            <div class="categoria-info">
                <h3>{{ $categoria->nombre }}</h3>
                <p>{{ $categoria->descripcion }}</p>
            </div>
        </a>
    @endforeach
</div>

<a href="{{ route('categorias.create') }}" class="btn-subir-categoria">
    Nueva categoría
</a>

<style>
    body {
        overflox-x: hidden;
    }

    .titulo {
        width: 93%;
        text-align: left;
        font-size: 22px;
        font-weight: bold;
        color: white;
        padding: 10px 20px;
        background-color: #606060;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .catalogo {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 0 20px;
        justify-content: left;
    }

    .categoria-card {
        width: 265px;
        background-color: #c0c0c0;
        border-radius: 10px;
        overflow: hidden;
        text-decoration: none;
        color: #333;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s ease-in-out;
    }

    .categoria-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }

    .categoria-imagen img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
    }

    .categoria-info {
        padding: 15px;
    }

    .categoria-info h3 {
        font-size: 20px;
        margin: 0 0 10px;
    }

    .categoria-info p {
        font-size: 14px;
        color: #666;
    }

    .btn-subir-categoria {
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

    .btn-subir-categoria:hover {
        background-color: #505050;
    }
</style>
@endsection
