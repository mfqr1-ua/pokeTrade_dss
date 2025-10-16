@extends('layouts.app')

@section('content')

<!-- Barra superior fija con botones -->
<div style="position: fixed; top: 0; left: 0; width: 100%; background: #f9f9f9; padding: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); z-index: 999;">
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <a href="{{ route('inicio') }}" style="background-color: #007bff; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Inicio</a>
        <a href="{{ route('admin.index') }}" style="background-color: #343a40; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Admin</a>
        <a href="{{ url('/cartas/buscar') }}" style="background-color: #17a2b8; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Buscar carta</a>
        <a href="{{ route('cartas.mis') }}" style="background-color: #6f42c1; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Mis cartas</a>
    </div>
</div>

<!-- Espacio para evitar que el contenido quede oculto por la barra -->
<div style="height: 65px;"></div>

<form method="GET" action="{{ route('cartas.mis') }}" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-bottom: 20px;">
    <input type="text" name="query" placeholder="Buscar por nombre" value="{{ request('query') }}"
        style="padding: 6px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">

    <select name="orden" style="padding: 6px; border-radius: 5px; border: 1px solid #ccc;">
        <option value="">Ordenar por precio</option>
        <option value="asc" {{ request('orden') === 'asc' ? 'selected' : '' }}>Menor a mayor</option>
        <option value="desc" {{ request('orden') === 'desc' ? 'selected' : '' }}>Mayor a menor</option>
    </select>

    <button type="submit"
        style="padding: 6px 12px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
        Aplicar
    </button>
</form>

<div class="container">
    <h1 style="text-align: center;">Cartas subidas por todos los usuarios</h1>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; padding: 10px;">
        @foreach($cartas as $carta)
            <div style="border: 1px solid #ccc; padding: 8px; border-radius: 6px; background: #fff; font-size: 14px;">
                <p><strong>Nombre:</strong> {{ $carta['nombre_carta_api'] }}</p>
                <p><strong>Rareza:</strong> {{ $carta->rareza }}</p>
                <p><strong>Estado:</strong> {{ $carta->estado }}</p>
                <p><strong>Precio:</strong> {{ $carta->precio }} €</p>
                <p><strong>Fecha:</strong> {{ $carta->fecha_adquisicion }}</p>

                <a href="{{ route('cartas.edit', $carta->id) }}" 
                    style="background-color: blue; color: white; padding: 5px; text-decoration: none; border-radius: 4px;">
                    Editar
                </a>

                <form action="{{ route('cartas.destroy', $carta->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            style="width: 100%; background-color: #dc3545; color: white; border: none; padding: 6px;
                                   border-radius: 4px; cursor: pointer; font-size: 12px;">
                        Eliminar
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>

@endsection
