@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger" style="color:red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="upload-container">
    <h1 class="upload-title">Subir Carta Personalizada</h1>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('cartas.store') }}">
        @csrf

        <input type="hidden" name="nombre_carta_api" value="{{ $nombre_carta_api ?? '' }}">
        <h3 class="card-name">{{ $nombre_carta_api ?? '' }}</h3>
        <input type="hidden" name="id_carta_api" value="{{ $id_carta_api ?? '' }}">

        <div class="form-collection">
            <div class="form-group">
                <label for="rareza">Rareza</label>
                <select name="rareza" required class="form-control">
                    <option value="">Selecciona una opción</option>
                    <option value="common">Común</option>
                    <option value="uncommon">Poco común</option>
                    <option value="rare">Rara</option>
                    <option value="holo rare">Holo rara</option>
                    <option value="promo">Promocional</option>
                </select>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" required class="form-control">
                    <option value="">Selecciona el estado</option>
                    <option value="nuevo">Nuevo</option>
                    <option value="mint">Mint</option>
                    <option value="bueno">Bueno</option>
                    <option value="usado">Usado</option>
                    <option value="dañado">Dañado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="precio">Precio (€)</label>
                <input type="number" name="precio" step="0.01" required class="form-control">
            </div>

            <div class="form-group">
                <label for="fecha_adquisicion">Fecha de adquisición</label>
                <input type="date" name="fecha_adquisicion" required class="form-control">
            </div>
        </div>

        <input type="hidden" name="expansion_api_id" value="{{ $expansion_api_id ?? '' }}">


        <button type="submit" class="submit-button">Subir carta</button>
    </form>
</div>

<style>
    .upload-container {
        max-width: 600px;
        margin: auto;
        padding: 10px;

    }

    .upload-title {
        background-color: #606060;
        margin-bottom: 20px;
    }

    .card-name {
        background-color: #C0C0C0;
        margin-bottom: 15px;
        text-align: center;
    }

    .upload-title,
    .card-name {
        display: block;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: bold;
        width: 100%;
        box-sizing: border-box;
    }

    .success-message {
        color: green;
        text-align: center;
        margin-bottom: 15px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 16px;
    }


    .submit-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    form .form-collection {
        background-color: #C0C0C0;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        color: white;
    }

    .submit-button {
        padding: 10px 20px;
        background-color: #606060; /* Mismo color que el título */
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        display: block;            /* Hace que el botón ocupe una línea */
        margin: 20px auto 0;       /* Lo centra automáticamente */
    }
    .submit-button:hover {
        background-color: #505050; /* Color más oscuro al pasar el ratón */
    }

    label {
        font-weight: bold;

    }
</style>


@endsection
