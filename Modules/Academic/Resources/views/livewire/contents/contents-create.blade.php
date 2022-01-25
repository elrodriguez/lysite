<div class="">
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME','Laravel') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('academic_courses') }}">{{ __('academic::labels.courses') }}</a></li>
            <li class="breadcrumb-item">{{ $course->name }}</li>
            <li class="breadcrumb-item active"><a href="{{ route('academic_sections',$course->id) }}">{{ __('academic::labels.sections') }}</a></li>
            <li class="breadcrumb-item">{{ $section->title }}</li>
            <li class="breadcrumb-item active">{{ __('labels.Contents') }}</li>
        </ol>
    </div>
    <div class="container page__container">
        <div class="col-lg-12 p-0 mx-auto">
            <div class="card card-body mb-32pt">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="card-title">Registro de un Nuevo Contenido</h4>
                        <p class="text-70">todos los campos que tienen * son obligatorios para el registro</p>
                    </div>
                    <div class="col-lg-8 d-flex align-items-center">
                        <form enctype="multipart/form-data" wire:submit.prevent="save" class="flex">

                            <div class="form-group">
                                <label class="form-label" for="content_type_id">{{ __('labels.Content Type') }}
                                    *</label>
                                <select wire:model="content_type_id" type="select" class="form-control"
                                     id="content_type_id">
                                    @foreach ($content_types as $types)
                                    <option value="{{ $types->id }}">{{ $types->name }}</option>

                                    @endforeach
                                </select>
                                @error('content_type_id') <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="name">{{ __('labels.Name') }} *</label>
                                <input wire:model="name" type="text" class="form-control" id="name"
                                    placeholder="{{ __('labels.Name') }}">
                                @error('name') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>

                            @switch($content_type_id)
                            @case(1)
                            <div class="form-group">
                                <label class="form-label" for="content_url">URL *</label>
                                <input wire:model="content_url" type="text" class="form-control" id="content_url"
                                    placeholder="{{ __('labels.enter the video link here (youtube, vimeo, etc)') }}">
                                @error('content_url') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div><div class="modal">
                            @break

                            @case(2)
                            <div>
                                <label class="form-label" for="content_url">Texto *</label>
                            </div><div class="">
                            @break

                            @case(3)
                            <div class="form-group">
                                <input type="file" wire:model="content_url"
                                    accept=".pdf,.doc ,.docx,.xls,.xlsx,.ppt,.pptx,.txt">
                                @error('content_url') <span class="error">{{ $message }}</span> @enderror
                            </div><div class="modal">

                            @break

                            @case(4)
                            <div class="form-group">
                                @if ($content_url)

                                {{ __('labels.Photo Preview') }}:

                                <img class="img-fluid rounded float-right" alt="Responsive image"
                                    src="{{ $content_url->temporaryUrl() }}">

                                @endif
                                <input type="file" wire:model="content_url"
                                    accept="image/png, image/jpeg, image/jpg, image/bmp, image/gif">
                                @error('content_url') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            @break
                            @default
                            <div class="form-group">
                                <label class="form-label" for="content_url">URL *</label>
                                <input wire:model="content_url" type="text" class="form-control" id="content_url"
                                    placeholder="{{ __('labels.enter the video link here (youtube, vimeo, etc)') }}">
                                @error('content_url') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>
                            @endswitch

                            <!-- CK Editor 5 EDITOR -->

                            <div wire:ignore class="form-group" id="editorForm">
                                <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
                                <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/translations/sp.js"></script>

                                <textarea wire:model="content_url_editor" name="editor" class="form-control" id="editor"
                                    rows="10" cols="80">
                                </textarea>
                                @error('content_url') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                <script>
                                    ClassicEditor
                                    .create( document.querySelector( '#editor' ), {
                                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable','mediaEmbed', '|', 'undo', 'redo' ],
                                    heading: {
                                        options: [
                                            { model: 'paragraph', title: 'Normal', class: 'ck-heading_paragraph' },
                                            { model: 'heading1', view: 'h1', title: 'Muy Grande', class: 'ck-heading_heading1' },
                                            { model: 'heading2', view: 'h2', title: 'grande', class: 'ck-heading_heading2' },
                                            { model: 'heading3', view: 'h3', title: 'Mediano', class: 'ck-heading_heading3' }
                                        ]
                                    }
                                } )
                                        .then(function(editor){
                                            editor.model.document.on('change:data', ()=>{
                                                @this.set('content_url_editor', editor.getData());
                                            })
                                        })
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
                                <br>
                            </div></div>
                            <!-- CK Editor 5 EDITOR END END END END -->
                            <button type="submit" wire:loading.attr="disabled" wire:target="content_url, save"
                                class="btn btn-primary">Guardar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('aca-content-create', event => {
            cuteAlert({
                type: "success",
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            }).then(() => {
            @this.back();
        });
        })
    </script>
</div>

