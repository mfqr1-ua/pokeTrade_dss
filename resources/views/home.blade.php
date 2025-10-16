@extends('layoutH')

@section('title', 'Acerca de Nosotros')
@section('content')
    <div class="d-flex h-100 text-center text-white bg-dark cover-container">
        <main class="px-3">
            <h1>GRUPO 4</h1>
            <p class="lead">Somos los alumnos Adda, Luis, Iván, Miguel y Rafael.</p>
            <p class="lead">
                Somos un grupo de alumnos con el reto de desarrollar una página web funcional utilizando PHP y Laravel, 
                integrando una base de datos completamente operativa. Nuestro objetivo es crear una plataforma de 
                reventa de móviles y material tecnológico, permitiendo a los usuarios dar una segunda vida a sus dispositivos electrónicos.
            </p>
            <a href="/album" class="btn btn-lg btn-light fw-bold border-white bg-white">Explorar</a>
        </main>
    </div>
@endsection