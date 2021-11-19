<div class="container page__container">
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-lg-9">
                <div class="page-section">
                    <h4>Información básica</h4>
                    <div class="list-group list-group-form">
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Tipo de documento</label>
                                <div class="col-sm-4">
                                    <select wire:model="identity_document_type_id" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($identity_document_types as $identity_document_type)
                                            <option value="{{ $identity_document_type->id }}">{{ $identity_document_type->description }}</option>
                                        @endforeach
                                    </select>
                                    @error('identity_document_type_id') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Número</label>
                                <div class="col-sm-4">
                                    <input wire:model="number" type="text" class="form-control">
                                    @error('number') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Nombres</label>
                                <div class="col-sm-9">
                                    <input wire:model="names" type="text" class="form-control">
                                    @error('names') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Apellido Paterno</label>
                                <div class="col-sm-9">
                                    <input wire:model="last_name_father" type="text" class="form-control">
                                    @error('last_name_father') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Apellido Materno</label>
                                <div class="col-sm-9">
                                    <input wire:model="last_name_mother" type="text" class="form-control">
                                    @error('last_name_mother') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Región</label>
                                <div class="col-sm-4">
                                    <select wire:change="getProvinces" wire:model="department_id" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->description }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Province</label>
                                <div class="col-sm-4">
                                    <select wire:change="getDistricts" wire:model="province_id" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->description }}</option>
                                        @endforeach
                                    </select>
                                    @error('province_id') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Distrito</label>
                                <div class="col-sm-4">
                                    <select wire:model="district_id" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->description }}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Dirección</label>
                                <div class="col-sm-9">
                                    <input wire:model="address" type="text" class="form-control">
                                    @error('address') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Teléfono móvil</label>
                                <div class="col-sm-4">
                                    <input wire:model="mobile_phone" type="text" class="form-control">
                                    @error('mobile_phone') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3" for="birth_date">Fecha de nacimiento</label>
                                <div class="col-sm-4">
                                    <input wire:model="birth_date" onchange="this.dispatchEvent(new InputEvent('input'))" id="birth_date" type="text" class="form-control">
                                    @error('birth_date') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Género</label>
                                <div class="col-sm-4">
                                    <select wire:model="sex" class="form-control">
                                        <option value="">Seleccionar</option>
                                        <option value="1">Hombre</option>
                                        <option value="0">Mujer</option>
                                    </select>
                                    @error('sex') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Correo electrónico</label>
                                <div class="col-sm-9">
                                    <input wire:model="email" type="email" class="form-control" disabled>
                                    @error('last_name_mother') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 page-nav">
                <div class="page-section pt-lg-112pt">
                    @livewire('user.nav')
                    <div class="page-nav__content">
                        <button type="submit" wire:target="save" wire:loading.attr="disabled" class="btn btn-accent">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        window.addEventListener('set-person-update', event => {
            cuteAlert({
                type: "success",
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        });
        document.addEventListener('livewire:load', function () {
            $("#birth_date").flatpickr();
        });
    </script>
</div>
