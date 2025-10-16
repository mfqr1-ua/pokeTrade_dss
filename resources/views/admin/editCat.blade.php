@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-box {
        background-color: rgba(240, 240, 240, 0.95);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        width: 400px;
        max-width: 90%;
    }

    .login-box h2 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
        background-color: #333;
        color: white;
        padding: 10px;
        border-radius: 6px;
    }

    .input-full {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #e0e0e0;
        box-sizing: border-box;
    }

    .btn-black {
        background-color: #28a745;
        color: white;
        padding: 10px;
        width: 100%;
        margin-top: 10px;
        border: none;
        border-radius: 5px;
        transition: background-color 0.2s ease;
        font-weight: bold;
    }

    .btn-black:hover {
        background-color: #218838;
    }
</style>

<div class="login-container">
    <form class="login-box" method="POST" action="{{ route('categorias.update', $categoria->id) }}">
        @csrf
        @method('PUT')

        <h2>Editar Categoría</h2>

        <input type="text" name="nombre" value="{{ $categoria->nombre }}" required placeholder="Nombre *" class="input-full">
        <input type="text" name="descripcion" value="{{ $categoria->descripcion }}" placeholder="Descripción" class="input-full">

        <button type="submit" class="btn-black">Actualizar categoría</button>
    </form>
</div>
@endsection
