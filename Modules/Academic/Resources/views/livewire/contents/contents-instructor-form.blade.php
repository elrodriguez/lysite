<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModalContent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SECCIÓN: {{ $this->section_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('academic::labels.type') }} *</label>
                                <select wire:model.defer="content_type_id" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($content_types as $content_type)
                                        <option value="{{ $content_type->id }}">{{ $content_type->name }}</option>
                                    @endforeach
                                </select>
                                @error('content_type_id') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('academic::labels.name') }} *</label>
                                <input wire:model.defer="name" type="text" class="form-control">
                                @error('name') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="content_url">{{ __('academic::labels.content') }} *</label>
                                <textarea wire:model.defer="content_url" class="form-control"></textarea>
                                @error('content_url') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button wire:click="saveContent" wire:loading.attr="disabled" wire:target="saveContent" class="btn btn-primary ml-auto">Guardar</button>
                    </div>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th>Contenido</th>
                                <th>Nombre Original</th>
                                <th>Numero de Orden</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($contents) > 0)
                                @foreach($contents as $key => $content)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $content->content_type_name }}</td>
                                    <td>{{ $content->content_name }}</td>
                                    <td>{{ $content->content_url }}</td>
                                    <td>{{ $content->original_name }}</td>
                                    <td class="text-center">{{ $content->count }}</td>
                                    <td>
                                        @if($content->status)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No Existen Registros</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener('aca-content-open-modal', event => {
            $('#exampleModalContent').modal('show')
        })
    </script>
</div>
