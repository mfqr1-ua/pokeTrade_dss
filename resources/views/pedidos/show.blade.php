@extends('layouts.app')

@section('content')
<div class="section-bar">
    Detalles del Pedido #{{ $pedido->id }}
</div>

<div class="main">
    <div class="info">
        <div class="arriba">
            <p><strong style="color: #505050;">Dirección</strong><br>
                <span style="color: #606060;">{{ $pedido->direccion_envio }}</span>
            </p>
            <p><strong style="color: #505050;">Fecha</strong><br>
                <span style="color: #606060;">{{ $pedido->fecha_pedido }}</span>
            </p>
        </div>

        <a href="{{ route('pedidos.index') }}">
            <button type="button">
                VOLVER
            </button>
        </a>
    </div>

    <div class="productos-section">
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Rareza</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $parts = explode('-', $pedido->id_carta_api);
                    $set = $parts[0] ?? '';
                    $number = $parts[1] ?? '';
                @endphp
                <tr>
                    <td>
                        <img src="https://images.pokemontcg.io/{{ $set }}/{{ $number }}_hires.png"
                             width="80" alt="{{ $pedido->nombre_carta_api }}">
                    </td>
                    <td>{{ $pedido->nombre_carta_api }}</td>
                    <td>{{ number_format($pedido->precio, 2) }} €</td>
                    <td>{{ $pedido->rareza ?? 'Desconocida' }}</td>
                    <td>{{ $pedido->estado_carta ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    html, body {
        overflow-x: hidden;
    }

    .arriba {
        background-color: #f0f0f0;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .section-bar {
        background-color: #606060;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
        max-width: 1221px;
        display: flex;
        align-items: center;
        justify-content: start;
        margin-top: 5px;
        margin-left: 5px;
        color: white;
        border-radius: 10px;
    }

    .main {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: flex-start;
        padding: 20px;
        margin-left: 5px;
        gap: 30px;
    }

    .productos-section {
        flex: 1;
        min-width: 300px;
        max-width: 875px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        background-color: #f0f0f0;
        border-radius: 8px;
        overflow: hidden;
    }

    thead {
        background-color: #f0f0f0;
    }

    th, td {
        padding: 10px 15px;
        text-align: left;
        border-bottom: 1px solid #000;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:nth-child(even) {
        background-color: #f0f0f0;
    }

    .text-center {
        text-align: center;
    }

    button {
        background: #606060;
        font-weight: bold;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
    }

    button:hover {
        background: #505050;
    }

    @media (max-width: 768px) {
        .info-productos-container {
            flex-direction: column;
        }

        .tabla-box {
            max-width: 100%;
        }
    }
</style>
@endsection
