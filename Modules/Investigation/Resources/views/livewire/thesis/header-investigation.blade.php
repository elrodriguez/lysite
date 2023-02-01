<div class="nav-item">
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
            Investigación
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            @if (Auth::user()->hasrole('Admin') || Auth::user()->hasrole('Instructor'))
            <li><a class="dropdown-item" href="{{ route('investigation_thesis_all') }}">Ver todas las tésis</a></li>
            @endif
            <li><a class="dropdown-item" href="{{ route('investigation_thesis_create') }}">Crear Proyecto</a></li>
            <li><hr class="dropdown-divider"></li>
            @foreach ($thesis as $item)
            <li class="dropdown-item">
                <a href="{{ route('investigation_thesis_parts',$item->id) }}">{{ $item->short_name }}</a>
            </li>
            @endforeach
        </div>
    </div>
</div>
