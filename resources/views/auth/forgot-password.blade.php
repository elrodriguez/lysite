 

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

        <div class="page-section bg-white">
            <div class="container page__container">
            
                
 <!-- Session Status -->
 <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

 <!-- Validation Errors -->
 <x-auth-validation-errors class="mb-4 text-center" :errors="$errors" />
 <form method="POST" action="{{ route('password.email') }}">
     @csrf
     <div class="form-group">
         <label>Email:</label>
         <input id="email" type="text" class="form-control" name="email" :value="old('email')"
             required autofocus placeholder="Your email address ...">
         <small class="form-text text-muted">Le enviaremos un correo para que pueda resetear su
             contraseña.</small>
     </div>

    
     <style>
         div.g-recaptcha {
             margin: 0 auto;
             width: 304px;
         }
     </style>
     <div>
         <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key')}}"></div>
         <!-- reCaptcha -->
     </div>
     <br />
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>



     <div class="text-center">
         <button class="btn btn-accent btn-lg">{{ __('Email Password Reset Link') }}</button>
     </div>
 </form>



            </div>
        </div>




        <x-slot name="navigation">
            <x-navigation></x-navigation>
        </x-slot>
</x-master>