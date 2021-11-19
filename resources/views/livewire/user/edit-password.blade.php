<div class="container page__container">
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-lg-9">
                <div class="page-section">
                    <h4>{{ __('labels.change_password') }}</h4>
                    <div class="alert alert-light border-1 border-left-3 border-left-accent d-flex mb-24pt" role="alert">
                        <i class="material-icons text-accent mr-3">check_circle</i>
                        <div class="text-body">Confirme que es usted. escriba su contraseña actual.</div>
                    </div>
                    <div class="list-group list-group-form">
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Contraseña actual</label>
                                <div class="col-sm-9">
                                    <input wire:model="password_old" type="password" class="form-control">
                                    @error('password_old') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Nueva contraseña</label>
                                <div class="col-sm-9">
                                    <input wire:model="password_new" type="password" class="form-control">
                                    @error('password_new') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Confirmar Contraseña</label>
                                <div class="col-sm-9">
                                    <input wire:model="password_confirm" type="password" class="form-control">
                                    @error('password_confirm') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
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
        window.addEventListener('set-user-password-update', event => {
            cuteAlert({
                type: "success",
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        });
        window.addEventListener('set-user-password-notupdate', event => {
            cuteAlert({
                type: "error",
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        });
    </script>
</div>