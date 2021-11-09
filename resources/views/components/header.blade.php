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
            <button class="btn btn-black mr-16pt" data-toggle="modal" data-target="#courses">Courses <i class="material-icons">arrow_drop_down</i></button>
            <form class="search-form search-form--black search-form-courses d-none d-md-flex" action="library-filters.html">
                <input type="text" class="form-control" placeholder="What would you like to learn?">
                <button class="btn" type="submit" role="button"><i class="material-icons">search</i></button>
            </form>
            <!-- Main Navigation -->
            <nav class="nav navbar-nav ml-auto flex-nowrap">
                @if (Route::has('login'))
                    @auth
                        @role('Admin')
                        <div class="nav-item dropdown d-none d-sm-flex ml-16pt">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <img width="32" height="32" class="rounded-circle" src="{{ url('assets/images/people/50/guy-3.jpg') }}" alt="student" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header"><strong>Administrador</strong></div>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="instructor-courses.html">Courses</a>
                                <a class="dropdown-item" href="instructor-quizzes.html">Quizzes</a>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-header"><strong>Account</strong></div>
                                <a class="dropdown-item" href="student-edit-account.html">Edit Account</a>
                                <a class="dropdown-item" href="student-billing-history.html">Billing</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </div>
                        </div>
                        @endrole
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
@endif
