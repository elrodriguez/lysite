@php
    $path = explode('/', request()->path());
@endphp
@if($path[0] == 'login' || $path[0] == 'register' || $path[0] == 'pricing')
<div id="header" class="mdk-header bg-dark js-mdk-header mb-0" data-effects="waterfall blend-background" data-fixed data-condenses>
    <div class="mdk-header__content">

        <div data-primary class="navbar navbar-expand-sm navbar-dark bg-dark p-0" id="default-navbar">
            <div class="container">

                <!-- Navbar Brand -->
                <a href="{{ route('home') }}" class="navbar-brand">
                    <img class="navbar-brand-icon" src="{{ url('assets/images/logo/white-60.png') }}" width="30" alt="{{ env('APP_NAME','Laravel') }}">
                    <span class="d-none d-md-block">{{ env('APP_NAME','Laravel') }}</span>
                </a>

                <!-- Main Navigation -->
                <ul class="nav navbar-nav ml-auto d-none d-sm-flex">
                    <li class="nav-item">
                        <a href="pricing.html" class="nav-link">Pricing</a>
                    </li>
                    <li class="nav-item {{ $path[0] == 'register' ? 'active' : '' }}">
                        <a href="{{ route('register') }}" class="nav-link"> {{ __('labels.signup') }}</a>
                    </li>
                    <li class="nav-item {{ $path[0] == 'login' ? 'active' : '' }}">
                        <a href="{{ route('login') }}" class="nav-link">@lang('labels.login')</a>
                    </li>
                </ul>
                <!-- // END Main Navigation -->

                <!-- Navbar toggler -->
                <button class="navbar-toggler navbar-toggler-right d-block d-md-none" type="button" data-toggle="sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </div>

    </div>
</div>
@else
<div id="header" class="mdk-header bg-dark js-mdk-header mb-0" data-effects="waterfall blend-background" data-fixed data-condenses>
    <div class="mdk-header__content">
        <div class="navbar navbar-expand-sm navbar-dark bg-dark pr-0 pr-md-16pt" id="default-navbar" data-primary>
            <!-- Navbar toggler -->
            <button class="navbar-toggler navbar-toggler-right d-block d-md-none" type="button" data-toggle="sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Brand -->
            <a href="{{ route('home') }}" class="navbar-brand">
                <img class="navbar-brand-icon mr-0 mr-md-8pt" src="{{ url('assets/images/logo/white-60.png') }}" width="30" alt="{{ env('APP_NAME','Laravel') }}">
                <span class="d-none d-md-block">{{ env('APP_NAME','Laravel') }}</span>
            </a>

            <!-- Aquí esta el boton de Cursos -->
            <button class="btn btn-black mr-16pt" onclick="available_courses();" data-target="#courses">{{ __('labels.Courses') }}<i class="material-icons">arrow_drop_down</i></button>


            <!-- Main Navigation -->
            <nav class="nav navbar-nav ml-auto flex-nowrap">
                @if (Route::has('login'))
                    @auth
                        <div class="nav-item dropdown d-none d-sm-flex ml-16pt">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <img width="32" height="32" class="rounded-circle" src="{{ url('assets/images/people/50/guy-3.jpg') }}" alt="student" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header"><strong>{{ Auth::user()->name }}</strong></div>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                @can('academico_cursos_instructor')
                                <a class="dropdown-item" href="{{ route('academic_dash_instructor_courses_list') }}">{{ __('labels.Courses') }}</a>
                                @endcan
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-header"><strong>{{ __('labels.Account') }}</strong></div>
                                <a class="dropdown-item" href="{{ route('user_edit_account') }}">{{ __('labels.Edit Account') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
                            </div>
                        </div>
                        @livewire('chat::contact-list')
                    @else
                        <div class="ml-16pt nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                <i class="material-icons">lock_open</i>
                                <span class="sr-only">Login</span>
                            </a>
                        </div>
                        {{-- @if (Route::has('register'))
                            <div class="ml-16pt nav-item">
                                <a href="login.html" class="nav-link">
                                    <i class="material-icons">lock_open</i>
                                    <span class="sr-only">Register</span>
                                </a>
                            </div>
                        @endif --}}
                        <div class="d-none d-sm-flex nav-item">
                            <a href="pricing.html" class="btn btn-accent">Get started</a>
                        </div>
                    @endauth
                @endif
            </nav>
            <!-- // END Main Navigation -->
        </div>
    </div>
</div>


<!-- Modal Boton Cursos -->
<div class="courses-modal" id="available_courses" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-i8-plus bg-body pr-0">
                        <div class="py-16pt pl-16pt menu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#courses-development" data-toggle="tab">{{ env('APP_NAME','Laravel') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6 col-i8-plus-auto tab-content">


                        <div id="courses-development" class="tab-pane show active">
                            <div class="row no-gutters">
                                <div class="col-md-6 p-0">
                                    <div class="p-24pt d-flex h-100 flex-column">
                                        <div class="flex">
                                            <h5 class="text-black-100">{{ __('labels.Available Courses') }}</h5>
                                            <tbody class="list" wire:ignore>
                                            @if ($courses)
                                                <ul class="nav flex-column mb-24pt">

                                                    @foreach ($courses as $course)
                                                        <li class="nav-item">
                                                            <a class="nav-link px-0" href="#">{{ $course->name }}</a>
                                                        </li>
                                                    @endforeach

                                                </ul>

                                            @endif

                                        </div>
                                        <div>
                                            <a onclick="close_modal();" class="btn btn-block text-center btn-secondary">{{ __('labels.Close') }}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <button type="button" class="close" onclick="close_modal();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
window.onload = hide;
    function hide(){
        $('#available_courses').css('display','none');
    }
    function available_courses(){
            $('#available_courses').css('display','block');
    }
    function close_modal(){
        $('#available_courses').css('display','none');
    }
</script>
@endif
