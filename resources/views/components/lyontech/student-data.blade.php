<div class="media orange-medio">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="media">
                    <div class="image-container">
                        <img src="{{ asset('theme-lyontech/images/user-orange.jpg') }}"
                            class="align-self-end  b-img-fluid" alt="Card image cap" width="120">
                    </div>
                    <div class="media-body text-container align-self-center">
                        <h5>{{ Auth::user()->name }}</h5>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
