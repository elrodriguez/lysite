@php
$path = explode('/', request()->path());
$path[1] = array_key_exists(1, $path) > 0 ? $path[1] : '';
$path[2] = array_key_exists(2, $path) > 0 ? $path[2] : '';
$path[3] = array_key_exists(3, $path) > 0 ? $path[3] : '';
$path[4] = array_key_exists(4, $path) > 0 ? $path[4] : '';
@endphp
<div class="collapse navbar-collapse" id="navbar-submenu2">
    <ul class="nav navbar-nav">
        @can('configuraciones')
            <li class="nav-item {{ $path[0] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item dropdown {{ $path[0] == 'setting' ? 'active' : '' }}">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Configuracíon</a>
                <div class="dropdown-menu">
                    @can('configuraciones_modulos')
                        <a class="dropdown-item {{ $path[0] == 'setting' && $path[1] == 'modules' ? 'active' : '' }}"
                            href="{{ route('setting_modules') }}">Modulos</a>
                    @endcan
                    @can('configuraciones_roles')
                        <a class="dropdown-item {{ $path[0] == 'setting' && $path[1] == 'roles' ? 'active' : '' }}"
                            href="{{ route('setting_roles') }}">Roles</a>
                    @endcan
                    @can('configuraciones_usuarios')
                        <a class="dropdown-item {{ $path[0] == 'setting' && $path[1] == 'users' ? 'active' : '' }}"
                            href="{{ route('setting_users') }}">Usuarios</a>
                    @endcan
                    @can('configuraciones_modulos')
                        <a class="dropdown-item {{ $path[0] == 'setting' && $path[1] == 'modules' ? 'active' : '' }}"
                            href="{{ route('homepage_settings') }}">{{ __('labels.Homepage') }}</a>
                    @endcan
                </div>
            </li>
        @endcan
        @can('academico')
            <li class="nav-item dropdown {{ $path[0] == 'academic' ? 'active' : '' }}">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Academico</a>
                <div class="dropdown-menu">
                    @can('academico_tipo_contenido')
                        <a class="dropdown-item {{ $path[0] == 'academic' && $path[1] == 'content_types' ? 'active' : '' }}"
                            href="{{ route('academic_content_types') }}">{{ __('labels.Content Types') }}</a>
                    @endcan
                    @can('academico_cursos')
                        <a class="dropdown-item {{ $path[0] == 'academic' && $path[1] == 'courses' ? 'active' : '' }}"
                            href="{{ route('academic_courses') }}">Cursos</a>
                    @endcan
                    @can('academico_instructors')
                        <a class="dropdown-item {{ $path[0] == 'academic' && $path[1] == 'instructors' ? 'active' : '' }}"
                            href="{{ route('academic_instructors_list') }}">Instructor</a>
                    @endcan
                    @can('academico_alumnos')
                        <a class="dropdown-item {{ $path[0] == 'academic' && $path[1] == 'students' ? 'active' : '' }}"
                            href="{{ route('academic_students') }}">Alumnos y sus cursos</a>
                    @endcan
                    @can('academico_cursos_instructor')
                        <a class="dropdown-item {{ $path[0] == 'academic' && $path[1] == 'instructor' && $path[2] == 'courses' ? 'active' : '' }}"
                            href="{{ route('academic_dash_instructor_courses_list') }}">Cursos Instructor</a>
                    @endcan
                    @can('academico_reporte_total_alumnos')
                        <a class="dropdown-item {{ $path[0] == 'academic' && $path[1] == 'reports' && $path[2] == 'students_total' ? 'active' : '' }}"
                            href="{{ route('academic_reports_students_total') }}">Reporte Total Estudiantes</a>
                    @endcan
                </div>
            </li>
        @endcan
        @can('investigacion')
            <li class="nav-item dropdown {{ $path[0] == 'investigation' ? 'active' : '' }}">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">investigación</a>
                <div class="dropdown-menu">
                    @can('universities')
                        <a class="dropdown-item {{ $path[0] == 'investigation' && $path[1] == 'universities' ? 'active' : '' }}"
                            href="{{ route('Investigation_universities_list') }}">{{ __('labels.Universities') }}</a>
                    @endcan

                    @can('investigacion_partes')
                        <a class="dropdown-item {{ $path[0] == 'investigation' && $path[1] == 'thesis_formats' ? 'active' : '' }}"
                            href="{{ route('Investigation_thesis_formats_list_complete') }}">{{ __('labels.Thesis Formats') }}</a>
                    @endcan

                    @can('investigacion_tesis')
                        <a class="dropdown-item {{ $path[0] == 'investigation' && $path[1] == 'thesis' ? 'active' : '' }}"
                            href="{{ route('investigation_thesis_all') }}">{{ __('investigation::labels.all_thesis') }}</a>
                    @endcan

                    @can('investigacion_thesis_allowed')
                        <a class="dropdown-item {{ $path[0] == 'investigation' && $path[1] == 'thesis' ? 'active' : '' }}"
                            href="{{ route('investigation_thesis_permissions_thesis_allowed') }}" data-toggle="tooltip" data-placement="right"
                            title="permite indicar cuantas tesis puede crear una persona">
                            {{ __('labels.Permissions to create thesis') }}</a>
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
