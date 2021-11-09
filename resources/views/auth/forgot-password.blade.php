<x-master>
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary py-32pt">
            <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                <img src="assets/images/illustration/student/128/white.svg" class="mr-md-32pt mb-32pt mb-md-0" alt="student">
                <div class="flex mb-32pt mb-md-0">
                    <h1 class="text-white mb-0">Recupera tu contraseña</h1>
                    <p class="lead measure-lead text-white-50">se te enviará un email para que puedas resetear la contraseña</p>
                </div>
                <a href="{{ route('register') }}" class="btn btn-outline-white flex-column">
                    ¿No tienes una Cuenta todavía?
                    <span class="btn__secondary-text">!Registrate Aquí!</span>
                </a>
            </div>
        </div>

        <div class="mb-4 text-sm text-gray-600 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4 text-center" :errors="$errors" />

      <div class="text-center" >
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
    
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />
    
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

            </div>
            <br>
            <style>
                div.g-recaptcha {
                  margin: 0 auto;
                  width: 304px;
                }
                </style>
            <div>
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key')}}"></div>  <!-- reCaptcha -->                        
            </div>
            <br/>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            
      
            <div class="flex items-center justify-end">                
                
                <x-button class="btn btn-lg btn-accent">
                    
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
      </div>
    </x-slot>
    
    


    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot> 
</x-master>