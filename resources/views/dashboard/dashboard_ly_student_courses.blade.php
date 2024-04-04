@extends('layouts.lyontech')
@section('lycss')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/7.css') }}">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/8.css') }}">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/9.css') }}">
@stop
@section('content')

    <body>
        <x-lyontech.header></x-lyontech.header>
        <x-lyontech.student-data></x-lyontech.student-data>
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
            <div class="container">
                <div class="row ">
                    <div class="col-md-6 col-sm-12 offset-md-3 d-flex justify-content-center align-items-center">
                        <div class="image-der mr-3">
                            <img src="{{ asset('theme-lyontech/images/libro-blanco.jpg') }}" alt="Card image cap"
                                style="width: 100px; height: 100px; margin: auto;">
                        </div>
                        <div class="texto">
                            <h5 class="mb-0" style="margin-left: -30px;"><strong
                                    style="font-size: 1.8rem;letter-spacing: 0.0em;">CURSOS</strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @livewire('course.courses-student')
    </body>
@stop
