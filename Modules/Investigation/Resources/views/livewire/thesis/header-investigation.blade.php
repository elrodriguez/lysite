<div class="nav-item  dropdown mt-2" style=" padding: 0px 10px;">
    <div class="dropdown">
        @if (Auth::user()->hasrole('Admin') || Auth::user()->hasrole('Instructor'))
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-expanded="false" style="font-size: 23px;">
                Investigación
            </a>
        @else
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" style="font-size: 23px;">
                Investigación
            </a>
        @endif

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            @if (Auth::user()->hasrole('Admin') || Auth::user()->hasrole('Instructor'))
                <a class="dropdown-item" href="{{ route('investigation_thesis_all') }}">Ver todas las tesis</a>
            @endif
            <a class="dropdown-item" href="{{ route('investigation_thesis_create') }}">Crear Proyecto</a>
            @if (count($thesis) > 0)
                <div class="dropdown-divider"></div>

                @if (Auth::user()->hasrole('Admin') || Auth::user()->hasrole('Instructor'))
                    @foreach ($thesis as $item)
                        <a class="dropdown-item" href="{{ route('investigation_thesis_parts', $item->id) }}">
                            {{ $item->short_name }}
                        </a>
                    @endforeach
                @else
                    @foreach ($thesis as $item)
                        <a class="dropdown-item" href="{{ route('worksheet', $item->id) }}">{{ $item->short_name }}</a>
                    @endforeach
                @endif
            @endif
        </div>
    </div>
</div>
