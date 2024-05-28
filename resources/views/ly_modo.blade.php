@extends('layouts.tutorio')
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
                                @if (count($modos) > 0)
                                    @foreach ($modos as $modo)
                                        <div class="col-md-4 col-lg-4">
                                            <div class="card card-body">
                                                <div class="modo-titulo text-center">
                                                    <h5>{{ $modo->name }}</h5>
                                                </div>
                                                <div class="texto-orange-12 text-center mt-2">
                                                    <h5>{{ $modo->price ?? 'GRATIS' }}</h5>
                                                    <h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/{{ $modo->detail_one }}</strong>
                                                    </h4>
                                                </div>
                                                <div class="modo-text" style="text-align: left;">
                                                    <p>-{{ $modo->detail_two }}</p>
                                                    <p>-{{ $modo->detail_three }}.</p>
                                                    <p>-{{ $modo->detail_four }}.</p>
                                                    <p>-{{ $modo->detail_five }}.</p>
                                                </div>
                                                <div class="form-group  mt-5 btn-cent" style="margin-top: 20px; ">
                                                    @if ($modo->price > 0)
                                                        <a href="{{ route('unirme_page', $modo->id) }}"
                                                            class="btn btn-primary submit ">Unirse</a>
                                                    @else
                                                        <a href="{{ route('register') }}"
                                                            class="btn btn-primary submit ">Registrado</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@stop
