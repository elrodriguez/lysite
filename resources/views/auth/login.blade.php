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
    
    <div class="bg-white pt-32pt pt-sm-64pt pb-32pt">
        <div class="container page__container">
            <form action="student-dashboard.html" class="col-md-5 p-0 mx-auto">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" type="text" class="form-control" placeholder="Your email address ...">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" class="form-control" placeholder="Your first and last name ...">
                    <p class="text-right"><a href="reset-password.html" class="small">Forgot your password?</a></p>
                </div>
                <div class="text-center">
                    <button class="btn btn-lg btn-accent">Login</button>
                </div>
            </form>
        </div>
    </div>
    <div class="page-separator m-0">
        <div class="page-separator__text">or sign-in with</div>
        <div class="page-separator__bg-top bg-white"></div>
    </div>
    <div class="bg-body pt-32pt pb-32pt pb-md-64pt text-center">
        <div class="container page__container">
            <a href="student-dashboard.html" class="btn btn-lg btn-secondary btn-block-xs">Facebook</a>
            <a href="student-dashboard.html" class="btn btn-lg btn-secondary btn-block-xs">Twitter</a>
            <a href="student-dashboard.html" class="btn btn-lg btn-secondary btn-block-xs">Google+</a>
        </div>
    </div>
    
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot> 
</x-master>