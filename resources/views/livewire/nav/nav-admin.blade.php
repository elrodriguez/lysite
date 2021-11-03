<div  class="collapse navbar-collapse" id="navbar-submenu2">
    <ul class="nav navbar-nav">

        <li class="nav-item active">
            <a href="instructor-dashboard.html" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Configuracíon</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('setting_modules') }}">Modulos</a>
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
