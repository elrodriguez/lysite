<x-master>
    <x-slot name="jumbotron">
        <div class="py-64pt bg-gradient-primary">
            <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                <img src="assets/images/illustration/student/128/white.svg" class="mr-md-32pt mb-32pt mb-md-0" alt="student">
                <div class="flex mb-32pt mb-md-0">
                    <h1 class="text-white mb-8pt">Sign Up</h1>
                    <p class="lead measure-lead text-white-50">Change your future today with over 1.000 professional courses from the top industry leading teachers and professionals.</p>
                </div>
                <a href="" class="btn btn-outline-white flex-column">
                    Questions?
                    <span class="btn__secondary-text">Visit our Help Center</span>
                </a>
            </div>
        </div>
    </x-slot>
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
    @livewire('auth.register-form')    
    
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot> 
</x-master>