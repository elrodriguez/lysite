<x-master>

    <x-slot name="jumbotron">
        <div class="mdk-box bg-dark mdk-box--bg-gradient-primary js-mdk-box mb-0" data-effects="blend-background">
            <div class="mdk-box__content">
                <div class="hero py-64pt text-center text-sm-left">
                    <div class="container">
                        <h1 class="text-white">{{ $course->name }}</h1>
                        <p class="lead text-white-50 measure-hero-lead mb-24pt">{{ $course->description }}</p>
                        <button type="button" class="btn btn-white" data-toggle="modal" data-target="#WelcomeVideo">

                            {{ __('labels.Welcome Video') }}

                        </button>
                    </div>
                </div>
                <div class="navbar navbar-expand-sm navbar-submenu navbar-light navbar-list p-0 m-0 align-items-center">
                    <div class="container page__container">
                        <ul class="nav navbar-nav flex align-items-sm-center">
                            <li class="nav-item navbar-list__item">
                                <div class="media align-items-center">
                                    <span class="media-left mr-16pt">
                                        <img src="{{ url('assets/images/people/50/guy-6.jpg') }}" width="40" alt="avatar" class="rounded-circle">
                                    </span>
                                    <div class="media-body">
                                        <a class="card-title m-0" href="instructor-profile.html">{{ $instruct ? $instruct->names : 'Instructor' }}</a>
                                        <p class="text-50 lh-1 mb-0">Instructor</p>
                                    </div>
                                </div>
                            </li>
                            {{-- <li class="nav-item navbar-list__item">
                                <i class="material-icons text-muted icon--left">schedule</i>
                                2h 46m
                            </li>
                            <li class="nav-item navbar-list__item">
                                <i class="material-icons text-muted icon--left">assessment</i>
                                Beginner
                            </li> --}}
                            <li class="nav-item ml-sm-auto text-sm-center flex-column navbar-list__item">
                                @livewire('academic::courses.course-rating',['course_id' => $course_id])
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @livewire('academic::students.student-take-lesson',['course_id' => $course_id, 'section_id' => $section_id, 'content_id' => $content_id])

    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot>
</x-master>



<div wire:ignore.self class="modal fade" id="WelcomeVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">{{ $course->name }} - {{ __('labels.Welcome Video') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                     <span aria-hidden="true close-btn">×</span>

                </button>

            </div>

           <div class="modal-body">

            <div class="js-player embed-responsive embed-responsive-16by9 mb-32pt">
                <div class="player embed-responsive-item">
                    <div class="player__content">
                        <div class="player__image" style="--player-image: url(assets/images/illustration/player.svg)">
                        </div>
                        <a href="" class="player__play">
                            <span class="material-icons">play_arrow</span>
                        </a>
                    </div>
                    <div class="player__embed d-none">
                        <!-- Aqui abajo va el Video -->
                        @if ($course->video_type==0)
                        <iframe class="embed-responsive-item"
                            src="https://player.vimeo.com/video/{{ $course->video_url }}?title=0&amp;byline=0&amp;portrait=0"
                            allowfullscreen=""></iframe>
                        @endif
                        @if ($course->video_type==1)
                        <iframe class="embed-responsive-item"
                            src="https://www.youtube.com/embed/{{ $course->video_url }}?title=0&amp;byline=0&amp;portrait=0"
                            allowfullscreen=""></iframe>
                        @endif
                        <!-- Aqui arriba va el Video -->
                    </div>
                </div>
            </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">{{ __('labels.Close') }}</button>


            </div>

        </div>

    </div>

</div>
