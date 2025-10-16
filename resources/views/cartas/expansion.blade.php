@extends('layouts.app')

@section('content')
<div class="main">
    <div class="mx-auto mb-4" style="width: 93%;">
        <h1 class="display-5 fw-bold">{{ $expansion_name ?? ($cartas[0]['set']['name'] ?? 'Expansión') }}</h1>
    </div>

    <div class="mx-auto" style="width: 93%;">
        <div id="card-grid" class="card-grid"></div>
    </div>

    <div class="paginacion">
        <button id="prevPage" class="arrow-btn me-3">&larr;</button>
        <button id="nextPage" class="arrow-btn">&rarr;</button>
    </div>
</div>

<style>
    body {
        overflow-x: hidden;
    }

    .main {
        display: flex;
        flex-direction: column;
        align-items: left;
        justify-content: left;
    }

    h1.display-5 {
        text-align: left;
        font-size: 22px;
        font-weight: bold;
        color: white;
        padding: 10px 20px;
        background-color: #606060;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 20px;
        justify-items: center;
    }

    .card-wrapper {
        width: 140px;
    }

    .card-img-top {
        transition: transform 0.2s ease;
        max-height: 180px;
        object-fit: cover;
        border-radius: 8px;
    }

    .card-img-top:hover {
        transform: scale(1.05);
    }

    .card-body {
        text-align: center;
        margin-top: 6px;
    }

    .card-title {
        background-color: #c0c0c0;
        color: #606060;
        text-align: center;
        font-size: 14px;
        padding: 10px 20px;
        border-radius: 10px;
        margin-top: 10px;
    }

    .paginacion {
        left: 50%;
        transform: translateX(-50px);
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .arrow-btn {
        background-color: #606060;
        color: white;
        border: none;
        border-radius: 10px;
        width: 50px;
        height: 50px;
        font-size: 18px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .arrow-btn:disabled {
        opacity: 0.4;
        cursor: default;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartas = @json($cartas);
        const cardsPerPage = 14;
        let currentPage = 0;

        const cardGrid = document.getElementById('card-grid');
        const prevBtn = document.getElementById('prevPage');
        const nextBtn = document.getElementById('nextPage');

        function renderPage(page) {
            cardGrid.innerHTML = '';
            const start = page * cardsPerPage;
            const end = start + cardsPerPage;
            const pageCards = cartas.slice(start, end);

            pageCards.forEach(carta => {
                const card = document.createElement('div');
                card.className = 'card-wrapper';
                card.innerHTML = `
                    <div class="card h-100 text-center border-0 bg-transparent">
                        <a href="/cartas/${carta.id}">
                            <img src="${carta.images?.large ?? '/imagenes/default-card.png'}"
                                 class="card-img-top"
                                 alt="${carta.name}">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title">${carta.name}</h6>
                        </div>
                    </div>
                `;
                cardGrid.appendChild(card);
            });

            prevBtn.disabled = page === 0;
            nextBtn.disabled = end >= cartas.length;
        }

        prevBtn.addEventListener('click', () => {
            if (currentPage > 0) {
                currentPage--;
                renderPage(currentPage);
            }
        });

        nextBtn.addEventListener('click', () => {
            if ((currentPage + 1) * cardsPerPage < cartas.length) {
                currentPage++;
                renderPage(currentPage);
            }
        });

        renderPage(currentPage);
    });
</script>
@endsection