@php
    $path = explode('/', request()->path());
    $path[1] = (array_key_exists(1, $path)> 0)?$path[1]:'';
    $path[2] = (array_key_exists(2, $path)> 0)?$path[2]:'';
    $path[3] = (array_key_exists(3, $path)> 0)?$path[3]:'';
    $path[4] = (array_key_exists(4, $path)> 0)?$path[4]:'';
@endphp
<div  class="collapse navbar-collapse" id="navbar-submenu2">
    <ul class="nav navbar-nav">

        <li class="nav-item {{ $path[0] == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
        </li>
        @can('academico')
        <li class="nav-item dropdown {{ $path[0] == 'academic' ? 'active' : '' }}">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Academico</a>
            <div class="dropdown-menu">
                @can('academico_cursos')
                <a class="dropdown-item {{ $path[0] == 'academic' && $path[1] == 'courses' ? 'active' : '' }}" href="{{ route('academic_courses') }}">Cursos</a>
                @endcan
            </div>
        </li>
        @endcan
    </ul>
    {{-- <ul class="nav navbar-nav ml-auto">
        <li class="nav-item">
            <a href="instructor-profile.html" class="nav-link">Profile</a>
        </li>
    </ul> --}}
</div>
