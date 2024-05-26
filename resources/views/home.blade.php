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
                                <div class="media">         
                                    <div class="media-body text-container align-self-center">
                                    <h2 class="text-white" style="margin-top: 30px; font-size: 50px;">
                                        DESCUBRE
                                        HERRAMIENTAS DE INVESTIGACIÓN
                                        IMPULSADAS POR IA.
                                    </h2>
                                    <p class="lead text-white-70" style="margin-top: -15px; font-size: 28px;">
                                        Desarrolla tu investigación de manera más fácil, inteligente y rápida con lyonteach.
                                    </p>
                                    <a href="" class="btn btn-black">Empezar Gratis</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container page__container">
                        <div class="row">
                            <div class="col-md-4" style="text-align: center; padding: 15px;">
                                <div class="" style="background: #fff;">
                                    <img style="width: 50%;" src="{{ asset('theme-lyontech/images/ia-m.png') }}" alt="">
                                    <h4 class="mb-0">
                                        CONSULTAS IA
                                    </h4>
                                    <p>
                                        Mejora tu investigación con la IA.
                                    </p>
                                    @can('academico_directo_cursos')
                                    <a href="{{ route('dashboard_courses') }}" class="btn btn-black">Empezar</a>
                                    @else
                                    <a href="{{ route('modo_page') }}" class="btn btn-black">Empezar</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-md-4" style="text-align: center; padding: 15px;">
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
                                        <a href="{{ route('help_gpt') }}" class="btn btn-black">Empezar</a>
                                        @else
                                        <a href="{{ route('modo_page') }}" class="btn btn-black">Empezar</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="text-align: center; padding: 15px;">
                                <div class="" style="background: #fff;">
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
    
            </div>
            <!-- // END Header Layout Content -->
  
            <br><br><br>

            <section class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <div class="card border-0">
                                <div class="card-body card-bg text-right ">
                                    <h2 class="text-white"><strong>PRESENTACIÓN</strong></h2>
                                    <h4 class="text-white" style="font-size: 2.8rem;">Lyonteach </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 d-flex justify-content-center align-items-center">
                            <div class="card border-0 video-container"
                                style="background-image: url({{ asset('theme-lyontech/images/fondo-card.jpg') }});">
                                <div class="card-body">
                                    <video width="620" height="420" controls muted playsinline>
                                        <source src="video.mp4" type="video/mp4">
                                        Tu navegador no soporta el elemento de vídeo.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="card border-0">
                                <div class="card-body card-bg text-s3">
                                    <h5 class="text-white"><strong>Redacta tu investigación con<strong></h5>
                                    <h5 class="text-white"><strong>soporte de la IA.<strong> </h5>
                                    <p class="text-white  mt-3">Realiza tus avances de redacción en el editor online
                                    </p>
                                    <p class="text-white">donde encontraras una guía estructurada y</p>
                                    <p class="text-white">herramientas que facilitarán tu proceso.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="card border-0"">
                                <div class="card-body card-bg">
                                    <a href="#"><img src="{{ asset('theme-lyontech/images/card1.jpg') }}"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end how section -->
            <!-- about  cards section -->
            <section class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="card border-0">
                                <div class="card-body card-bg">
                                    <a href="#"><img src="{{ asset('theme-lyontech/images/card2.jpg') }}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="card-boder-0">
                                <div class="card-body card-bg text-s3">
                                    <h5><strong>Deja que el chatbot te ayude en </strong></h5>
                                    <h5><strong>el desarrollo de tu invesitgación. </strong></h5>
                                    <p class="text-white  mt-3">Haz preguntas al chatbot ante cualquier duda,</p>
                                    <p class="text-white">además, utiliza el prafraseador, referenciador y</p>
                                    <p class="text-white">recomendador para avanzar tu investigación.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="card-boder-0">
                                <div class="text-s3 card-body card-bg ">
                                    <h5><strong> Accede al chat con un asesor</strong></h5>
                                    <h5><strong> las 24 horas del día.</strong></h5>
                                    <p class="text-white  mt-3">Emite tus consultas en tiempo real con un experto,</p>
                                    <p class="text-white">él encargado absolvera toda duda, además de</p>
                                    <p class="text-white">corregir cualquier deficiencia que tengas.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="card border-0">
                                <div class="card-body card-bg">
                                    <a href="#"><img src="{{ asset('theme-lyontech/images/card3.jpg') }}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="card border-0">
                                <div class="card-body card-bg">
                                    <a href="#"><img src="{{ asset('theme-lyontech/images/card4.jpg') }}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="card-boder-0">
                                <div class="text-s3 card-body card-bg ">
                                    <h5><strong>Aprende sobre investigación de </strong></h5>
                                    <h5><strong>manera didáctica y entendible.</strong> </h5>
                                    <p class="text-white mt-3">Accede a los videos y guías de investigación</p>
                                    <p class="text-white">preparados con estrategias prácticas para el</p>
                                    <p class="text-white">planteamiento de cada apartado de la investigación.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end cards  section -->
        </div>
        <!-- Banner end -->
        <!--fin div-->

        <!-- footer section -->
        <x-lyontech.footer></x-lyontech.footer>
        <!-- footer section -->
        </div>

@stop
