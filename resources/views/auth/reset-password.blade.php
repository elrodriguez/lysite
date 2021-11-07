<x-master>
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary py-32pt">
            <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                <img src="assets/images/illustration/student/128/white.svg" class="mr-md-32pt mb-32pt mb-md-0"
                    alt="student">
                <div class="flex mb-32pt mb-md-0">
                    <h1 class="text-white mb-0">Recupera tu contraseña</h1>
                    <p class="lead measure-lead text-white-50">se te enviará un código de verificación</p>
                </div>
                <a href="{{ route('register') }}" class="btn btn-outline-white flex-column">
                    ¿No tienes una Cuenta todavía?
                    <span class="btn__secondary-text">!Registrate Aquí!</span>
                </a>
            </div>
        </div>

        <div class="mb-4 text-sm text-gray-600 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a
            password reset link that will allow you to choose a new one.') }}
        </div>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        <div class="text-center">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />
<br>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email', $request->email)" required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
<br>
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autofocus placeholder="Nueva Contraseña"/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
<br>
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required placeholder="Confirme Nueva Contraseña"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="btn btn-lg btn-accent">
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            </form>
        </div>




        <x-slot name="navigation">
            <x-navigation></x-navigation>
        </x-slot>
</x-master>