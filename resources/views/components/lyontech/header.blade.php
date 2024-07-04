<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: fixed; z-index: 9999; width: 100%;">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('theme-lyontech/images/icon.jpg') }}" style="width: 55px; heiht: 55px; "> &nbsp;
        <span class="brand-text">
            Lyonteach
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            @if (Auth::check())
                <li class="nav-item dropdown mt-2" style=" padding: 0px 10px;">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 23px; margin-top: -3px;">
                        Herramientas
                    </a>
                    <div class="dropdown-menu card-bg" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('help_gpt') }}">CONSULTAS IA</a>
                        <a class="dropdown-item" href="{{ route('dashboard_courses') }}">CURSOS</a>

                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#modalThesisHeader">
                            HOJA DE TRABAJO
                        </a>
                    </div>
                </li>
                @can('academico_directo_cursos')
                    <li class="nav-item dropdown mt-2" style="padding: 0 10px;">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                            id="courses" style="font-size: 23px;">
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
                <li class="nav-item dropdown mt-2" style=" padding: 0px 15px;">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 23px;">
                        Herramientas
                    </a>
                    <div class="dropdown-menu card-bg" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('help_gpt') }}">CONSULTAS IA</a>

                        <a class="dropdown-item" href="{{ route('dashboard_courses_default') }}">CURSOS</a>

                        <a class="dropdown-item" href="{{ route('worksheet_default') }}">HOJA DE TRABAJO</a>
                    </div>
                </li>
                <li class="nav-item dropdown mt-2" style=" padding: 0px 15px;">
                    <a class="nav-link" href="{{ route('modo_page') }}" style="font-size: 23px;">
                        Membresias
                    </a>
                    <!--
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenbresia" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 23px;">
                        Membresias
                    </a>
                    <div class="dropdown-menu card-bg" aria-labelledby="navbarDropdownMenbresia">
                        @foreach ($modos as $modo)
<a class="dropdown-item" href="{{ route('unirme_page', $modo->id) }}">
                                {{ $modo->name }}
                            </a>
@endforeach
                    </div>
                    -->
                </li>
            @endif
        </ul>

        @if (Route::has('login'))
            @auth
                <button class="custom-button-c ml-2" style="margin-right: 35px; background: #ff9152;">
                    <a href="{{ route('modo_page') }}">
                        <img src="{{ asset('assets/images/corona.jpg') }}" alt="Icono">
                    </a>
                </button>

                <li class="nav-item dropdown" style="list-style-type: none;">
                    <a class="nav-link " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img src="{{ asset('theme-lyontech/images/user-black.png') }}"
                            style="width: 50px; height:auto;" alt="Icono">
                    </a>
                    <div class="dropdown-menu card-bg dropdown-toggle dropdown-menu-lg-right" aria-labelledby="navbarDropdown">
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
                    <style>
                        .dropdown-toggle::after{
                            display: none !important;
                        }
                    </style>

                </li>
                <li class="nav-item dropdown" style="list-style-type: none;">

                    <livewire:chat::ly-contact-list />

                </li>
            @else
                <form class="form-inline my-2 my-lg-0">
                    <a href="{{ route('ly-login') }}" class="btn btn-orange" style="margin-right: 35px;">
                        <strong> Iniciar sesión </strong>
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-orange"><strong>Registrarme</strong></a>
                </form>
            @endauth
        @endif

    </div>
    @if (Auth::check())
        @section('header-global-modal')

            <livewire:investigation::thesis.modal-thesis-list-student />

        @stop
    @endif
</nav>
