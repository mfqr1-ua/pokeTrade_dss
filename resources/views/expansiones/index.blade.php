@extends('layouts.app')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    body, html {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        background-color: white;
        width: 100vw;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h2 {
        margin-top: 35px;
        background-color: #505050;
        color: white; 
        padding: 10px 20px;
        border-radius: 10px;
        text-align: left;
    }

    .expansion-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
        margin-top: 20px;
        justify-items: center;
    }

    .expansion-card {
        text-align: center;
        width: 150px;
        text-decoration: none;
        color: inherit;
    }

    .expansion-card img {
        width: 100%;
        height: 100px;
        object-fit: contain;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: white;
        padding: 5px;
    }

    .expansion-card p {
        margin-top: 8px;
        font-size: 14px;
    }

    .nombre-expansion {
        margin-top: 35px;
        background-color: #c0c0c0;
        color: #606060; 
        padding: 10px 20px;
        border-radius: 10px;
        text-align: center;
    }
    
</style>

<div class="container">
    <h2>Expansiones</h2>
    <div class="expansion-grid">
        @forelse ($expansiones as $expansion)
            <a href="{{ route('cartas.expansion', ['codigo' => $expansion['id']]) }}" class="expansion-card">
                <img src="{{ $expansion['images']['logo'] ?? asset('imagenes/default_expansion.png') }}"
                     alt="{{ $expansion['name'] }}">
                <p class="nombre-expansion">{{ $expansion['name'] }}</p>
            </a>
        @empty
            <p>No se encontraron expansiones.</p>
        @endforelse
    </div>
</div>
@endsection
