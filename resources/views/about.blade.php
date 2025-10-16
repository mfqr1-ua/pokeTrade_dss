@extends('layout')

@section('title', 'Acerca de Nosotros')

@section('content')
<header class="bg-light py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center">
                <h1 class="display-4 fw-bolder">GRUPO 4</h1>
                <p class="lead fw-normal text-muted mb-0">Somos los alumnos Adda, Luis, Iván, Miguel y Rafael</p>
            </div>
        </div>
    </header>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-4 row-cols-sm-1 row-cols-md-1 g-3">
                @for ($i = 0; $i < 1; $i++)
                    <div class="col">
                        <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="https://play-lh.googleusercontent.com/XRVAOLPVE9KZWHNiOzDTnZVJkOdUNo2XU3jOsqllSS7vAN3vh7Fj8JTKArFguX0lBg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                        </svg>
                            <div class="card-body">
                                <p class="card-text">Somos un grupo de alumnos con el reto de desarrollar una página web funcional utilizando PHP y Laravel, integrando una base de datos completamente operativa. Nuestro objetivo es crear una plataforma de reventa de móviles y material tecnológico, permitiendo a los usuarios dar una segunda vida a sus dispositivos electrónicos.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
