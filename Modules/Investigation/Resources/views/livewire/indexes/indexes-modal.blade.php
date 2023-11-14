<div>
    <div wire:ignore.self class="modal fade" id="modalIndexes" tabindex="-1" aria-labelledby="modalIndexesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalIndexesLabel">Índices</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 0 ? 'active' : '' }}" wire:click="activeType(0)"
                                href="javascript:void(0)">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 1 ? 'active' : '' }}" wire:click="activeType(1)"
                                href="javascript:void(0)">Tablas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 2 ? 'active' : '' }}" wire:click="activeType(2)"
                                href="javascript:void(0)">Imagenes</a>
                        </li>
                    </ul>
                    <div>
                        <button wire:click="addTitleIndexNew" type="button" class="btn btn-success btn-sm mb-4"><i
                                class="fa fa-plus mr-1"></i>Titulo</button>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-point-none">
                                @if (count($items) > 0)

                                    @foreach ($items as $k => $item)
                                        <li>
                                            @if ($item['id'])
                                                <div class="btn-group mr-3">
                                                    <button type="button" class="btn btn-secondary btn-sm">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-secondary btn-sm">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            @endif

                                            <div class="input-group input-group-sm mb-3">
                                                <input wire:model="items.{{ $k }}.prefix"
                                                    id="prefix-{{ $k }}" type="text" class="form-control">
                                                <input wire:model="items.{{ $k }}.content"
                                                    id="content-{{ $k }}" type="text" class="form-control"
                                                    style="background: #fff">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <ul id="sub-items{{ $k . $item['id'] }}">

                                            </ul>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $.fn.editable.defaults.mode = 'inline';
        window.addEventListener('inve-thesis-indexes-item', event => {
            let index = event.detail.keyItem;

        });
    </script>
</div>
