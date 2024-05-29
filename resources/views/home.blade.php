@extends('layouts.tutorio')
@section('styles')
    <style>
        body {
            font-family: "Roboto", sans-serif !important;
            color: #000000 !important;
            /*background-color: #ffffff;*/
            background-color: #151618 !important;
        }
    </style>
@stop
@section('content')

        <div class="hero_area" style="background: #000;">
            <!-- header section strats -->
            <x-lyontech.header></x-lyontech.header>
            <!-- end header section -->

            
      
            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content page-content">

                <div class="hero mod-orange py-48pt text-center text-sm-left">
                    <div class="bg-banner">
                        <img class="img"  style="margin-top: -50px; z-index: -1;" src="theme-lyontech/images/hero-bg.jpeg" alt="">
                        <div class="container" style="margin-top: -600px;">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-3">
                                    <div class="media-body text-container align-self-center">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h2 class="text-white" style="margin-top: 30px; font-size: 50px;">
                                                    DESCUBRE
                                                    HERRAMIENTAS DE INVESTIGACIÓN
                                                    IMPULSADAS POR IA.
                                                </h2>
                                                <p class="lead text-white-70" style="margin-top: -15px; font-size: 28px;">
                                                    Desarrolla tu investigación de manera más fácil, inteligente y rápida con lyonteach.
                                                </p>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <a href="" class="btn-border-white">Empezar Gratis</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="container page__container">
                    <div class="row">
                        <div class="col-md-4" style="text-align: center; padding: 0px">
                            <div class="" style="background: #fff; border-radius: 60px 0px 0px 60px;">
                                <img style="width: 50%;" src="{{ asset('theme-lyontech/images/ia-m.png') }}" alt="">
                                <h4 class="mb-0">
                                    CONSULTAS IA
                                </h4>
                                <p>
                                    Mejora tu investigación con la IA.
                                </p>
                                @can('academico_directo_cursos')
                                <a href="{{ route('dashboard_courses') }}" class="btn btn-black">Iniciar consultas</a>
                                @else
                                <a href="{{ route('modo_page') }}" class="btn btn-black">Iniciar consultas</a>
                                @endcan
                            </div>
                        </div>
                        <div class="col-md-4" style="text-align: center; padding: 0px;">
                            <div class="" style="background: #fff;">
                                <div>
                                    <img style="width: 50%;" src="{{ asset('theme-lyontech/images/libro-m.png') }}" alt="">
                                    <h4 class="mb-0">
                                        CURSOS
                                    </h4>
                                    <p>
                                        Aprende investigación de forma didáctica.
                                    </p>
                                    @can('academico_directo_gpt')
                                    <a href="{{ route('help_gpt') }}" class="btn btn-black">Iniciar cursos</a>
                                    @else
                                    <a href="{{ route('modo_page') }}" class="btn btn-black">Iniciar cursos</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="text-align: center; padding: 0px;">
                            <div class="" style="background: #fff; border-radius: 0px 60px 60px 0px;">
                                <img style="width: 50%;" src="{{ asset('theme-lyontech/images/hoja-m.png') }}" alt="">
                                <h4 class="mb-0">
                                    HOJA DE TRABAJO
                                </h4>
                                <p>
                                    Realiza avances online.
                                </p>
                                @can('academico_directo_tesis')
                                <a href="{{ route('worksheet', [13]) }}" class="btn btn-black">Empezar</a>
                                @else
                                <a href="{{ route('modo_page') }}" class="btn btn-black">Empezar</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container" style="padding: 60px 0px;">
                    <div class="row" style="padding: 20px 0px;">
                        <div class="col-md-4" style="position: relative;">
                            <div class="box-text" style="position: absolute;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%); 
                                    text-align:right;">
                                <h1 class="text-white mb-0"><strong>PRESENTACIÓN</strong></h1>
                                <h4 class="text-white mt-0" style="font-size: 35px;">Lyonteach </h4>
                            </div>
                        </div>
                        <div class="col-md-8 d-flex justify-content-center align-items-center">
                            <div class="card border-0 video-container" style="background-image: url({{ asset('theme-lyontech/images/fondo-card.jpg') }});">
                                <video width="100%" height="380" controls muted playsinline>
                                    <source src="video.mp4" type="video/mp4">
                                    Tu navegador no soporta el elemento de vídeo.
                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 20px 0px;">
                        <div class="col-md-6" style="position: relative;">
                            <div class="box-text" style="position: absolute;
                                    top: 50%;
                                    left: 5%;
                                    transform: translate(0%, -50%); 
                                    text-align:left;">
                                <h4 class="text-white mt-0" style="font-size: 25px;">Redacta tu investigación con soporte de la IA</h4>
                                <p class="text-white">
                                    Realiza tus avances de redacción en el editor online donde
                                    encontrarás una gía estructurada y herramientas que facilitarán 
                                    tu proceso.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="#">
                                <img style="width: 100%;" src="{{ asset('theme-lyontech/images/card1.jpg') }}">
                            </a>
                        </div>
                    </div>
                    <div class="row" style="padding: 20px 0px;">
                        <div class="col-md-6">
                            <a href="#">
                                <img style="width: 100%;" src="{{ asset('theme-lyontech/images/card2.jpg') }}">
                            </a>
                        </div>
                        <div class="col-md-6" style="position: relative;">
                            <div class="box-text" style="position: absolute;
                                    top: 50%;
                                    left: 5%;
                                    transform: translate(0%, -50%); 
                                    text-align:left;">
                                <h4 class="text-white mt-0" style="font-size: 25px;">
                                    Deja que el chatbot te ayude en el desarrollo de t investigación.
                                </h4>
                                <p class="text-white">
                                    Haz preguntas al chatbot ante cualquier duda, además, utiliza el prafraseador, referenciador
                                    y recomendador para avanzar tu investigación.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 20px 0px;">
                        <div class="col-md-6" style="position: relative;">
                            <div class="box-text" style="position: absolute;
                                    top: 50%;
                                    left: 5%;
                                    transform: translate(0%, -50%); 
                                    text-align:left;">
                                <h4 class="text-white mt-0" style="font-size: 25px;">
                                    Accede al chat con un asesor las 24 horas del día.
                                </h4>
                                <p class="text-white">
                                    Emite tus consultas en tiempo real con un experto, él encargado absolvera toda duda, además de
                                    corregir cualquier deficiencia que tengas.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="#">
                                <img style="width: 100%;" src="{{ asset('theme-lyontech/images/card3.jpg') }}">
                            </a>
                        </div>
                    </div>
                    <div class="row" style="padding: 20px 0px;">
                        <div class="col-md-6">
                            <a href="#">
                                <img style="width: 100%;" src="{{ asset('theme-lyontech/images/card4.jpg') }}">
                            </a>
                        </div>
                        <div class="col-md-6" style="position: relative;">
                            <div class="box-text" style="position: absolute;
                                    top: 50%;
                                    left: 5%;
                                    transform: translate(0%, -50%); 
                                    text-align:left;">
                                <h4 class="text-white mt-0" style="font-size: 25px;">
                                   Aprende sobre investigación de manera didáctica y entendible.
                                </h4>
                                <p class="text-white">
                                    Accede a los videos y guías de investigación preparados con estrategias prácticas
                                    para el planteamiento de cada apartado de la investigación.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
            <!-- // END Header Layout Content -->

        </div>

@stop
