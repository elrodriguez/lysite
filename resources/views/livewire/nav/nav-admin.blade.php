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
        <li class="nav-item dropdown {{ $path[0] == 'setting' ? 'active' : '' }}">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Configuracíon</a>
            <div class="dropdown-menu">
                <a class="dropdown-item {{ $path[0] == 'setting' && $path[1] == 'modules' ? 'active' : '' }}" href="{{ route('setting_modules') }}">Modulos</a>
                <a class="dropdown-item" href="instructor-quizzes.html">Roles</a>
                <a class="dropdown-item" href="instructor-edit-course.html">Usuarios</a>
                <a class="dropdown-item" href="instructor-edit-quiz.html">Edit Quiz</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Reports</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="instructor-earnings.html">Earnings</a>
                <a class="dropdown-item" href="instructor-statement.html">Statement</a>
            </div>
        </li>

    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item">
            <a href="instructor-profile.html" class="nav-link">Profile</a>
        </li>
    </ul>
</div>
