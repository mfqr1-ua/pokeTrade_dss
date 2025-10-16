@extends('layouts.app')

@section('content')

<style>
    .container {
        max-width: 1200px;
        margin-left: 5px;
        margin-right: auto;
        padding: 20px;
    }

    .top-bar {
        background-color: #505050;
        padding: 10px 20px;
        font-size: 18px;
        border-radius: 10px;
        font-weight: bold;
        color: white;
        display: flex;
        align-items: center;
        justify-content: start;
        margin-top: 10px;
    }

    .admin-panel {
        display: flex;
        gap: 30px;
        align-items: flex-start;
        margin-top: 20px;
    }

    .admin-column {
        flex: 1;
    }

    .form-group {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .form-group input, .form-group select, .form-group button {
        flex: 1;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #aaa;
        font-size: 14px;
    }

    .admin-item {
        background-color: white;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .admin-buttons {
        margin-top: 10px;
    }
    

    .admin-buttons a, .admin-buttons button {
        margin-right: 5px;
    }

    .section-title {
        margin: 20px 0 10px;
        background-color: #505050;
        padding: 10px 20px;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        font-size: 16px;
        text-align: center;
    }

    .admin-item-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .admin-text {
        flex-grow: 1;
    }

    .admin-buttons {
        display: flex;
        gap: 5px;
    }

    /* QUITAR SCROLL HORIZONTAL */
    html, body {
        overflow-x: hidden;
    }

</style>

<div class="container">
    <div class="top-bar">Panel de administración</div>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <div class="admin-panel">

        <!-- 🧍 Usuarios (columna izquierda) -->
        <div class="admin-column">
            <!-- Formulario de Crear Usuario -->
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Nombre" required>
                    <input type="email" name="email" placeholder="Correo" required>
                    <input type="password" name="contraseña" placeholder="Contraseña" required>
                </div>

                <div class="form-group">
                    <input type="text" name="direccion" placeholder="Dirección">
                    <input type="text" name="numTelf" placeholder="Número de teléfono">
                    <label style="display: flex; align-items: center; gap: 5px; background-color: #f5f5f5; padding: 4px 8px; border-radius: 4px; border: 1px solid #aaa; font-size: 13px; cursor: pointer; white-space: nowrap;">
                        <input type="checkbox" name="admin" value="1" style="width: 14px; height: 14px; margin: 0;">
                        Admin
                    </label>

                    <button type="submit" style="background-color: #eee; padding: 8px 12px; border-radius: 6px; font-size: 14px; white-space: nowrap;">Crear Usuario</button>
                </div>
            </form>

            <!-- Filtro de Usuarios -->
            <form method="GET" action="{{ route('admin.index') }}">
                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Buscar nombre..." value="{{ request('nombre') }}">
                    <select name="orden_usuarios">
                        <option value="asc" {{ request('orden_usuarios') == 'asc' ? 'selected' : '' }}>Nombre (A-Z)</option>
                        <option value="desc" {{ request('orden_usuarios') == 'desc' ? 'selected' : '' }}>Nombre (Z-A)</option>
                    </select>
                    <button type="submit" style="background-color: #007bff; color: white;">Filtrar</button>
                </div>
            </form>

            <!-- Usuarios Existentes -->
            <div class="section-title">Usuarios Existentes</div>

            @foreach($usuarios as $usuario)
                <div class="admin-item">
                    <div class="admin-item-content">
                        <div class="admin-text">
                            <strong>Nombre:</strong> {{ $usuario->name }}<br>
                            <strong>Email:</strong> {{ $usuario->email }}
                        </div>
                        <div class="admin-buttons">
                            <a href="{{ route('admin.usuarios.edit', $usuario->id) }}">
                                <button type="button" style="background-color:rgb(255, 235, 59); color: black; padding: 5px 10px; border-radius: 4px;">Editar</button>
                            </a>
                            <form action="{{ route('user.destroy', ['id' => $usuario->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 4px;">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 🗂 Categorías (columna derecha) -->
        <div class="admin-column">
            <!-- Formulario Crear Categoría -->
            <form action="{{ route('admin.categorias.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
                    <input type="text" name="descripcion" placeholder="Descripción" required>
                    <button type="submit" style="background-color: #eee;">Crear Categoría</button>
                </div>
            </form>

            <!-- Filtro de Categorías -->
            <form method="GET" action="{{ route('admin.index') }}">
                <div class="form-group">
                    <select name="orden_categorias">
                        <option value="asc" {{ request('orden_categorias') == 'asc' ? 'selected' : '' }}>Nombre (A-Z)</option>
                        <option value="desc" {{ request('orden_categorias') == 'desc' ? 'selected' : '' }}>Nombre (Z-A)</option>
                    </select>
                    <button type="submit" style="background-color: #007bff; color: white;">Filtrar</button>
                </div>
                <div class="form-group">
                    <input type="text" name="nombre_categoria" placeholder="Buscar categoría..." value="{{ request('nombre_categoria') }}">
                    <button type="submit" style="background-color: #007bff; color: white;">Buscar</button>
                </div>
            </form>

            <!-- Categorías Existentes -->
            <div class="section-title">Categorías Existentes</div>

            @foreach($categorias as $categoria)
                <div class="admin-item">
                    <div class="admin-item-content">
                        <div class="admin-text">
                            <strong>Nombre:</strong> {{ $categoria->nombre }}<br>
                            <strong>Descripción:</strong> {{ $categoria->descripcion }}
                        </div>
                        <div class="admin-buttons">
                            <a href="{{ route('categorias.edit', $categoria->id) }}">
                                <button type="button" style="background-color:rgb(255, 235, 59); color: black; padding: 5px 10px; border-radius: 4px;">Editar</button>
                            </a>
                            <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 4px;">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
