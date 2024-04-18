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
<div class="media rosado-bajo ">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 col-md-offset-3 text-center">
                <small class="custom-padding">
                    <h5>Aumenta tus oportunidades: </h5>
                    <p>&nbsp;Únete a premium</p>
                    <a href="{{ route('modo_page') }}" class="rosadito">
                        Mejora
                    </a>
                </small>
            </div>
        </div>
    </div>
</div>
