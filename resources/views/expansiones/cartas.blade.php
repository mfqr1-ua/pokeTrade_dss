@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cartas de la expansión: {{ $expansion_name ?? $expansion_id }}</h1>

    @if($cartas->isEmpty())
        <p>No tienes cartas de esta expansión.</p>
    @else
        <div class="row">
            @foreach($cartas as $carta)
                @php
                    $apiResponse = Http::get("https://api.pokemontcg.io/v2/cards/{$carta->id_carta_api}");
                    $imagen = optional($apiResponse->json())['data']['images']['small'] ?? asset('imagenes/default-card.png');
                @endphp

                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <a href="{{ route('cartas.show', ['id_carta_api' => $carta->id_carta_api]) }}">
                            <img src="{{ $imagen }}" class="card-img-top" alt="Carta" style="cursor: pointer;">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(!empty($cartas_expansion_completa))
        <h2 class="mt-5">Todas las cartas de la colección</h2>
        <div class="row">
            @foreach($cartas_expansion_completa as $cartaApi)
                <div class="col-md-2 mb-3">
                    <div class="card h-100">
                        <img src="{{ $cartaApi['images']['small'] ?? asset('imagenes/default-card.png') }}"
                             class="card-img-top"
                             alt="{{ $cartaApi['name'] }}"
                             style="opacity: 0.6;">
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
