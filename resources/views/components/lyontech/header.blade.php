<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('theme-lyontech/images/icon.jpg') }}" width="30" height="30" style="margin-left: 10px; ">
        <span class="brand-text">
            LyonTeach
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if (Auth::check())
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown active" style="margin-left: 35px; font-size: 1.2rem;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Herramientas
                    </a>
                    <div class="dropdown-menu card-bg" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-white" href="#">CONSULTAS IA</a>
                        <a class="dropdown-item text-white" href="#">CURSOS</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-white" href="#">HOJA DE TRABAJO</a>
                    </div>
                </li>
                <li class="nav-item active" style="margin-left: 25px; font-size: 1.2rem;">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Membresías</a>
                </li>
            </ul>
        @endif
        @if (Route::has('login'))
            @auth
                <button class="custom-button-c ml-2" type="submit" style="margin-right: 35px;">
                    <div>
                        <img src="{{ asset('theme-lyontech/images/corona.jpg') }}" alt="Icono">
                    </div>
                </button>
                <button class="custom-button mr-3" type="submit">
                    <div>
                        <img src="{{ asset('theme-lyontech/images/user-black.jpg') }}" alt="Icono">
                    </div>
                </button>
                <button class="custom-button mr-2" type="submit">
                    <div>
                        <img src="{{ asset('theme-lyontech/images/msj-black.png') }}" alt="Icono">
                    </div>
                </button>
            @else
                <form class="form-inline my-2 my-lg-0">
                    <a href="{{ route('ly-login') }}" class="btn-orange" type="submit" style="margin-right: 35px;">
                        <strong> Iniciar sesión </strong>
                    </a>
                    <a href="{{ route('register') }}" class="btn-orange" type="submit"><strong>Registrame</strong></a>
                </form>
            @endauth
        @endif

    </div>
</nav>
