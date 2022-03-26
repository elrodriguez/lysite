<div class="">
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME','Laravel') }}</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('Investigation_thesis_formats_list_complete') }}">{{ __('labels.Thesis Formats') }}</a></li>
            <li class="breadcrumb-item active">{{ __('labels.New Thesis Format') }}</li>
        </ol>
    </div>
    <div class="container page__container">
        <div class="col-lg-12 p-0 mx-auto">
            <div class="card card-body mb-32pt">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="card-title">Formulario de registro para Nuevo Formato de Tesis</h4>
                        <p class="text-70">todos los campos que tienen * son obligatorios para el registro</p>
                    </div>
                    <div class="col-lg-8 d-flex align-items-center">
                        <form wire:submit.prevent="save" class="flex">

                            <div class="form-group">
                                <label class="form-label" for="name">{{ __('labels.Format name') }} *</label>
                                <input wire:model="name" type="text" class="form-control" id="name">
                                @error('name') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="description">{{ __('labels.Description') }} *</label>
                                <input wire:model="description" type="text" class="form-control" id="description">
                                @error('description') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="type_thesis">{{ __('labels.Type Thesis') }}
                                    *</label>
                                <select
                                    wire:model.defer="type_thesis"
                                    type="select"
                                    class="form-control"
                                    id="type_thesis"
                                    onchange="selectType(event)"
                                >
                                    <option value="">Seleccionar</option>
                                    @foreach ($enum_types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>

                                    @endforeach
                                </select>
                                @error('type_thesis')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="normative_thesis">{{ __('labels.Normative / Style') }}
                                    *</label>
                                <select
                                    wire:model.defer="normative_thesis"
                                    type="select"
                                    class="form-control"
                                    id="normative_thesis"
                                    onchange="selectType(event)"
                                >
                                    <option value="">Seleccionar</option>
                                    @foreach ($enum_normatives as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>

                                    @endforeach
                                </select>
                                @error('normative_thesis')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="country">{{ __('labels.Country') }}
                                    *</label>
                                <select
                                    wire:model.defer="country"
                                    type="select"
                                    class="form-control"
                                    id="country"
                                    onchange="selectCountry(event)"
                                >
                                    <option value="">Seleccionar</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->description }}</option>

                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="form-label" for="universities">{{ __('labels.University') }}
                                    *</label>
                                <select
                                    wire:model.defer="universities"
                                    type="select"
                                    class="form-control"
                                    id="universities"
                                    onchange="selectUniversity(event)"
                                >
                                    <option value="">Seleccionar</option>
                                    @foreach ($universities as $university)
                                    <option value="{{ $university->id }}">{{ $university->name }}</option>

                                    @endforeach
                                </select>
                                @error('universities')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="form-label" for="schools">{{ __('labels.School') }}
                                    *</label>
                                <select
                                    wire:model.defer="schools"
                                    type="select"
                                    class="form-control"
                                    id="schools"
                                    onchange="selectUniversity_d(event)"
                                >
                                    <option value="">Seleccionar</option>
                                    @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name }}</option>

                                    @endforeach
                                </select>
                                @error('schools')
                                    <span class="invalid-feedback-2">{{ $message }}</span>
                                @enderror
                            </div>


                            <button type="submit" wire:loading.attr="disabled" wire:target="save" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('thesis-format-create', event => {
            cuteAlert({
                type: "success",
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            }).then(() => {
            @this.back();
        });
        })

        function selectCountry(e){
            let t = e.target.value;
            @this.getUniversities(t);
        }
        function selectUniversity(e){
            let t = e.target.value;
            @this.getSchools(t);
        }
        </script>
</div>
