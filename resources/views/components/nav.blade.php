<nav class="navbar navbar-expand-lg navbar-dark border-bottom m-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ Auth::check() && Auth::user()->is_admin ? route('admin.dashboard') : route('home') }}">SysVents</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                @if (Auth::check() && Auth::user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('users.index') }}">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('artists.index') }}">Artistas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Ingressos</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('exhibitors.index') }}" class="nav-link active" aria-current="page"
                            href="#">Expositores</a>
                    </li>
                @endif
            </ul>
        </div>
        @if (Auth::check())
            <a class="btn-actions text-end btn btn-light" type="button" href="{{ route('login.logout') }}">Logout</a>
        @else
            <div class="gap-1">
                <a class="btn-actions text-end btn btn-light" type="button" href="{{ route('login.index') }}">Login</a>
                <a class="btn-actions text-end btn btn-light" type="button"
                    href="{{ route('users.register') }}">Cadastre-se</a>
            </div>
        @endif
    </div>
</nav>
