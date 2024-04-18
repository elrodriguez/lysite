<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7 justify-content-center" style="margin-top: 95px;">
                <div class="card-group ">
                    <div class="card">
                        <div class="card-body">
                            <div class="modo-titulo text-center">
                                <h5>MODO</h5>
                                <h5>GRATUITO</h5>
                            </div>
                            <div class="modo-text" style="text-align: left;">
                                <p>-Acceso ilimitado a los cursos.</p>
                                <p>-Acceso ilimitado a las herramientas IA.</p>
                                <p>-1500 oportunidades en consultas a la IA.</p>
                                <p>-15 días de acompañamiento del asesor virtual.</p>
                            </div>
                            <div class="form-group  mt-4 btn-cent" style="margin-top: 20px; ">
                                <button type="submit" class="form-control btn btn-primary submit ">Registrado</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <div class="modo-titulo text-center">
                                <h5>MODO</h5>
                                <h5>STANDAR</h5>
                            </div>
                            <DIV class="modo-text" style="text-align: left;">
                                <p>-Acceso ilimitado a los cursos.</p>
                                <p>-Acceso ilimitado a las herramientas IA.</p>
                                <p>-3500 oportunidades en consultas a la IA.</p>
                                <p>-Acompañamiento 24 horas del asesor virtual.</p>
                            </DIV>
                            <div class="form-group-b mt-5 btn-cent">
                                <button type="submit" class="form-control btn btn-primary submit ">Unirse</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <div class="modo-titulo text-center">
                                <h5>MODO</h5>
                                <h5>PREMIUM</h5>
                            </div>
                            <DIV class="modo-text" style="text-align: left;">
                                <p>-Acceso ilimitado a los cursos.</p>
                                <p>-Acceso ilimitado a las herramientas IA.</p>
                                <p>-Oportunidades ilimitadas en consultas a la IA.</p>
                                <p>-Acompañamiento 24 horas del asesor virtual.</p>
                            </DIV>
                            <div class="form-group-b mt-4 btn-cent">
                                <button type="submit" class="form-control btn btn-primary submit ">Unirse</button>
                            </div>
                        </div>
                    </div>
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
