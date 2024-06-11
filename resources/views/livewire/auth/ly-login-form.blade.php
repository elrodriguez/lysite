<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7 justify-content-center" style="margin-top: 95px;">
                <div class="card-group ">
                    @if (count($modos) > 0)
                        @foreach ($modos as $modo)
                            <div class="card">
                                <div class="card-body">
                                    <div class="modo-titulo text-center">
                                        <h5>{{ $modo->name }}</h5>
                                    </div>
                                    <div class="modo-text" style="text-align: left;">
                                        <p>-{{ $modo->detail_two }}.</p>
                                        <p>-{{ $modo->detail_three }}</p>
                                        <p>-{{ $modo->detail_four }}</p>
                                        <p>-{{ $modo->detail_five }}</p>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    @if ($modo->price > 0)
                                        <a href="{{ route('unirme_page', $modo->id) }}"
                                            class="form-control btn btn-orange submit">Unirse</a>
                                    @else
                                        <a href="{{ route('register') }}"
                                            class="form-control btn btn-primary submit">Registrado</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
            <div class="col-lg-5" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <div class="card carta-b position-absolute w-100 h-100 rounded wow zoomIn "
                        style="margin-top: 60px;">
                        <div class="modo-titulo-b">
                            <h5>Iniciar Sesión</h5>
                            <p>¿Usuario nuevo? <a href="{{ route('register') }}">Registrarme</a></p>
                        </div>
                        <form class="signin-form">
                            @csrf
                            <div class="form-login">
                                <label for="email"><strong>Correo electrónico</strong></label>
                                <input wire:model="email" id="email" type="email" name="email" required>
                                @error('email')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-login">
                                <label for="password"><strong>Contraseña</strong></label>
                                <input wire:model="password" wire:keydown.enter="login" id="password" name="password"
                                    type="password" required>
                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                @error('password')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (session()->has('message'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="form-group-c btn-cent-c">
                                <button wire:click="login" type="button"
                                    class="form-control btn btn-primary submit ">Iniciar
                                    Sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
