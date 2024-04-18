@extends('layouts.lyontech')
@section('lycss')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/12-modo.css') }}">
@stop
@section('content')

    <body class="img js-fullheight" style="background-image: url({{ asset('theme-lyontech/images/fondo-naranja.jpg') }});">
        <div class="container ftco-section ">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                    <div class="container-fluid d-flex justify-content-center">
                        <div class="card">
                            <div class="row text-center">
                                <div class="col-md-4 col-lg-4">
                                    <div class="card card-body">
                                        <div class="modo-titulo text-center">
                                            <h5>MODO</h5>
                                            <h5>GRATUITO</h5>
                                        </div>
                                        <div class="modo-text" style="text-align: left;">
                                            <p>-Acceso ilimitado a los cursos.</p>
                                            <p>-Acceso ilimitado a las herramientas IA.</p>
                                            <p>-1500 oportunidades en consultas a la IA.</p>
                                            <p>-15 días de acompañamiento del asesor virtual.</p>
                                        </div>
                                        <div class="form-group  mt-5 btn-cent" style="margin-top: 20px; ">
                                            <a href="{{ route('register') }}"
                                                class="form-control btn btn-primary submit ">Registrado</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="card card-body">
                                        <div class="modo-titulo">
                                            <h5>MODO</h5>
                                            <h5>STANDAR</h5>
                                        </div>
                                        <DIV class="modo-text" style="text-align: left;">
                                            <p>-Acceso ilimitado a los cursos.</p>
                                            <p>-Acceso ilimitado a las herramientas IA.</p>
                                            <p>-3500 oportunidades en consultas a la IA.</p>
                                            <p>-Acompañamiento 24 horas del asesor virtual.</p>
                                        </DIV>
                                        <div class="form-group-b mt-5 btn-cent">
                                            <a href="{{ route('unirme_page', 'standar') }}"
                                                class="form-control btn btn-primary submit ">Unirse</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="card card-body">
                                        <div class="modo-titulo">
                                            <h5>MODO</h5>
                                            <h5>PREMIUM</h5>
                                        </div>
                                        <DIV class="modo-text" style="text-align: left;">
                                            <p>-Acceso ilimitado a los cursos.</p>
                                            <p>-Acceso ilimitado a las herramientas IA.</p>
                                            <p>-Oportunidades ilimitadas en consultas a la IA.</p>
                                            <p>-Acompañamiento 24 horas del asesor virtual.</p>
                                        </DIV>
                                        <div class="form-group-b mt-5 btn-cent">
                                            <a href="{{ route('unirme_page', 'premiun') }}"
                                                class="form-control btn btn-primary submit ">Unirse</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@stop
