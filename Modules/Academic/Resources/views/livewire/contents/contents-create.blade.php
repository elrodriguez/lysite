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

                            @switch($content_type_id)
                            @case(1)
                            <div class="form-group">
                                <label class="form-label" for="content_url">Enlace del Video *</label>
                                <input wire:model="content_url" type="text" class="form-control" id="content_url"
                                    placeholder="{{ __('labels.enter the video link here (youtube, vimeo, etc)') }}">
                                @error('content_url') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>
                            @break

                            @case(2)
                            <div class="form-group">
                                <label class="form-label" for="content_url">Texto *</label>
                                <textarea wire:model="content_url" class="form-control" id="content_url"></textarea>
                                @error('content_url') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>
                            @break

                            @case(3)
                            <div class="form-group">
                                <input type="file" wire:model="content_url"
                                    accept=".pdf,.doc ,.docx,.xls,.xlsx,.ppt,.pptx,.txt">
                                @error('content_url') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            @break

                            @case(4)
                            <div class="form-group">
                                @if ($content_url)

                                {{ __('labels.Photo Preview') }}:

                                <img class="img-fluid rounded float-right" alt="Responsive image" src="{{ $content_url->temporaryUrl() }}">

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
            });
        })
    </script>
</div>
