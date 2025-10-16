@extends('layouts.app')

@section('content')

<div style="max-width: 900px; margin: 0 auto; padding: 10px 20px 20px 20px; font-size: 16px;">
    <h1 style="text-align: center; margin: 40px 0 10px 0;">Editar Usuario</h1>

    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">

    <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
        @csrf

        <input type="text" name="name" value="{{ $usuario->name }}" placeholder="Nombre" required style="padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">

        <input type="email" name="email" value="{{ $usuario->email }}" placeholder="Email" required style="padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">

        <input type="text" name="direccion" value="{{ $usuario->direccion }}" placeholder="Dirección" style="padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">

        <input type="text" name="numTelf" value="{{ $usuario->numTelf }}" placeholder="Número de Teléfono" style="padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">

        <button type="submit" style="padding: 12px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;">
            GUARDAR CAMBIOS
        </button>
    </form>

</div>

<!-- Filtro y búsqueda siempre visibles -->
<div style="display: flex; justify-content: center; margin: 30px 0 20px 0;">
    <form action="{{ route('admin.usuarios.edit', $usuario->id) }}#cartas" method="GET" style="display: flex; gap: 8px; flex-wrap: wrap; justify-content: center;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre..." style="padding: 6px 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
        <select name="sort" onchange="this.form.submit()" style="padding: 6px 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
            <option value="">Ordenar por nombre</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Nombre A-Z</option>
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Nombre Z-A</option>
        </select>
        <button type="submit" style="padding: 6px 12px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
            Filtrar
        </button>
    </form>
</div>

@if($cartas->count())
<div id="cartas" style="background-color: #fefefe; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
    <h3 style="text-align: center; margin-bottom: 16px; font-size: 20px;">Cartas subidas por el usuario</h3>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 12px;">
        @foreach($cartas as $carta)
            <div style="border: 1px solid #ddd; padding: 14px; border-radius: 6px; background: #fff; font-size: 14px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <strong>{{ $carta->nombre_carta_api }}</strong><br>
                        Rareza: {{ $carta->rareza }}
                    </div>
                    <a href="{{ route('cartas.edit.admin', $carta->id) }}" style="background-color: #007bff; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none;">
                        Editar
                    </a>

                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px;">
                    <div>
                        Estado: {{ $carta->estado }}<br>
                        Precio: {{ $carta->precio }} €
                    </div>
                    <form action="{{ route('cartas.destroy', $carta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta carta?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: #dc3545; color: white; padding: 5px 10px; border: none; border-radius: 5px;">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@else
<div style="text-align: center; color: #666; margin-top: 20px;">
    <p>No hay cartas para mostrar.</p>
</div>
@endif

</div>

<style>
    html, body {
        margin: 0;
        padding: 0;
        max-width: 100%;
        overflow-x: hidden;
        overflow-y: auto;
        scroll-behavior: auto;
    }

    * {
        box-sizing: border-box;
    }

    #app {
        overflow-x: hidden;
    }
</style>

@endsection
