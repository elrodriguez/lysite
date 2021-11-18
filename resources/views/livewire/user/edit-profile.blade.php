<div class="container page__container">
    <form wire:submit.prevent="save" >
        <div class="row">
            <div class="col-lg-9">
                <div class="page-section">
                    <h4>Privacidad del perfil</h4>
                    <div class="list-group list-group-form">
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Tu foto</label>
                                <div class="col-sm-9 media align-items-center">
                                    <a href="" class="media-left mr-16pt">
                                        @if($avatar_show)
                                        <img src="{{ url('storage/'.$avatar_show) }}" alt="people" width="56" class="rounded-circle" />
                                        @else
                                        <img src="{{ url(ui_avatars_url(Auth()->user()->name,56,'none',true)) }}" alt="people" width="56" class="rounded-circle" />
                                        @endif
                                    </a>
                                    <div class="media-body">
                                        <div  wire:ignore>
                                            <input wire:model="avatar" type="file"  id="inputGroupFile01">
                                            {{-- <label  for="inputGroupFile01">Elija el archivo</label> --}}
                                        </div>
                                        @error('avatar') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Nombre de Usuario</label>
                                <div class="col-sm-9">
                                    <input wire:model="username" type="text" class="form-control">
                                    @error('username') <span class="invalid-feedback-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Acerca de ti</label>
                                <div class="col-sm-9">
                                    <textarea wire:model="description" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="custom-control custom-checkbox">
                                <input wire:model="np" type="checkbox" class="custom-control-input" checked id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Muestra tu nombre real en tu perfil</label>
                                <small class="form-text text-muted">Si no está marcada, se mostrará su nombre de perfil en lugar de su nombre completo.</small>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="custom-control custom-checkbox">
                                <input wire:model="pp" type="checkbox" class="custom-control-input" checked id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">Permitir que todos vean tu perfil</label>
                                <small class="form-text text-muted">Si no está marcado, su perfil será privado y nadie, excepto usted, podrá verlo.</small>
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
        window.addEventListener('set-user-update', event => {
            cuteAlert({
                type: "success",
                title: event.detail.tit,
                message: event.detail.msg,
                buttonText: "Okay"
            });
        });
    </script>
</div>
