@extends('layouts.tutorio')
@section('lycss')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
@stop
@section('content')

    <div class="img js-fullheight" style="background-image: url({{ asset('theme-lyontech/images/fondo-naranja.jpg') }});">
        <div class="container-fluid  page__container">
            <div class="row align-content-center justify-content-center">
                <div class="col-md-5">			
                    <div class="card bg-black-transparent">
                        <div class="card-body mt-3 text-center">                                                                         
                            <h5 class="mb-4 text-center">¡Mejora Adquirida!</h5>
                            <p style="color: #000;">
                                Haz obtenido mejores oportunidades para el desarrollo de tu investigación, empieza a redactar tu investigación
                                de la manera más facil, ahora.
                            </p>
                            <form action="#" class="signin-form mt-2">
                                <div class="form-group mt-4 btn-cent mb-4">
                                    <button type="submit" class="form-control btn btn-orange submit "><strong>Empezar</strong></button>
                                </div>
                            </form>
                        </div>    
                    </div>
                </div>    
            </div>
        </div>
    </div>
@stop
