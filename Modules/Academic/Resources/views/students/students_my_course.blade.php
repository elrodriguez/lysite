@extends('layouts.tutorio')
@section('bootstrap')
    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('assets/css/material-icons.css') }}" rel="stylesheet">


    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet">

    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

@stop
@section('lycss')

    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme-lyontech/css/7.css') }}">

@stop
@section('content')

    <body class="layout-navbar-mini-fixed-bottom">
        <x-lyontech.header></x-lyontech.header>
        <x-lyontech.student-data></x-lyontech.student-data>
        @livewire('academic::students.students-course-section', ['course_id' => $course->id])
    </body>
@stop
@section('modales')
    <div wire:ignore.self class="modal fade" id="WelcomeVideo" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $course->name }} -
                        {{ __('labels.Welcome Video') }}</h5>
                    <button type="button" class="close" onclick="closeModalWelcomeVideo()" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="js-player embed-responsive embed-responsive-16by9 mb-32pt">
                        <div class="player embed-responsive-item">
                            <div class="player__content">
                                <div class="player__image"
                                    style="--player-image: url(assets/images/illustration/player.svg)">
                                </div>
                                <a href="" class="player__play">
                                    <span class="material-icons">play_arrow</span>
                                </a>
                            </div>
                            <div class="player__embed d-none">
                                <!-- Aqui abajo va el Video -->
                                {{-- @if ($course->video_type == 0)
                                    <iframe id="frameWelcomeVideo" class="embed-responsive-item"
                                    src="https://player.vimeo.com/video/{{ $course->video_url }}?title=0&amp;byline=0&amp;portrait=0"
                                    allowfullscreen=""></iframe>
                                @endif
                                @if ($course->video_type == 1)
                                    <iframe id="frameWelcomeVideo" class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/{{ $course->video_url }}?title=0&amp;byline=0&amp;portrait=0"
                                    allowfullscreen=""></iframe>
                                @endif --}}
                                <iframe id="frameWelcomeVideo" class="embed-responsive-item" src=""
                                    allowfullscreen=""></iframe>
                                <!-- Aqui arriba va el Video -->
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn"
                        onclick="closeModalWelcomeVideo()">{{ __('labels.Close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var urlVideo = "{{ $course->video_url }}";
        var typeVideo = "{{ $course->video_type }}";
        var srcVideo = "";

        function closeModalWelcomeVideo() {
            document.getElementById("frameWelcomeVideo").src = "";
            $('#WelcomeVideo').modal('hide');
        }

        function openModalWelcomeVideo() {
            if (typeVideo == '0') {
                srcVideo = "https://player.vimeo.com/video/" + urlVideo + "?title=0&amp;byline=0&amp;portrait=0";
                document.getElementById("frameWelcomeVideo").src = srcVideo;
            }
            if (typeVideo == '1') {
                srcVideo = "https://www.youtube.com/embed/" + urlVideo + "?title=0&amp;byline=0&amp;portrait=0";
                document.getElementById("frameWelcomeVideo").src = srcVideo;
            }
            $('#WelcomeVideo').modal('show');
        }
    </script>
@endsection
