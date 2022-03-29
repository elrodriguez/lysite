<div class="nav-item">
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
            Investigación
        </a>
      
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{ route('investigation_thesis_create') }}">Crear Proyecto</a></li>
            <li><hr class="dropdown-divider"></li>
            @foreach ($thesis as $item)
            <li class="dropdown-item">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <i wire:click="goEdit({{ $item->id }})" class="fa fa-pencil-alt mr-1"></i>
                    <i wire:click="goParts({{ $item->id }})" class="fa fa-book mr-1"></i>
                    <i class="fa fa-trash-alt mr-1"></i>
                  </div>
                <a href="{{ route('investigation_thesis_parts',$item->id) }}">{{ $item->short_name }}</a>
            </li>
            @endforeach
        </div>
    </div>
</div>
