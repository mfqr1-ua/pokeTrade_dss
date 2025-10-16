@extends('layouts.app')

@section('content')

<style>
    body, html {
        overflow-x: hidden;
    }

    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .form-title {
        display: block;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: bold;
        width: 100%;
        box-sizing: border-box;
        background-color: #606060;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
    }

    .submit-container {
        text-align: center;
        margin-top: 25px;
    }

    .submit-button {
        padding: 10px 20px;
        background-color: #606060;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        display: block;            
        margin: 20px auto 0;       
    }
    
    .submit-button:hover {
        background-color: #505050; 
    }

    .form-collection {
        background-color: #C0C0C0;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        color: white;
    }
</style>

<form action="{{ route('cartas.update', $carta->id) }}" method="POST" class="form-container">
    @csrf
    @method('PUT')

    <input type="hidden" name="id_carta_api" value="{{ $carta->id_carta_api ?? '' }}">

    <h2 class="form-title">Editar Carta</h2>

    <div class="form-collection">
        <div class="form-group">
            <label for="rareza">Rareza</label>
            <select name="rareza" required class="form-control">
                <option value="">Selecciona una opción</option>
                <option value="common"    {{ $carta->rareza == 'common'    ? 'selected' : '' }}>Común</option>
                <option value="uncommon"  {{ $carta->rareza == 'uncommon'  ? 'selected' : '' }}>Poco común</option>
                <option value="rare"      {{ $carta->rareza == 'rare'      ? 'selected' : '' }}>Rara</option>
                <option value="holo rare" {{ $carta->rareza == 'holo rare' ? 'selected' : '' }}>Holo rara</option>
                <option value="promo"     {{ $carta->rareza == 'promo'     ? 'selected' : '' }}>Promocional</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" required class="form-control">
                <option value="">Selecciona el estado</option>
                <option value="nuevo"  {{ $carta->estado == 'nuevo'  ? 'selected' : '' }}>Nuevo</option>
                <option value="mint"   {{ $carta->estado == 'mint'   ? 'selected' : '' }}>Mint</option>
                <option value="bueno"  {{ $carta->estado == 'bueno'  ? 'selected' : '' }}>Bueno</option>
                <option value="usado"  {{ $carta->estado == 'usado'  ? 'selected' : '' }}>Usado</option>
                <option value="dañado" {{ $carta->estado == 'dañado' ? 'selected' : '' }}>Dañado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="precio">Precio (€)</label>
            <input type="number" name="precio" value="{{ $carta->precio }}" step="0.01" required class="form-control">
        </div>

        <div class="form-group">
            <label for="fecha_adquisicion">Fecha de Adquisición</label>
            <input type="date" name="fecha_adquisicion" value="{{ $carta->fecha_adquisicion }}" required class="form-control">
        </div>
    </div>

    <div class="submit-container">
        <button type="submit" class="submit-button">Guardar cambios</button>
    </div>
</form>

@endsection
