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

    .carta-container {
        max-width: 1000px;
        margin: 30px auto;
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: center;
    }

    .carta-imagen img {
        width: 300px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .vendedores {
        flex: 1;
        min-width: 300px;
    }

    .content-section {
        display: flex;
        margin-top: 20px;
        gap: 15px;
        margin-left: 5px;
    }

    .vendedor {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
    }

    .vendedor h4 {
        margin: 0 0 5px;
    }

    html, body {
        overflow-x: hidden;
        overflow-y: auto;
    }

</style>

<div class="carta-container">
    <div class="carta-imagen">
        @if($imagenCarta)
            <img src="{{ $imagenCarta }}" alt="Imagen de la carta {{ $carta->nombre_carta_api }}">
        @else
            <p>Imagen no disponible</p>
        @endif
    </div>

    <h2 class="text-xl font-bold mt-6 mb-2">Vendedores disponibles</h2>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 text-left">Vendedor</th>
                <th class="py-2 px-4 text-left">Estado</th>
                <th class="py-2 px-4 text-left">Precio</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vendedores as $v)
                <tr class="border-t">
                    <td class="py-2 px-4">{{ $v->vendedor }}</td>
                    <td class="py-2 px-4">{{ ucfirst($v->estado) }}</td>
                    <td class="py-2 px-4">{{ number_format($v->precio, 2) }} €</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-4 px-4 text-center text-gray-500">No hay vendedores disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
