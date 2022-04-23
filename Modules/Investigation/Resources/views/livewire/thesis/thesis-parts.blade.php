<div>
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME', 'Laravel') }}</a></li>
            <li class="breadcrumb-item active">{{ __('investigation::labels.thesis_parts') }}</li>
        </ol>
    </div>
    <div class="container page__container">
        <div class="d-flex flex-wrap align-items-start mb-3">
            <div class="d-flex mr-24pt">
                <div class="flex">
                    <a class="text-body"
                        href="{{ route('investigation_thesis_parts', $thesis_student->id) }}"><strong>{{ $thesis_student->title }}</strong></a><br>
                </div>
            </div>
            <div class="d-flex align-items-center py-4pt" style="white-space: nowrap;">
                <div class="btn-group" role="group" aria-label="">
                    <button wire:click="goEdit({{ $thesis_student->id }})" type="button" class="btn btn primary"><i
                            class="fa fa-pencil-alt mr-1"></i></button>
                    <button onclick="deleteThesisStudent({{ $thesis_student->id }})" type="button"
                        class="btn btn primary"><i class="fa fa-trash-alt mr-1"></i></button>
                </div>
            </div>
        </div>
        <div class="card card-body mb-0">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-point-none">
                        @if (count($parts) > 0)
                            @foreach ($parts as $part)
                                @if ($part['id'] == $focus_id)
                                    <li class="alert alert-primary">
                                        <a class="alert-link"
                                            href="javascript:changeFocus({{ $thesis_id . ', ' . $part['id'] }})">
                                            {{ $part['number_order'] . ' ' . $part['description'] }}</a>
                                        {!! $part['items'] !!}
                                    </li>
                                @else
                                    <li>
                                        <a href="javascript:changeFocus({{ $thesis_id . ', ' . $part['id'] }})">
                                            {{ $part['number_order'] . ' ' . $part['description'] }}</a>
                                        {!! $part['items'] !!}
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-8">
                    <div class="row justify-content-md-center">
                        <div class="col col-lg-9">
                            <label class="form-label" for="content">{{ $focused_part->description }}</label>
                        </div>
                        <div class="col col-lg-3">
                            <div class="btn-group mr-2">
                                <button type="button" class="btn btn-secondary btn-sm" wire:click="showVideo">
                                    <i class="fa fa-video"></i>
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip"
                                    data-placement="top" title="{{ $focused_part->information }}">
                                    <i class="fa fa-info-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex">

                        @if ($focused_part->body == true)
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div wire:ignore>
                                        <textarea  class="form-control" id="editor" rows="40" cols="80">{!! $content_old !!}</textarea>
                                    </div>
                                    @error('content')
                                        <span class="invalid-feedback-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-9">
                                    <div class="custom-control">

                                        <button type="button" class="btn-primary btn" wire:loading.attr="disabled"
                                            onclick="saveThesisPartStudent()">{{ __('labels.Save') }}</button>
                                    </div>
                                </div>


                                
                            </div>
                        @else
                            <div>
                                <h4>Esta Sección solo es un título o subtitulo sin contenido.</h4>
                            </div>
                        @endif
                        <div class="form-group col-3">
                            <div class="custom-control custom-checkbox">
                                <input wire:model="auto_save" class="custom-control-input" type="checkbox"
                                    value="" id="invalidCheck01">
                                <label class="custom-control-label" for="invalidCheck01" onclick="toggleSaving()">
                                    Auto Guardar
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="editor">
                </div>
            </div>
        </div>
        {{-- modal video --}}
        <div class="ventana_flotante" style="display: none" id="video-flotante">

            <div class="content">

                <div class="header">

                    <h5 class="title" id="exampleModalLabel">ITUTLASOD ASD AS/</h5>

                    <button type="button" class="close" onclick="closeVideo()" aria-label="Close">

                        <span aria-hidden="true close-btn">×</span>

                    </button>

                </div>

                <div class="body">

                    <div class="js-player embed-responsive embed-responsive-16by9 mb-32pt">
                        <div class="player embed-responsive-item">
                            <div class="player__content">
                                <div class="player__image"
                                    style="--player-image: url(assets/images/illustration/player.svg)">
                                </div>
                                <a href="" class="player__play">
                                    <span class="material-icons">play_arrow</span>
                                </a>
                            </div>

                            <div class="player__embed d-none">
                                <!-- Aqui abajo va el Video -->
                                <iframe class="embed-responsive-item" id="iframeVideoPart" allowfullscreen=""></iframe>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="footer">
                    <button type="button" onclick="closeVideo()" class="btn btn-secondary close-btn">
                        {{ __('labels.Close') }}
                    </button>
                </div>

            </div>

        </div>
    </div>
    <script>
        var data;
        function deletes(id) {
            cuteAlert({
                type: "question",
                title: "¿Desea eliminar estos datos?",
                message: "Advertencia:¡Esta acción no se puede deshacer!",
                confirmText: "Okay",
                cancelText: "Cancel"
            }).then((e) => {
                if (e == ("confirm")) {
                    @this.destroy(id)
                }
            });
        }
        window.addEventListener('inve-student-part-create', event => {
            cuteAlert({
                type: event.detail.res,
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        });
        window.addEventListener('inve-open-modal-video', event => {
            if (event.detail.success) {
                let url = "https://player.vimeo.com/video/" + event.detail.video +
                    "?title=0&amp;byline=0&amp;portrait=0"
                document.getElementById("iframeVideoPart").src = url;
                document.getElementById('video-flotante').style.display = 'block';
            } else {
                cuteAlert({
                    type: 'error',
                    title: 'Salió mal',
                    message: 'No tiene videos vinculados',
                    buttonText: "Okay"
                });
            }
        });

        function closeVideo() {
            document.getElementById('video-flotante').style.display = 'none';
            document.getElementById("iframeVideoPart").src = null;
        }

        function deleteThesisStudent(id) {
            cuteAlert({
                type: "question",
                title: "¿Desea eliminar estos datos?",
                message: "Advertencia:¡Esta acción no se puede deshacer!",
                confirmText: "Okay",
                cancelText: "Cancel"
            }).then((e) => {
                if (e == ("confirm")) {
                    @this.deleteThesis(id)
                }
            });
        }

        function changeFocus(thesis_id, part_id) { //funcion para cambiar de sección y revisar cambios
            let as = document.getElementById("invalidCheck01").checked;
            //let as = @js($auto_save);
            console.log(as);
            if (!as) { //autosave desactivado
                updateContent();
                let old = document.getElementById("content_old").value;
                let actual = data; //ahora el actual esta en data
                if (old != actual) {
                    cuteAlert({
                        type: "question",
                        title: "¿Vas a cambiar de Sección y no has guardado tu contenido, deseas Guardarlo ahora?",
                        message: "Advertencia:¡Esta acción no se puede deshacer!",
                        confirmText: "Guardar",
                        cancelText: "No Guardar"
                    }).then((e) => {
                        if (e == ("confirm")) {
                            @this.savingThesisPartStudentBeforeChange(thesis_id, part_id);
                        } else {
                            @this.withoutSavingThesisPartStudentBeforeChange(thesis_id, part_id);
                        }
                    });
                } else {
                    @this.withoutSavingThesisPartStudentBeforeChange(thesis_id, part_id);
                }
            } else { //autosave activado
                updateContent();
                let old = document.getElementById("content_old").value;
                let actual = data; //ahora el actual esta en data
                if (old != actual) {
                    @this.savingThesisPartStudentBeforeChange(thesis_id, part_id);
                } else {
                    @this.withoutSavingThesisPartStudentBeforeChange(thesis_id, part_id);
                }
            }

        }

        window.addEventListener('inve-thesis-delete', event => {
            cuteAlert({
                type: event.detail.res,
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            }).then(() => {
                @this.dashboard_next();
            });
        });

        document.addEventListener('livewire:load', function() {
            if (document.getElementById("editor")) {
                CKEDITOR.replace('editor');
            }
        })

        function saveThesisPartStudent() {
            updateContent();
            @this.saveThesisPartStudentN(true)
        }
    </script>
    <input type="hidden" id="content_old" wire:model='content_old'>
    <script>
        //Codigo para el Intervalo de AutoGrabado
        var TimeSave;
        var time = 30; //se configura el tiempo en segundos.
        time = time * 1000; //se pasa a milisegundos


        function activarAutoGuardado() {
            TimeSave = setInterval(saving, time);
        }

        function stopSaving() {
            clearInterval(TimeSave);
        }

        function saving() {
            updateContent();
            let old = document.getElementById("content_old").value;
            let actual = data; //ahora el actual esta en data
            let as = document.getElementById('invalidCheck01');
            // revisa que autoguardado esté activado y que haya habido cambio en el contenido
            if (as.checked && old != actual) {
                @this.saveThesisPartStudentAutoSave(); // se guarda el contenido
            }
        }

        function updateContent(){
            data = CKEDITOR.instances.editor.getData();
            @this.set('content', data);
        }

        function toggleSaving(){
            @this.toggleSaving();
        }
        window.onload = activarAutoGuardado; //activa el intervalo de tiempo
    </script>
</div>
