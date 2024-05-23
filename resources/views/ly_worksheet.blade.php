@extends('layouts.tutorio')
@section('lycss')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/7.css') }}">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/8.css') }}">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/9.css') }}">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/10.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ckeditor-docs.css') }}">

    <style type="text/css">
        .ventana_flotante {
            background: none repeat scroll 0 0 #FFFFFF;
            border: 1px solid #DDDDDD;
            border-radius: 5px 5px 5px 5px;
            bottom: 10px;
            left: auto;
            margin-left: 5px;
            padding: 0px 0 0;
            position: fixed;
            text-align: center;
            width: 320px;
            z-index: 15;
        }

        .index-modal-contenido {
            background-color: aqua;
            width: 300px;
            padding: 10px 20px;
            margin: 20% auto;
            position: relative;
        }

        .index-modal {
            background-color: rgba(0, 0, 0, .8);
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0;
            pointer-events: none;
            transition: all 1s;
            z-index: 99999999;
        }

        #modalIndexTesis:target {
            opacity: 1;
            pointer-events: auto;
        }
    </style>
@stop
@section('content')

    <body>
        <x-lyontech.header></x-lyontech.header>
        <x-lyontech.student-data></x-lyontech.student-data>
        <!-----fsfdsfds-->
        <div class="media mt-4">
            <div class="container">
                <div class="row ">
                    <div class="col-md-6 col-sm-12 offset-md-3 d-flex justify-content-center align-items-center">
                        <div class="image-der mr-3">
                            <img src="{{ asset('theme-lyontech/images/hoja-blanco.jpg') }}" alt="Card image cap"
                                style="width: 100px; height: 100px; margin: auto;">
                        </div>
                        <div class="texto">
                            <h5 class="mb-0" style="margin-left: -30px;"><strong
                                    style="font-size: 1.8rem;letter-spacing: 0.0em;">HOJA DE TRABAJO</strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="xurl_thesis"
            value="{{ route('investigation_thesis_export_word_ckeditor', [$thesis_id]) }}">

        <livewire:investigation::thesis.ly-thesis-parts :thesis_id="$thesis_id" :sub_part="$sub_part" />

        <div class="modal fade" id="ventanaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
            aria-labelledby="tituloVentana" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-image: url({{ asset('theme-lyontech/images/modal.jpg') }});">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"
                            style="background-color: black;">
                            <strong>Mejorar</strong>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </body>

@stop
@can('academico_directo_tesis')
    @section('script')

        <script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
        <script>
            function openModalIndexes() {
                $('#modalIndexes').modal('show');
            }
        </script>
    @endsection
@else
    @section('script')
        <script>
            $('#ventanaModal').modal('show');
        </script>
        <script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
        <script>
            function openModalIndexes() {
                $('#modalIndexes').modal('show');
            }
        </script>
    @stop
@endcan
@section('global-modal')
    <livewire:investigation::indexes.ly-indexes-modal :thesis_student_id="$thesis_id" />
@stop
