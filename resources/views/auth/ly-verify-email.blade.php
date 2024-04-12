@extends('layouts.lyontech')
@section('bootstrap')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/6.css') }}">
@stop
@section('content')

    <body class="img js-fullheight" style="background-image: url({{ asset('theme-lyontech/images/login.png') }});">
        <div class="container-fluid ">
            <div class="row align-content-center justify-content-center">
                <div class="col-md-8 col-lg-10 ">
                    <div class="card">
                        <div class="card-body mt-3">
                            <h5 class="text-center" style="font-weight: bold;"><strong
                                    style="font-size: 2.1rem; font-weight: bold;letter-spacing: 0.0em; line-height: 1;">
                                    Verificiación de cuenta</strong></h5>
                            <div class="text-cuenta">
                                <p>Para brindar mayor protección a tu cuenta Lyonteach </p>
                                <p>quiere verificar tu identidad en simples pasos.</p>
                            </div>
                            <div class="text-cuenta-b  ml-1 mt-2">
                                <p>Se acaba de enviar un código de 5 dígitos a la bandeja del correo</p>
                                <p> electrónico registrado en nuestra plataforma.</p>

                            </div>
                            <form action="#" class="signin-form mt-2">
                                <div class="form-login mt-3">
                                    <input type="text" required placeholder="Escribe el codigo">
                                </div>
                                <div class="form-a">
                                    <a href="#">Reenviar el código</a>
                                </div>
                                <div class="form-group mt-4 btn-cent mb-4">
                                    <button type="submit" class="form-control btn btn-primary submit "><strong>Verificar
                                            cuenta</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
@stop
