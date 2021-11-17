<x-master>
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary py-32pt">
            <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                <img src="assets/images/illustration/student/128/white.svg" class="mr-md-32pt mb-32pt mb-md-0"
                    alt="student">
                <div class="flex mb-32pt mb-md-0">
                    <h1 class="text-white mb-0">Recupera tu contraseña</h1>
                    <p class="lead measure-lead text-white-50">Ingresa tu nueva Contraseña</p>
                </div>
                <a href="{{ route('register') }}" class="btn btn-outline-white flex-column">
                    ¿No tienes una Cuenta todavía?
                    <span class="btn__secondary-text">!Registrate Aquí!</span>
                </a>
            </div>
        </div>

        <div class="page-section bg-white">
            <div class="container page__container">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4 text-center" :errors="$errors" />

                <form method="POST" action="{{ route('password.update') }}" class="col-sm-5 mx-auto">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group">
                        

                        <x-input id="email" class="form-control" type="hidden" name="email"
                            :value="old('email', $request->email)" required  />
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input id="password" type="password" class="form-control" name="password"
                            placeholder="Ingrese Nueva Contraseña ..." autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirme su Contraseña:</label>
                        <input id="password_confirmation" type="password" class="form-control"
                            name="password_confirmation" placeholder="Confirme su nueva Contraseña ...">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-accent btn-lg">{{ __('Reset Password') }}</button>
                    </div>
                </form>
            </div>
        </div>




        <x-slot name="navigation">
            <x-navigation></x-navigation>
        </x-slot>
</x-master>