<div class="nav-item">
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
            Investigación
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            @if (Auth::user()->hasrole('Admin') || Auth::user()->hasrole('Instructor'))
            <a class="dropdown-item" href="{{ route('investigation_thesis_all') }}">Ver todas las tesis</a>
            @endif
            <a class="dropdown-item" href="{{ route('investigation_thesis_create') }}">Crear Proyecto</a>
            @if(count($thesis) > 0)
                <div class="dropdown-divider"></div>
                @foreach ($thesis as $item)
                    <a class="dropdown-item" href="{{ route('investigation_thesis_parts',$item->id) }}">{{ $item->short_name }}</a>
                @endforeach
            @endif
        </div>
    </div>
</div>
