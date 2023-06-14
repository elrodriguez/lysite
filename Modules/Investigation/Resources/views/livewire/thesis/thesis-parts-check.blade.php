<div>
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME', 'Laravel') }}</a></li>
            <li class="breadcrumb-item active">{{ __('investigation::labels.thesis_parts') }}</li>
            <li class="breadcrumb-item active">{{ $student_name }}</li>
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
                    {{-- <button wire:click="goEdit({{ $thesis_student->id }})" type="button" class="btn btn primary"><i
                            class="fa fa-pencil-alt mr-1"></i>
                    </button> --}}
                </div>
            </div>
        </div>
        <div class="card card-body mb-3">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-point-none">
                        @if (count($parts) > 0)
                            @foreach ($parts as $part)
                                @if ($part['id'] == $focus_id)
                                    <li class="alert alert-primary">
                                        <a class="alert-link"
                                            href="{{ route('investigation_thesis_check', [$thesis_id, $part['id']]) }}">
                                            {{ $part['number_order'] . ' ' . $part['description'] }}</a>
                                        {!! $part['items'] !!}
                                    </li>
                                @else
                                    <li>
                                        <a
                                            href="{{ route('investigation_thesis_check', [$thesis_id, $part['id']]) }}">
                                            {{ $part['number_order'] . ' ' . $part['description'] }}</a>
                                        {!! $part['items'] !!}
                                    </li>
                                @endif
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                Este formato un está pendiente de contenido. vuelve a intentarlo mas tarde o comunicarse con el administrador del sitio.
                            </div>
                        @endif
                    </ul>
                    {{-- <a href="{{ route('investigation_thesis_export_pdf', $thesis_id) }}"
                        class="btn btn-warning btn-block mt-3" target="_blank">
                        Exportar PDF
                    </a> --}}
                </div>
                <div class="col-lg-8">
                    @if ($focused_part)
                        <div class="row justify-content-md-center">
                            <div class="col col-lg-12">
                                <label class="form-label" for="content">{{ $focused_part->description }}</label>
                            </div>
                        </div>
                        <div class="flex">
                            @if ($focused_part->body == true)
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        {{-- <div wire:ignore>
                                            <textarea class="form-control" id="editor" rows="40" cols="80">{!! $content_old !!}</textarea>
                                        </div> --}}
                                        <div wire:ignore class="col-12" id="documentsheet">
                                            <div class="div-body" data-editor="DecoupledDocumentEditor" data-collaboration="false" data-revision-history="false">
                                                <div class="div-main">
                                                    <div class="centered" wire:ignore>
                                                        <div class="row">
                                                            <div class="document-editor__toolbar"></div>
                                                        </div>
                                                        <div class="row row-editor">
                                                            <div class="editor-container">
                                                                <div class="editor" id="editor">{!! $content_old !!}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('content')
                                            <span class="invalid-feedback-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="commentary">Nota:</label>
                                        <textarea wire:model.defer="commentary" id="commentary" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-9">
                                        <button type="button" class="btn-primary btn" wire:target="save"
                                            wire:loading.attr="disabled" onclick="savePart()">
                                            {{ __('labels.Save') }}
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <h5>Esta Sección solo es un título o subtitulo sin contenido.</h5>
                                    <input type="hidden" name="" id="editor">
                                </div>
                            @endif

                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        var data = "";

        window.addEventListener('inve-student-part-create', event => {
            cuteAlert({
                type: 'success',
                title: 'Enhorabuena',
                message: 'Se registro correctamente',
                buttonText: "Okay"
            });
        });

        document.addEventListener('livewire:load', function() {
            if (document.getElementById("editor").tagName == "DIV") {
                //CKEDITOR.replace('editor');
                activeCkeditor5TUTOR();
            }
        });

        function savePart() {
            if (document.getElementById("editor").tagName == "DIV") {
                //data = CKEDITOR.instances.editor.getData();
                data = window.editor.getData();
                @this.set('content', data);
                @this.save();
            }
        }
    </script>
    <script>
        function activeCkeditor5TUTOR() {
            DecoupledDocumentEditor.create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontSize',
                        'fontFamily',
                        '|',
                        'fontColor',
                        'fontBackgroundColor',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        '|',
                        'alignment',
                        '|',
                        'numberedList',
                        'bulletedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'todoList',
                        'link',
                        'blockQuote',
                        'imageUpload',
                        '|',
                        'paraphrase',
                        'completethesis',
                        'margins',
                        'referenciar',
                        'helpkeywords',
                        'comments',
                        'recommendation',
                        '|',
                        'undo',
                        'redo',
                        'pageBreak',
                        '|',
                        'specialCharacters',
                        'findAndReplace',
                        'mediaEmbed',
                        'insertTable'
                    ]
                },
                licenseKey: 'AH9z8JZzCLSSQ0QH0GEZwxX2c65Li7fafzEp7GaVXKRtezRZlEIY7lFoyIdA',
                simpleUpload: {
                    uploadUrl: "{{ route('investigation_thesis_upload_image') }}",
                    withCredentials: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                comments: {
                    ajax:{
                        url: "{{ route('investigation_thesis_selection_comments') }}",
                        data:{
                            thesi_student_part_id: {{ $thesisStudentPart->id ? $thesisStudentPart->id : null }},
                            thesi_student_id: {{ $thesisStudentPart->inve_thesis_student_id }},
                            thesi_format_part_id: {{ $thesisStudentPart->inve_thesis_format_part_id }}
                        },
                        method:'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    },
                    urlData: "{{ route('investigation_thesis_get_comments',$this->thesis_id) }}"
                },
                references:{
                    url:"{{ route('investigation_thesis_references') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                recommendation:{
                    url:"{{ route('investigation_thesis_recommendation') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                helpkeywords:{
                    url:"{{ route('investigation_thesis_grammar_correction') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                }
            }).then(editor => {
                window.editor = editor;
                document.querySelector('.document-editor__toolbar').appendChild(editor.ui.view.toolbar.element);
                document.querySelector('.ck-toolbar').classList.add('ck-reset_all');
            }).catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                );
                console.warn('Build id: nqbbe5edhs9m-u9490jx48w7r');
                console.error(error);
            });

        }

    </script>
</div>
