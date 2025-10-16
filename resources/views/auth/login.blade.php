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

    .login-box input[type="email"],
    .login-box input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #e0e0e0;
    }

    .btn-black {
        background-color: #333;
        color: white;
        padding: 10px;
        width: 100%;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
        transition: background-color 0.2s ease;
    }

    .btn-black:hover {
        background-color: #555;
    }

    .btn-grey {
        background-color: #ddd;
        color: black;
        padding: 10px;
        width: 100%;
        border: none;
        border-radius: 5px;
        transition: background-color 0.2s ease;
    }

    .btn-grey:hover {
        background-color: #bbb;
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
</style>

<div class="login-container">
    <form class="login-box" method="POST" action="{{ route('login') }}">
        @csrf
        <h2>¡Bienvenido a PokeMarketTCG!</h2>

        <input type="email" name="email" placeholder="Correo electrónico *" required autofocus class="input-full">
        <input type="password" name="password" placeholder="Contraseña *" required class="input-full">

        <button type="submit" class="btn-black">Iniciar sesión</button>
        <a href="{{ route('register') }}">
            <button type="button" class="btn-grey">Registrarse</button>
        </a>
    </form>
</div>
@endsection
