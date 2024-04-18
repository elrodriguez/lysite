@extends('layouts.lyontech')
@section('lycss')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/14-datos.css') }}">
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
                                    oportunidades</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 text-left">
                    <div class="card ">
                        <h5>Completa tus datos</h5>
                        <p>Monto a pagar: S/. {{ number_format($precio, 2, '.', '') }}</p>
                        <form>
                            <div class="form-group">
                                <label>&nbsp;Número de tarjeta</label>
                                <input class="form-control form-control-lg" type="text"
                                    placeholder="1234 1234 5647 5647">
                            </div>
                            <div class="form-group">
                                <label>&nbsp;Nombre del titular</label>
                                <input class="form-control form-control-lg" type="text"
                                    placeholder="Ej. : Mieguel Neciosup">
                            </div>
                            <div class="form-group">
                                <label>&nbsp;Vencimiento</label>
                                <input class="form-control form-control-lg" type="text" placeholder="MM/AA">
                            </div>
                            <div class="form-group">
                                <label>&nbsp;Código de seguridad</label>
                                <input class="form-control form-control-lg " type="text" placeholder="123">
                            </div>
                            <div class="form-group btn-cent ">
                                <button type="submit" class="btn btn-pagar">Pagar</button>
                                <button type="submit" class="btn btn-volver">Volver</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </body>
@stop
