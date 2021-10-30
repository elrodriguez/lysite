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
    
    <div class="py-32pt navbar-submenu">
        <div class="container page__container">
            <div class="progression-bar progression-bar--active-accent">
                <a href="pricing.html" class="progression-bar__item progression-bar__item--complete">
                    <span class="progression-bar__item-content">
                        <i class="material-icons progression-bar__item-icon">done</i>
                        <span class="progression-bar__item-text h5 mb-0 text-uppercase">Pricing</span>
                    </span>
                </a>
                <a href="signup.html" class="progression-bar__item progression-bar__item--complete progression-bar__item--active">
                    <span class="progression-bar__item-content">
                        <i class="material-icons progression-bar__item-icon"></i>
                        <span class="progression-bar__item-text h5 mb-0 text-uppercase">Account details</span>
                    </span>
                </a>
                <a href="signup-payment.html" class="progression-bar__item">
                    <span class="progression-bar__item-content">
                        <i class="material-icons progression-bar__item-icon"></i>
                        <span class="progression-bar__item-text h5 mb-0 text-uppercase">Payment details</span>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white py-32pt py-lg-64pt">
        <div class="container page__container">
            <div class="col-lg-10 p-0 mx-auto">
                <div class="row">
                    <div class="col-md-6 mb-24pt mb-md-0">
                        <form action="signup-payment.html">
                            <div class="form-group">
                                <label for="name">Your first and last name:</label>
                                <input id="name" type="text" class="form-control" placeholder="Your first and last name ...">
                            </div>
                            <div class="form-group">
                                <label for="email">Your email:</label>
                                <input id="email" type="email" class="form-control" placeholder="Your email address ...">
                            </div>
                            <div class="form-group mb-24pt">
                                <label for="password">Password:</label>
                                <input id="password" type="password" class="form-control" placeholder="Your password ...">
                            </div>
                            <button class="btn btn-lg btn-accent">Create account</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h5>Purchase summary</h5>
                                <div class="d-flex mb-8pt">
                                    <div class="flex"><strong class="text-70">Subscription</strong></div>
                                    <strong>Student</strong>
                                </div>
                                <div class="d-flex mb-16pt pb-16pt border-bottom">
                                    <span class="material-icons text-muted mr-8pt">check</span>
                                    <span class="text-70">Access to over 1.000 high quality courses. For individuals.</span>
                                </div>
                                <div class="d-flex mb-16pt pb-16pt border-bottom">
                                    <div class="flex"><strong class="text-70">Price</strong></div>
                                    <strong>US &dollar;9 per month</strong>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked id="topic-all">
                                    <label class="custom-control-label">Terms and conditions</label>
                                    <small class="form-text text-muted">By checking here and continuing, I agree to the Tutorio Terms of Use</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-separator m-0">
        <div class="page-separator__text">or sign-in with</div>
        <div class="page-separator__bg-top bg-white"></div>
    </div>
    <div class="bg-body pt-32pt pb-32pt pb-md-64pt text-center">
        <div class="container page__container">
            <a href="signup-payment.html" class="btn btn-lg btn-secondary btn-block-xs">Facebook</a>
            <a href="signup-payment.html" class="btn btn-lg btn-secondary btn-block-xs">Twitter</a>
            <a href="signup-payment.html" class="btn btn-lg btn-secondary btn-block-xs">Google+</a>
        </div>
    </div>

    
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot> 
</x-master>