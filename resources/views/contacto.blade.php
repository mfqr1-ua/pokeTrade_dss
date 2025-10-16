@extends('layouts.app')

@section('content')

<style>
    .contacto-container {
        max-width: 1200px;
        margin: 20px 0 0 40px; /* Menor margen superior, más a la izquierda */
        display: flex;
        gap: 30px;
        padding: 0 20px;
        align-items: flex-start; /* Alineación superior */
    }

    .formulario-contacto,
    .info-contacto {
        flex: 1;
        background-color: #f0f0f0;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        font-size: 16px;
    }

    .formulario-contacto {
        max-height: 550px; /* Controlamos altura del formulario */
    }

    .info-contacto {
        max-height: 400px; /* Limita la altura del grid derecho */
        overflow-y: auto;  /* Scroll si se excede */
    }

    .formulario-contacto h2,
    .info-contacto h2 {
        background-color: #505050;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 20px;
    }

    .formulario-contacto input,
    .formulario-contacto textarea {
        width: 100%;
        margin-bottom: 16px;
        padding: 10px;
        font-size: 15px;
        border: 1px solid #bbb;
        border-radius: 6px;
    }

    .formulario-contacto button {
        padding: 10px 22px;
        background-color: #007bff;
        border: none;
        color: white;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    .info-contacto div {
        background-color: #e0e0e0;
        padding: 10px;
        margin-bottom: 14px;
        border-radius: 6px;
        text-align: left;
        font-size: 14px;
        line-height: 1.4;
    }

    html, body {
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .contacto-container {
            flex-direction: column;
            padding: 10px;
            margin-left: 0;
        }
    }
</style>



<div class="contacto-container">

    <!-- Formulario de contacto -->
    <div class="formulario-contacto">
        <h2>Página de Contacto</h2>
        <form>
            <input type="text" placeholder="Nombre y Apellidos" required>
            <input type="email" placeholder="Email de contacto" required>
            <textarea rows="5" placeholder="Mensaje" required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </div>

    <!-- Información de contacto -->
    <div class="info-contacto">
        <h2>Datos de Contacto - PokeTrade</h2>

        <div>
            <strong>Sede Central</strong><br>
            Av. de los Entrenadores 45, Madrid 28000<br>
            Email: poketrade625@gmail.com<br>
            Teléfono: 911 123 456
        </div>

        <div>
            <strong>Departamento de Soporte</strong><br>
            Email: soporte@poketrade.com<br>
            Teléfono: 912 987 654
        </div>

        <div>
            <strong>Departamento de Comunicación</strong><br>
            Email: comunicacion@poketrade.com<br>
            Teléfono: 913 456 789
        </div>

        <div>
            <strong>Departamento de Proyectos</strong><br>
            Email: proyectos@poketrade.com<br>
            Teléfono: 914 321 000
        </div>

        <div>
            <strong>Atención al Cliente</strong><br>
            Email: atencion@poketrade.com<br>
            Teléfono: 915 654 321
        </div>
    </div>

</div>
@endsection
