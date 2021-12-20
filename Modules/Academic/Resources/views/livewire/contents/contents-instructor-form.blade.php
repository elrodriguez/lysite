<div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalContent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SECCIÓN: {{ $this->section_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Contenido</th>
                                <th scope="col">Nombre Original</th>
                                <th scope="col">Numero de Orden</th>
                                <th scope="col">Estado</th>
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
