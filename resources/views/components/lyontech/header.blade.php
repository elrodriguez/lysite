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

        <ul class="navbar-nav mr-auto">
            @if (Auth::check())
                <li class="nav-item dropdown" style="margin-left: 35px; font-size: 1.2rem;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Herramientas
                    </a>
                    <div class="dropdown-menu card-bg" aria-labelledby="navbarDropdown">
                        @can('academico_directo_gpt')
                            <a class="dropdown-item" href="{{ route('help_gpt') }}">CONSULTAS IA</a>
                        @else
                            <a class="dropdown-item" href="{{ route('modo_page') }}">CONSULTAS IA</a>
                        @endcan
                        <a class="dropdown-item" href="{{ route('dashboard_courses') }}">CURSOS</a>

                        {{-- <a class="dropdown-item" href="{{ route('worksheet') }}">HOJA DE TRABAJO</a> --}}

                    </div>
                </li>
                @can('academico_directo_cursos')
                    <li class="nav-item dropdown " style="margin-left: 35px; font-size: 1.2rem;">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                            id="courses">
                            {{ __('labels.My Courses') }}
                        </a>
                        <div class="dropdown-menu card-bg min-width: 200px;" aria-labelledby="navbarDropdown">


                            @if (count($courses) > 0)
                                @foreach ($courses as $course)
                                    <a href="{{ route('academic_students_my_course', $course->id) }}" class="dropdown-item">
                                        <span class="media-left mr-16pt">
                                            <img src="{{ asset($course->course_image) }}" width="30" alt="avatar"
                                                class="media-left rounded ">
                                        </span>
                                        <div class="media-body">
                                            {{ $course->name }}
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <a href="{{ route('home') }}" class="dropdown-item">
                                    <span class="media-left mr-16pt">
                                        <img src="{{ url('assets/images/logo/white-60.png') }}" width="30"
                                            alt="avatar" class="media-left rounded ">
                                    </span>
                                    <div class="media-body">
                                        {{ __('labels.No courses') }}
                                    </div>
                                </a>
                            @endif

                        </div>
                    </li>
                @endcan
                @can('academico_directo_tesis')
                    <livewire:investigation::thesis.header-investigation />
                @endcan
            @else
                <li class="nav-item dropdown" style="margin-left: 35px; font-size: 1.2rem;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Herramientas
                    </a>
                </li>
                <li class="nav-item dropdown" style="margin-left: 35px; font-size: 1.2rem;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Membresias
                    </a>
                </li>
            @endif
        </ul>

        @if (Route::has('login'))
            @auth
                <button class="custom-button-c ml-2" style="margin-right: 35px;">
                    <div>
                        <img src="{{ asset('theme-lyontech/images/corona.jpg') }}" alt="Icono">
                    </div>
                </button>

                <li class="nav-item dropleft">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('theme-lyontech/images/user-black.jpg') }}"
                            style="width: 50px; height:auto; margin-top: -20px;" alt="Icono">
                    </a>
                    <div class="dropdown-menu card-bg" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="#"><strong>{{ auth()->user()->name }}</strong></a>
                        <a class="dropdown-item " href="{{ route('dashboard') }}">Dashboard</a>
                        @can('academico_cursos_instructor')
                            <a class="dropdown-item"
                                href="{{ route('academic_dash_instructor_courses_list') }}">{{ __('labels.Courses') }}</a>
                        @endcan
                        <div class="linea-blanca"></div>
                        <a class="dropdown-item " href="{{ route('user_edit_account') }}">Editar Cuenta</a>
                        <a class="dropdown-item " href="{{ route('logout') }}">Cerrar sesión</a>

                    </div>
                </li>
                <li class="nav-item dropleft">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('theme-lyontech/images/msj-black.png') }}"
                            style="width: 50px; height:auto; margin-top: -20px; " alt="Icono">
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <form class="search-form search-form search-form-courses d-none d-md-flex mb-2 ml-2"
                            action="#">

                            <button class="btn" type="submit" role="button"><i
                                    class="material-icons">search</i></button>
                            <input type="text" class="form-control" placeholder="Buscar...?">
                        </form>

                        <span class="d-flex ml-2">

                            <span class="media-left mr-16pt">
                                <img src="assets/images/people/50/guy-6.jpg" width="40" alt="avatar"
                                    class="rounded-circle">
                            </span>
                            <div class="media-body">
                                <a class="card-title m-0" href="instructor-profile.html">administrador: Eddie Bryan</a>

                                <p class="flex text-black-50 lh-1 mb-0"><span
                                        class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span><small>6
                                        hours</small></p>
                            </div>

                        </span>
                        <span class="d-flex mt-2 ml-2">
                            <span class="media-left mr-16pt">
                                <img src="assets/images/people/50/guy-6.jpg" width="40" alt="avatar"
                                    class="rounded-circle">
                            </span>
                            <div class="media-body">
                                <a class="card-title m-0 color-azul" href="instructor-profile.html">Instructor: Eddie
                                    Bryan</a>
                                <p class="flex text-black-50 lh-1 mb-0"><span
                                        class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span><small>6
                                        hours</small></p>
                            </div>
                        </span>


                    </div>
                </li>
            @else
                <form class="form-inline my-2 my-lg-0">
                    <a href="{{ route('ly-login') }}" class="btn btn-orange" style="margin-right: 35px;">
                        <strong> Iniciar sesión </strong>
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-orange"><strong>Registrame</strong></a>
                </form>
            @endauth
        @endif

    </div>
</nav>
