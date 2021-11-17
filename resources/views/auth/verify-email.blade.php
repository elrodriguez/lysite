



<x-master>
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary py-32pt">
            <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                <img src="assets/images/illustration/student/128/white.svg" class="mr-md-32pt mb-32pt mb-md-0"
                    alt="student">
                <div class="flex mb-32pt mb-md-0">
                    <h1 class="text-white mb-0">Verificación de Correo</h1>
                    <p class="lead measure-lead text-white-50">si aún no has recibido el correo de verificación buscalo en "no deseados o Spam"</p>
                </div>
                
            </div>
        </div>

        <div class="page-section bg-white">
            <div class="container page__container">
            
                
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>
        
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif
        
                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
        
                        <div>
                            <x-button class="btn btn-primary form-control">
                                {{ __('Resend Verification Email') }}
                            </x-button>
                        </div>
                    </form>
        
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
        
                        <button type="submit" class="btn btn-danger form-control button">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>



            </div>
        </div>




        <x-slot name="navigation">
            <x-navigation></x-navigation>
        </x-slot>
</x-master>