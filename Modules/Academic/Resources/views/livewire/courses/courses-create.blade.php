<div class="">
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME','Laravel') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('academic_courses') }}">{{ __('labels.Courses')}}</a></li>
            <li class="breadcrumb-item active">{{ __('labels.New') }}</li>
        </ol>
    </div>
    <div class="container page__container">
        <div class="col-lg-12 p-0 mx-auto">
            <div class="card card-body mb-32pt">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="card-title">Formulario de registro para Nuevo Curso</h4>
                        <p class="text-70">todos los campos que tienen * son obligatorios para el registro</p>
                    </div>
                    <div class="col-lg-8 d-flex align-items-center">
                        <form wire:submit.prevent="save" class="flex">

                            <div class="form-group">
                                <label class="form-label" for="name">Nombre *</label>
                                <input wire:model="name" type="text" class="form-control" id="name">
                                @error('name') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="name">Descripcion *</label>
                                <textarea wire:model="description" class="form-control" id="description"></textarea>
                                @error('description') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="main_video">{{ __('labels.Url').' '.__('labels.Main Video') }} *</label>
                                <input wire:model="main_video" type="text" class="form-control" id="main_video">
                                @error('main_video') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="name">{{ __('labels.Course Picture') }}</label>
                                @if ($course_image)

                                {{ __('labels.Photo Preview') }}:

                                <img class="img-fluid rounded float-right" alt="Responsive image" src="{{ $course_image->temporaryUrl() }}">

                                @endif
                                <input type="file" wire:model="course_image"
                                    accept="image/png, image/jpeg, image/jpg, image/bmp, image/gif">
                                @error('course_image') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input wire:model="status" class="custom-control-input" type="checkbox" value="" id="invalidCheck01" >
                                    <label class="custom-control-label" for="invalidCheck01">
                                        Estado
                                    </label>
                                </div>
                            </div>
                            <button type="submit" wire:loading.attr="disabled" wire:target="save" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('aca-courses-create', event => {
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
