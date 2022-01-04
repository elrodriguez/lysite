<x-master>
    <x-slot name="jumbotron">
        <div class="mdk-box bg-dark mdk-box--bg-gradient-primary js-mdk-box mb-0" data-effects="blend-background">
            <div class="mdk-box__content">
                <div class="hero py-64pt text-center text-sm-left">
                    <div class="container">
                        <h1 class="text-white">{{ $course->name }}</h1>
                        <p class="lead text-white-50 measure-hero-lead mb-24pt">{{ $course->description }}</p>
                        <a href="student-take-lesson.html" class="btn btn-white">Trailer</a>
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
                                <div class="rating rating-24">
                                    <div class="rating__item"><i class="material-icons">star</i></div>
                                    <div class="rating__item"><i class="material-icons">star</i></div>
                                    <div class="rating__item"><i class="material-icons">star</i></div>
                                    <div class="rating__item"><i class="material-icons">star</i></div>
                                    <div class="rating__item"><i class="material-icons">star_border</i></div>
                                </div>
                                <p class="lh-1 mb-0"><small class="text-muted">20 ratings</small></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @livewire('academic::students.students-course-section')

    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot> 
</x-master>