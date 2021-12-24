



<div class="">

    <div class="container page__container">
        <div class="col-lg-12 p-0 mx-auto">
            <div class="card card-body mb-32pt">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="card-title">{{ __('labels.Search and Assign Instructors') }}</h4>


                        @can('configuraciones_modulos_nuevo')
                        <a href="{{ route('academic_instructor_assign_create',$this->course_id) }}" type="button" class="btn btn-primary">{{ __('labels.Assign New Instructor') }}</a>

                        @endcan
                    </div>
                    <div class="col-lg-8 d-flex align-items-center">
                        <!-- Wrapper -->
                        <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>

                            <div class="search-form search-form--light mb-3">
                                <input wire:model="search" type="text" class="form-control search" placeholder="Search">
                                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                            </div>
                            <!-- Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Acciones</th>
                                        <th>{{ __('labels.Available Instructors') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach($instructors as $key => $instructor)
                                    <tr>
                                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                                        <td class="text-center align-middle">

                                            <div class="btn-group">
                                                @can('academico_secciones_editar')
                                                <a href="{{ route('academic_sections_editar',[$course_id,$instructor->person_id]) }}" type="button" class="btn btn-info btn-sm" title="{{ __('labels.Assign') }}"><i class="material-icons">person</i></a>
                                                @endcan

                                                @can('academico_secciones_eliminar')
                                                <button onclick="deletes({{ $instructor->person_id }})" type="button" class="btn btn-danger btn-sm" title="{{ __('labels.Remove assignment') }}"><i class="fa fa-trash-alt"></i></button>
                                                @endcan
                                            </div>

                                        </td>



                                        <td class="name align-middle">{{ $instructor->full_name }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-end" colspan="3">

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
        window.addEventListener('aca-section-delete', event => {
            cuteAlert({
                type: event.detail.res,
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        })
    </script>
</div>
