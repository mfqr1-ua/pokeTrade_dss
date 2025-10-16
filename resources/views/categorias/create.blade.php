@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Crear nueva categoría</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="form-collection">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input class="form-control" style="margin-bottom: 15px;" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
            </div>
        </div>

        <button type="submit">Crear categoría</button>
    </form>

</div>

<style>
    .form-container {
        max-width: 600px;
        margin: 40px auto;
    }

    h1 {
        display: block;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: bold;
        width: 100%;
        box-sizing: border-box;
        background-color: #606060;
        margin-bottom: 20px;
    }

    form .form-collection {
        background-color: #C0C0C0;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        color: white;
    }

    label {
        font-weight: bold;
    }

    input[type="text"], textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 16px;
    }

    button {
        background-color: #606060;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 20px;
        font-size: 18px;
        margin: 20px auto 0;
        display: block;
    }

    button:hover {
        background-color: #505050;
    }
</style>
@endsection
