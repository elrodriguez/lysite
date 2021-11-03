<x-master>
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary py-32pt">
            <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                <img src="assets/images/illustration/student/128/white.svg" class="mr-md-32pt mb-32pt mb-md-0" alt="student">
                <div class="flex mb-32pt mb-md-0">
                    <h1 class="text-white mb-0">Sign In</h1>
                    <p class="lead measure-lead text-white-50">Account Management</p>
                </div>
                <a href="signup.html" class="btn btn-outline-white flex-column">
                    Don't have an account?
                    <span class="btn__secondary-text">Sign up Today!</span>
                </a>
            </div>
        </div>
    </x-slot>
    
    @livewire('auth.login-form')
    
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot> 
</x-master>