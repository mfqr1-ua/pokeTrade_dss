<header class="header">
    <div class="sidebar">
        <div class="sb-top">
            <button class="sb-options">☰</button>
        </div>
        
        <div class="sb-pages">
            <div class="nav">
                <a class="nav-link" href="{{ route('inicio') }}" title="Inicio" style="margin-top: 40px;">
                    <div><i class="bi bi-house-fill" style="color: #606060"></i></div>
                </a>
                <a class="nav-link" href="{{ url('/cartas/buscar') }}" title="Subir Carta" style="margin-top: 40px;">
                    <div class="sb-nav-link-icon"><i class="bi bi-file-earmark-arrow-up-fill" style="color: #606060"></i></div>
                </a>
                <a class="nav-link" href="{{ route('catalogo') }}" title="Catálogo" style="margin-top: 40px;">
                    <div><i class="bi bi-images" style="color: #606060"></i></div>
                </a>
                <a class="nav-link" href="{{ route('categorias.index') }}" title="Categorías" style="margin-top: 40px;">
                    <div><i class="bi bi-bookmarks-fill" style="color: #606060"></i></div>
                </a>
                <a class="nav-link" href="{{ route('expansiones') }}" title="Expansiones" style="margin-top: 40px;">
                    <div><i class="bi bi-archive-fill" style="color: #606060"></i></div>
                </a>
                <a class="nav-link" href="{{ route('cartas.mis') }}" title="Mis Cartas" style="margin-top: 40px;">
                    <div><i class="bi bi-gear-fill" style="color: #606060"></i></div>
                </a>
                @auth
                    @if(auth()->user()->admin)
                        <a class="nav-link" href="{{ route('admin.index') }}" title="Admin" style="margin-top: 40px;">
                            <div><i class="bi bi-people-fill" style="color: #606060"></i></div>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    
    <div class="top">
        <div class="logo">
            <strong>PokeMarket TCG</strong>
            <img src="{{ asset('imagenes/logo.png') }}" alt="Logo">
        </div>
        
        <div class="user">
            @auth
                <a href="{{ url('/contacto') }}" title="Contacto" style="margin-right: 10px; font-size: 24px; color:rgb(0, 0, 0);">
                    <i class="bi bi-person-lines-fill"></i>
                </a>

                <form action="{{ url('/cesta') }}" method="get" style="margin-right: 10px;">
                    <button type="submit" class="carrito-btn" title="Carrito">
                        <img src="{{ asset('imagenes/carrito.png') }}" alt="Carrito" style="width: 40px; height: 40px; border-radius: 0;">
                    </button>
                </form>
                <a href="{{ route('perfil') }}">
                    <img 
                        src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('imagenes/usuario.png') }}" 
                        alt="Perfil" 
                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; cursor: pointer;">
                </a>
            @else
                <a href="{{ route('login') }}">
                    <img 
                        src="{{ asset('imagenes/usuario.png') }}" 
                        alt="Iniciar sesión" 
                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; cursor: pointer;">
                </a>
            @endauth
        </div>
    </div>
</header>

<style>
    body {
        width: 100%;
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin-top: 65px;
        padding-left: 65px;
    }

    .header {
        display: flex;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .sb-top {
        width: 65px;
        height: 65px;
        background-color: #333333;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .sb-options {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    }

    .sb-pages {
        width: 65px;
        height: calc(100% - 65px);
        background-color: #f0f0f0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .sb-pages .nav {
        font-size: 24px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .top {
        position: fixed;
        top: 0;
        left: 65px;
        right: 0;
        height: 65px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #d6d6d6;
        padding: 0 20px;
    }

    .logo {
        display: flex;
        align-items: center;
        font-size: 24px;
    }

    .logo img {
        width: 40px;
        height: auto;
        margin-left: 10px;
    }

    .user {
        display: flex;
        align-items: center;
        text-align: right;
    }

    .user .info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .user .info span {
        color: #888888;
        font-size: 14px;
    }

    .user img {
        width: 40px;
        height: 40px;
        margin-left: 10px;
        border-radius: 50%;
        object-fit: cover;
    }

    .carrito-btn {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
    }

    .carrito-btn img {
        width: 30px !important;
        height: 30px !important;
    }
</style>
