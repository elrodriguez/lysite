@extends('layouts.tutorio')
@section('lycss')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="{{ asset('theme-lyontech/css/7.css') }}">
                                    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/8.css') }}">
                                    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/n3.css') }}">-->
@stop
@section('content')

    <body>
        <x-lyontech.header></x-lyontech.header>

        <livewire:help-gpt.ly-box-gpt-default />

    </body>
@stop
@section('global-modal')
    <div class="modal fade" id="ventanaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"
                style="background-image: url({{ asset('theme-lyontech/images/modal.jpg') }});no-repeat center center;background-size: cover;">
                <div class="modal-header" style="border: 0px">
                </div>
                <div class="modal-body" style="border: 0px">
                </div>
                <div class="modal-footer justify-content-center" style="border: 0px">
                    <a href="{{ route('modo_page') }}" type="button" class="btn btn-secondary btn-lg"
                        style="background-color: black;">
                        <strong>Mejorar</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function() {
            $('#ventanaModal').modal('show');
        });
    </script>
@endsection
