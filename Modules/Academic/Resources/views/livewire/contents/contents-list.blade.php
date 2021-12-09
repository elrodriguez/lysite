<div class="">
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME','Laravel') }}</a></li>
            <li class="breadcrumb-item">{{ __('labels.Courses') }}</li>
            <li class="breadcrumb-item">{{ $course->name }}</li>
            <li class="breadcrumb-item active">{{ __('academic::labels.sections') }}</li>
            <li class="breadcrumb-item">{{ $section->title }}</li>
            <li class="breadcrumb-item active">{{ __('labels.Contents') }}</li>

        </ol>
    </div>
    <div class="container page__container">
        <div class="col-lg-12 p-0 mx-auto">
            <div class="card card-body mb-32pt">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="card-title">Listado</h4>
                        <p class="text-70">Módulos del sistema</p>
                        @can('configuraciones_modulos_nuevo')
                        <a href="{{ route('academico_contenido_create',$this->section_id) }}" type="button" class="btn btn-primary">Nuevo</a>
                        @endcan
                    </div>
                    <div class="col-lg-8 d-flex align-items-center">
                        <!-- Wrapper -->
                        <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
                            <!-- Search -->
                            <div class="search-form search-form--light mb-3">
                                <input wire:keydown.enter="getSearch" wire:model.defer="search" type="text" class="form-control search" placeholder="Search">
                                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                            </div>
                            <!-- Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Acciones</th>
                                        <th>{{ __('labels.Types') }}</th>
                                        <th>{{ __('labels.Content') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach($contents as $key => $content)
                                    <tr>
                                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                @can('academico_contenido_editar')
                                                <a href="{{ route('academico_contenido_editar',[$content->section_id, $content->id]) }}" type="button" class="btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('academico_contenido_eliminar')
                                                <button onclick="deletes({{ $content->id }})" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></button>
                                                @endcan
                                            </div>
                                        </td>
                                        <td class="name align-middle">{{ $content->content_type_id }}</td>
                                        <td class="name align-middle">{{ $content->content_url }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-end" colspan="3">
                                            <div class="d-flex flex-row-reverse">
                                                {{ $contents->links() }}
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deletes(id){
            cuteAlert({
                type: "question",
                title: "¿Desea eliminar estos datos?",
                message: "Advertencia:¡Esta acción no se puede deshacer!",
                confirmText: "Okay",
                cancelText: "Cancel"
            }).then((e)=>{
                if ( e == ("confirm")){
                    @this.destroy(id)
                }
            });
        }
        window.addEventListener('aca-content-delete', event => {
            cuteAlert({
                type: event.detail.res,
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        })
    </script>
</div>
