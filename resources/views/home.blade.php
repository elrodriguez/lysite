<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />


    <title>{{ env('APP_NAME', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- slider stylesheet -->
    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- bootstrap 4.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme-lyontech/css/index/bootstrap.css') }}" />
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('theme-lyontech/css/index/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('theme-lyontech/css/index/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme-lyontech/css/index/lyontech.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">


        <!-- header section strats -->
        <x-lyontech.header></x-lyontech.header>
        <!-- end header section -->
        <!-- slider section -->
        <div class="bannen_inner" style="background-image: url({{ asset('theme-lyontech/images/hero-bg.jpeg') }})">
            <div class="container-fluid">
                <div class="row marginii">
                    <div class="col-xl-9 col-lg-9 col-md-6 col-sm-12">
                        <div class="slider-text-h2">
                            <h2 class="espacio-top"><strong>DESCUBRE</strong></h2>
                            <h2><strong>HERRAMIENTAS DE INVESTIGACIÓN</strong></h2>
                            <h2><strong>IMPULSADAS POR IA.</strong></h2>
                        </div>
                        <div class="slider-text-p">
                            <p>Desarrolla tu investigación de manera más fácil,</p>
                            <p> inteligente y rápida con lyonteach.</p>
                        </div>
                        <div class="d-flex justify-content-center justify-content-lg-end">
                            <a class="btn btn-lg btn-outline-light" href="#" role="button"><strong
                                    style="font-size: 1.8rem;">EMPEZAR GRATIS</strong></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slider section -->
            <!-- Banner Start -->
            <div class="container-fluid banner mb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="card text-center mx-0  banner-margin-left" style="width: 15rem;">
                            <img class="card-img-top rounded-0 mt-3" src="{{ asset('theme-lyontech/images/ia.png') }}"
                                alt="Card image cap" style="width: 80px; height: 80px; margin: auto;">
                            <div class="card-body card-body-reduced-padding">
                                <h5 class="card-title mb-0" style="font-size: 0.9rem;"><strong>CONSULTAS IA</strong>
                                </h5>
                                <p class="card-text mt-0" style="font-size: 0.8rem;">Mejora tu investigacion con la
                                    IA.</p>
                                @can('academico_directo_gpt')
                                    <a href="{{ route('help_gpt') }}" type="button" class="btn btn-dark" href="#"
                                        style="width: 180px; height: 40px;">Iniciar consultas</a>
                                @else
                                    <a href="{{ route('modo_page') }}" type="button" class="btn btn-dark" href="#"
                                        style="width: 180px; height: 40px;">Iniciar consultas</a>
                                @endcan
                            </div>

                        </div>
                        <div class="card text-center mx-0 banner-margin" style=" width: 18rem;">
                            <img class="card-img-top rounded-0 mt-3"
                                src="{{ asset('theme-lyontech/images/tesis.png') }}" alt="Card image cap"
                                style="width: 80px; height: 80px; margin: auto;">
                            <div class="card-body card-body-reduced-padding">
                                <h5 class="card-title  mb-0"style="font-size: 0.9rem;"><strong>CURSOS</strong></h5>
                                <p class="card-text mt-0"
                                    style="font-size: 0.8rem;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; ">
                                    Aprende investigacion de forma didactica.</p>
                                @can('academico_directo_cursos')
                                    <a href="{{ route('dashboard_courses') }}" type="button" class="btn btn-dark"
                                        href="#" style="width: 180px; height: 40px;">Ir a los cursos</a>
                                @else
                                    <a href="{{ route('modo_page') }}" type="button" class="btn btn-dark" href="#"
                                        style="width: 180px; height: 40px;">Ir a los cursos</a>
                                @endcan
                            </div>
                        </div>
                        <div class="card text-center mx-0  banner-margin-right" style="width: 15rem;">
                            <img class="card-img-top rounded-0 mt-3"
                                src="{{ asset('theme-lyontech/images/hoja.png') }}" alt="Card image cap"
                                style="width: 80px; height: 80px; margin: auto;">
                            <div class="card-body card-body-reduced-padding">
                                <h5 class="card-title mb-0"style="font-size: 0.9rem;"><strong>HOJA DE TRABAJO</strong>
                                </h5>
                                <p class="card-text mt-0" style="font-size: 0.8rem;">Realiza avances online.</p>
                                @can('academico_directo_tesis')
                                    <a href="{{ route('worksheet') }}" type="button" class="btn btn-dark"
                                        href="#" style="width: 180px; height: 40px;">Empezar</a>
                                @else
                                    <a href="{{ route('modo_page') }}" type="button" class="btn btn-dark"
                                        href="#" style="width: 180px; height: 40px;">Empezar</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- how section -->
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
                                <p class="text-white  mt-3">Realiza tus avances de redacción en el editor online</p>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
