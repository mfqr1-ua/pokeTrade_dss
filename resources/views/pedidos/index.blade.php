@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column align-items-end justify-content-start">
    <!-- Título alineado a la derecha -->
    <div class="titulo-pedidos">
        <h1 class="titulo-texto text-end">Lista de Pedidos</h1>
    </div>

    <!-- Tabla alineada a la derecha con mismo ancho -->
    <div class="tabla-pedidos">
        <table class="table tabla-estilizada m-0">
            <thead>
                <tr>
                    <th>ID</th> <!-- Nueva columna -->
                    <th>Dirección de envío</th>
                    <th>Fecha de pedido</th>
                    <th>Productos</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td> <!-- Mostrar ID -->
                        <td>{{ $pedido->direccion_envio }}</td>
                        <td>{{ $pedido->fecha_pedido }}</td>
                        <td>
                            <div class="mt-2">
                                <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-primary">Ver detalles</a>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    html, body {
        overflow-x: hidden;
    }

    .titulo-pedidos {
        width: 93%;
        background-color: #606060;
        padding: 10px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .tabla-pedidos {
        width: 95%;
        padding: 0;
        background-color: transparent;
    }

    .titulo-texto {
        color: white;
        margin: 0;
        text-align: left;
        font-size: 22px;
    }

    .tabla-estilizada {
        width: 100%;
        background-color: #eaeaea;
        border-radius: 10px;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    .tabla-estilizada thead tr {
        background-color: #ddd;
        font-weight: bold;
    }

    .tabla-estilizada th,
    .tabla-estilizada td {
        padding: 10px 15px;
        text-align: center;
        vertical-align: middle;
        border-bottom: 1px solid #ccc;
    }

    .tabla-estilizada tr:last-child td {
        border-bottom: none;
    }

    .tabla-estilizada th:first-child {
        border-top-left-radius: 10px;
    }

    .tabla-estilizada th:last-child {
        border-top-right-radius: 10px;
    }

    .tabla-estilizada tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
    }

    .tabla-estilizada tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
    }
</style>
@endsection
