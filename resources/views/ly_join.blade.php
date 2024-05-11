@extends('layouts.lyontech')
@section('lycss')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/13-unirme.css') }}">
@stop
@section('content')

    <body class="img js-fullheight" style="background-image: url({{ asset('theme-lyontech/images/fondo-naranja.jpg') }});">
        <div class="container-fluid ">
            <div class="row align-content-center justify-content-center">
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <div class="container-fluid ">
                        <div class="col-lg-12 col-md-12 col-sm-10">
                            <div class="card card-transparent text-login">
                                <h5>MEJORA</h5>
                                <p style="font-size: 52px; letter-spacing: -1px; word-spacing: -1px; line-height: 1;">
                                    adquiere tu</p>
                                <p style="font-size: 52px; letter-spacing: -1px; word-spacing: -1px; line-height: 1;">cuenta
                                    con mejores</p>
                                <p style="font-size: 52px; letter-spacing: -1px; word-spacing: -1px; line-height: 1;">
                                    oportunidades.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 text-left">
                    <div class="card " style="padding-bottom: 50px;">
                        <h5>Unirme</h5>
                        <p>¿Cómo quieres pagar?</p>
                        <div class="btn-group-vertical">
                            <a href="{{ route('tarjeta_page', $mod) }}" class="btn-with-icon boton">
                                <div class="con-boton">
                                    <img src="{{ asset('theme-lyontech/images/tc.png') }}" alt="Icono">
                                </div>
                                <div class="contenido">
                                    <h5 class="mb-0">Nueva tarjeta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;</h5>
                                    <p class="mt-0">Débito o crédito.</p>
                                </div>
                                <div class="con-der">
                                    <img src="{{ asset('theme-lyontech/images/felcha.png') }}" alt="Icono">
                                </div>
                            </a>
                            <button class="btn-with-icon boton mt-3">
                                <div class="con-boton">
                                    <img src="{{ asset('theme-lyontech/images/bb.png') }}" alt="Icono">
                                </div>
                                <div class="contenido">
                                    <h5>Efectivo en agentes</h5>
                                    <p>Paga en efectivo.</p>
                                </div>
                                <div class="con-der">
                                    <img src="{{ asset('theme-lyontech/images/felcha.png') }}" alt="Icono">
                                </div>
                            </button>
                            <button class="btn-with-icon boton mt-3">
                                <div class="con-boton">
                                    <img src="{{ asset('theme-lyontech/images/museo.png') }}" alt="Icono">
                                </div>
                                <div class="contenido">
                                    <h5>Banca por internet</h5>
                                    <p>paga en efectivo.</p>
                                </div>
                                <div class="con-der">
                                    <img src="{{ asset('theme-lyontech/images/felcha.png') }}" alt="Icono">
                                </div>
                            </button>

                            <form action="{{ route('paypal_payment') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="amount" value="5">
                                <input type="hidden" name="full_name" value="paypal_payer">
                                <input type="hidden" name="currecy" value="currency">
                            <button class="btn-with-icon boton mt-3 ">
                                <div class="con-boton">
                                    <img src="{{ asset('theme-lyontech/images/paypal.png') }}" alt="Icono">
                                </div>
                                <div class="contenido">
                                    <h5>Paypal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </h5>
                                    <p>Paga por paypal.</p>
                                </div>
                                <div class="con-der">
                                    <img src="{{ asset('theme-lyontech/images/felcha.png') }}" alt="Icono">
                                </div>
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
@stop
