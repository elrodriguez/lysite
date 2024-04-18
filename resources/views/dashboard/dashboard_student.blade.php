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
            <x-lyontech.student-data></x-lyontech.student-data>

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
                                @can('academico_directo_gpt')
                                    <a type="button" class="btn btn-dark" href="{{ route('help_gpt') }}"
                                        style="width: 180px; height: 40px;">Empezar</a>
                                @else
                                    <a type="button" class="btn btn-dark" href="{{ route('modo_page') }}"
                                        style="width: 180px; height: 40px;">Empezar</a>
                                @endcan
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
                                @can('academico_directo_cursos')
                                    <a href="{{ route('dashboard_courses') }}" type="button" class="btn btn-dark"
                                        href="#" style="width: 180px; height: 40px;">Empezar</a>
                                @else
                                    <a href="{{ route('modo_page') }}" type="button" class="btn btn-dark" href="#"
                                        style="width: 180px; height: 40px;">Empezar</a>
                                @endcan
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
                                @can('academico_directo_tesis')
                                    <a href="{{ route('worksheet') }}" type="button" class="btn btn-dark" href="#"
                                        style="width: 180px; height: 40px;">Empezar</a>
                                @else
                                    <a href="{{ route('modo_page') }}" type="button" class="btn btn-dark" href="#"
                                        style="width: 180px; height: 40px;">Empezar</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </body>
@stop
