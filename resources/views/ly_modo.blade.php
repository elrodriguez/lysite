@extends('layouts.tutorio')
@section('lycss')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="{{ asset('theme-lyontech/css/12-modo.css') }}">-->
@stop
@section('content')

    <div class="img js-fullheight" style="background-image: url({{ asset('theme-lyontech/images/fondo-naranja.jpg') }});">
        
        <div class="container-section-1360p">
            <div class="row">
                <div class="col-md-12 box-plane-modo">
                    <div class="row box-plane-content-modo">
                        @if (count($modos) > 0)
                            @foreach ($modos as $modo)
                                @if (!Auth::check())
                                    @if ($modo->price == 0)
                                        <div class="col-md-4">
                                            <div class="box-plane-card-modo">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1 class="mb-0" style="text-align: center;">{{ $modo->name }}</h1>
                                                        <p class="mt-0 mb-0  text-center" style="color: #000; font-size: 25px;">
                                                            <strong>S/ {{ $modo->price ?? 'GRATIS' }}</strong> <strong>ó</strong>
                                                        </p>
                                                        <p class="mt-0 mb-0  text-center" style="color: #000; font-size: 20px;">
                                                            <strong>$USD {{ $modo->dollar_price ?? 'GRATIS' }}</strong>
                                                        </p>
                                                        <p class="mt-0 mb-0 text-center" style="color: #ff9152; font-size: 20px;">
                                                            <strong>/{{ $modo->detail_one }}</strong>
                                                        </p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                        <ul style="height: 190px;">
                                                            <li>{{ $modo->detail_two }}</li>
                                                            <li>{{ $modo->detail_three }}</li>
                                                            <li>{{ $modo->detail_four }}</li>
                                                            <li>{{ $modo->detail_five }}</li>
                                                        </ul>
                                                        <form action="#" class="signin-form mt-2">
                                                            <div class="form-group mt-4 btn-cent mb-4">
                                                                <a href="{{ route('register') }}"
                                                                    class="form-control btn btn-gris submit">
                                                                    Registrado
                                                                </a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                            </div>
                                            <!--
                                            <div class="card">
                                                <div class="card-body mt-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5 class="text-center" style="padding: 0px; margin: 0px;">
                                                                {{ $modo->name }}</h5>
                                                            <p class="mt-0 mb-0  text-center" style="color: #000;">
                                                                <strong>{{ $modo->price ?? 'GRATIS' }}</strong>
                                                            </p>
                                                            <p class="mt-0 mb-0 text-center" style="color: #000;">
                                                                <strong>/{{ $modo->detail_one }}</strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8">
                                                            <ul>
                                                                <li>{{ $modo->detail_two }}</li>
                                                                <li>{{ $modo->detail_three }}</li>
                                                                <li>{{ $modo->detail_four }}</li>
                                                                <li>{{ $modo->detail_five }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                    </div>
                                                    <form action="#" class="signin-form mt-2">
                                                        <div class="form-group mt-4 btn-cent mb-4">
                                                            <a href="{{ route('register') }}"
                                                                class="form-control btn btn-gris submit">Registrado</a>
            
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    @endif
                                @else
                                    @if ($modo->price > 0)
                                        <div class="col-md-4">
                                            <div class="box-plane-card-modo">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1 class="mb-0" style="text-align: center;">{{ $modo->name }}</h1>
                                                        <p class="mt-0 mb-0  text-center" style="color: #000; font-size: 25px;">
                                                            <strong>S/ {{ $modo->price ?? 'GRATIS' }}</strong> <strong>ó</strong>
                                                        </p>
                                                        <p class="mt-0 mb-0  text-center" style="color: #000; font-size: 20px;">
                                                            <strong>$USD {{ $modo->dollar_price ?? 'GRATIS' }}</strong>
                                                        </p>
                                                        <p class="mt-0 mb-0 text-center" style="color: #ff9152; font-size: 20px;">
                                                            <strong>/{{ $modo->detail_one }}</strong>
                                                        </p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                        <ul style="height: 190px;">
                                                            <li>{{ $modo->detail_two }}</li>
                                                            <li>{{ $modo->detail_three }}</li>
                                                            <li>{{ $modo->detail_four }}</li>
                                                            <li>{{ $modo->detail_five }}</li>
                                                        </ul>
                                                        <form action="#" class="signin-form mt-2">
                                                            <div class="form-group mt-4 mb-4">
                                                                <a href="{{ route('unirme_page', $modo->id) }}"
                                                                    class="form-control btn btn-orange submit">Unirse</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                            </div>
                                            <!--
                                            <div class="card">
                                                <div class="card-body mt-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5 class="text-center" style="padding: 0px; margin: 0px;">
                                                                {{ $modo->name }}</h5>
                                                            <p class="mt-0 mb-0  text-center" style="color: #000;">
                                                                <strong>S/ {{ $modo->price ?? 'GRATIS' }}</strong> <strong>ó</strong>
                                                            </p>
                                                            <p class="mt-0 mb-0  text-center" style="color: #000;">
                                                                <strong>$USD {{ $modo->dollar_price ?? 'GRATIS' }}</strong>
                                                            </p>
                                                            <p class="mt-0 mb-0 text-center" style="color: #ff9152;">
                                                                <strong>/{{ $modo->detail_one }}</strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8">
                                                            <ul>
                                                                <li>{{ $modo->detail_two }}</li>
                                                                <li>{{ $modo->detail_three }}</li>
                                                                <li>{{ $modo->detail_four }}</li>
                                                                <li>{{ $modo->detail_five }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                    </div>
                                                    <form action="#" class="signin-form mt-2">
                                                        <div class="form-group mt-4 btn-cent mb-4">
            
                                                            <a href="{{ route('unirme_page', $modo->id) }}"
                                                                class="form-control btn btn-orange submit">Unirse</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
