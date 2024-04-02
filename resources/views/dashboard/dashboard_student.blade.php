@extends('layouts.lyontech')
@section('lycss')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/7.css') }}">
@stop
@section('content')

    <body>
        <div class="hero_area">

            <!-- header section strats -->
            <x-lyontech.header></x-lyontech.header>
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
                                <p>&nbsp;Únete a premium</p> <button class="rosadito">Mejora</button>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="media mt-4">
                <div class="container-fluid">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="media">
                                <div class="media-body text-center text-login">
                                    <h5 class="mb-2">
                                        <strong style="font-size: 1.8rem;letter-spacing: 0.0em;">HERRAMIENTAS
                                            DE
                                            TRABAJO</strong>
                                    </h5>
                                    <p class="mt-1">Te presentamos las herramientas de trabajo. con ellas podrás
                                        potenciar el desarrollo de </p>
                                    <p class="mt-0">tu investigación, empieza ahora tu experiencia de la mano de
                                        lyonteach</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-5 mb-5">
                <div class="row borderless">
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <div class="card text-center">
                            <img class="card-img-top rounded-0 mt-2" src="{{ asset('theme-lyontech/images/ia-m.png') }}"
                                alt="Card image cap" style="width: 150px; height: 150px; margin: auto;">
                            <div class="card-body">
                                <h5 class=" mb-0" style="font-size: 1.2rem;">CONSULTAS IA</h5>
                                <p class="mt-0" style="font-size: 1rem;">Mejora tu investigación con la IA.</p>
                                <button type="button" class="btn btn-dark" href="#"
                                    style="width: 180px; height: 40px;">Empezar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <div class="card text-center">
                            <img class="card-img-top rounded-0 mt-2" src="{{ asset('theme-lyontech/images/libro-m.png') }}"
                                alt="Card image cap" style="width: 150px; height: 150px; margin: auto;">
                            <div class="card-body">
                                <h5 class=" mb-0"style="font-size: 1.2rem;">CURSOS</h5>
                                <p class="mt-0"
                                    style="font-size: 1rem;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; ">
                                    Aprende investigación de forma didáctica.</p>
                                <button type="button" class="btn btn-dark" href="#"
                                    style="width: 180px; height: 40px;">Empezar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <div class="card text-center">
                            <img class="card-img-top rounded-0 mt-2" src="{{ asset('theme-lyontech/images/hoja-m.png') }}"
                                alt="Card image cap" style="width: 150px; height: 150px; margin: auto;">
                            <div class="card-body ">
                                <h5 class=" mb-0"style="font-size: 1.2rem;">HOJA DE TRABAJO</h5>
                                <p class="mt-0" style="font-size: 1rem;">Realiza avances online.</p>
                                <button type="button" class="btn btn-dark" href="#"
                                    style="width: 180px; height: 40px;">Empezar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </body>
@stop
