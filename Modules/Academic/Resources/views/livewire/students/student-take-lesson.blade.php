<div class="mdk-header-layout__content page-content ">
    <div class="navbar navbar-list navbar-submenu navbar-light border-0 navbar-expand-sm" style="white-space: nowrap;">
        <div class="container flex-column flex-sm-row">
            <nav class="nav navbar-nav navbar-list__item">
                <div class="nav-item">
                    <div class="media flex-nowrap">
                        <div class="media-left mr-16pt">
                            <a href="student-take-course.html">

                                <div class="avatar avatar-4by3">
                                    <img src="{{ env('APP_URL') }}/{{ $course->course_image }}" alt="Avatar"
                                        class="avatar-img rounded">
                                </div>

                            </a>
                        </div>
                        <div class="media-body">
                            <a href="student-take-course.html" class="card-title text-body mb-0">{{ $course->name }}</a>
                            <p class="lh-1 d-flex align-items-center mb-0">
                                <span class="text-50 small font-weight-bold mr-8pt">Elijah Murray</span>
                                <span class="text-50 small">Software Engineer and Developer</span>
                            </p>
                        </div>
                    </div>
                </div>
            </nav>
            <ul class="navbar-list__item nav navbar-nav ml-sm-auto align-items-center align-items-sm-end">
                <li class="nav-item active ml-sm-16pt">
                    <a href="" class="nav-link">Video</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Notes</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Discussions</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="bg-gradient-primary pb-lg-64pt py-32pt">
        <div class="container">




            @if ($content->content_type_id == 1)

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
                        @if ($video==0)
                        <iframe class="embed-responsive-item"
                            src="https://player.vimeo.com/video/{{ $content->content_url }}?title=0&amp;byline=0&amp;portrait=0"
                            allowfullscreen=""></iframe>
                        @endif
                        @if ($video==1)
                        <iframe class="embed-responsive-item"
                            src="https://www.youtube.com/embed/{{ $content->content_url }}?title=0&amp;byline=0&amp;portrait=0"
                            allowfullscreen=""></iframe>
                        @endif
                        <!-- Aqui arriba va el Video -->
                    </div>
                </div>
            </div>

            @endif


            @if ($content->content_type_id == 2)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $content->name }}</h4>
                    <style>
                        .text {
                            width: 100%;
                        }
                    </style>
                    <!-- ---------------------------------------------- CK Editor 5 EDITOR  BEGIN BEGIN BEGIN BEGIN BEGIN BEGIN ------------------------------------------------------------------------ -->

                    <div wire:ignore>
                        <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js">
                        </script>

                        <textarea wire:model="content_url" name="editor" class="form-control" id="editor" rows="10"
                            cols="80">
              {{ $content->content_url }}
          </textarea>
                        <script>
                            ClassicEditor
              .create( document.querySelector( '#editor' ), {
            toolbar: [  ]
        } )
                  .then(function(editor){
                      editor.isReadOnly = true;
                  })
                  .catch( error => {
                      console.error( error );
                  } );

                        </script>
                    </div>
                </div>
                <!-- --------------------------------------------- CK Editor 5 EDITOR END END END END END END END END END END END END --------------------------------------------------------------- -->

            </div>
        </div>
        @endif


        @if ($content->content_type_id == 4)
        <div class="card">
            <img class="img-fluid rounded float-right"
                alt="{{ $content->original_name }}::{{ __('labels.Image not available') }}"
                src="{{ env('APP_URL') }}/{{ $content->content_url }}">
        </div>
        @endif

        <div class="d-flex flex-wrap align-items-end mb-16pt">
            <h1 class="text-white flex m-0">{{ $content->name }}</h1>

        </div>

        <!--   <p class="hero__lead measure-hero-lead text-white-50 mb-24pt">JavaScript is now used to power backends, create hybrid mobile applications, architect cloud solutions, design neural networks and even control robots. Enter TypeScript: a superset of JavaScript for scalable, secure, performant and feature-rich applications.</p>   -->

        <a href="{{ route('academic_students_my_course',$course_id) }}" class="btn btn-white">Volver al Curso</a>
    </div>
</div>




<div class="page-section bg-white">
    <div class="container page__container">

        <div class="d-flex align-items-center mb-heading">
            <h4 class="m-0">Discussions</h4>
            <a href="student-discussions-ask.html" class="text-underline ml-auto">Ask a Question</a>
        </div>

        <div class="border-top">

            <div class="list-group list-group-flush">

                <div class="list-group-item p-3">
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-8pt mb-md-0">
                            <div class="media">
                                <div class="media-left mr-16pt">
                                    <a href="student-profile.html"><img src="assets/images/people/110/guy-1.jpg"
                                            width="40" alt="avatar" class="rounded-circle"></a>
                                </div>
                                <div class="media-body media-middle">
                                    <p class="text-muted m-0">2 days ago</p>
                                    <p class="m-0"><a href="student-profile.html" class="text-body">Laza Bogdan</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-8pt mb-md-0">
                            <p class="mb-8pt"><a href="student-discussion.html" class="text-body"><strong>Using
                                        Angular HttpClientModule instead of HttpModule</strong></a></p>


                            <a href="student-discussion.html" class="chip chip-outline-secondary">Angular
                                fundamentals</a>


                        </div>
                        <div class="col-auto d-flex flex-column align-items-center justify-content-center">
                            <h5 class="m-0">1</h5>
                            <p class="lh-1 mb-0"><small class="text-70">answers</small></p>
                        </div>
                    </div>
                </div>

                <div class="list-group-item p-3">
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-8pt mb-md-0">
                            <div class="media">
                                <div class="media-left mr-16pt">
                                    <a href="student-profile.html"><img src="assets/images/people/110/guy-2.jpg"
                                            width="40" alt="avatar" class="rounded-circle"></a>
                                </div>
                                <div class="media-body media-middle">
                                    <p class="text-muted m-0">3 days ago</p>
                                    <p class="m-0"><a href="student-profile.html" class="text-body">Adam Curtis</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-8pt mb-md-0">
                            <p class="mb-0"><a href="student-discussion.html" class="text-body"><strong>Why am I
                                        getting an error when trying to install angular/http@2.4.2</strong></a></p>

                        </div>
                        <div class="col-auto d-flex flex-column align-items-center justify-content-center">
                            <h5 class="m-0">1</h5>
                            <p class="lh-1 mb-0"><small class="text-70">answers</small></p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <a href="student-discussions.html" class="btn btn-outline-secondary">See all discussions for this lesson</a>

    </div>
</div>

</div>
