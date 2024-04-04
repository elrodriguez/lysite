<div class="container">
    @if (count($courses) > 0)
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-6">
                    <a class="card mb-3" style="text-decoration: none; color: inherit; transition: none !important;"
                        href="{{ route('academic_students_my_course', $course->id) }}">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ url($course->course_image) }}" class="card-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p>{{ $course->name }}</p>
                                    <div class="card-title-container">
                                        <h5 class="card-title">Videos:</h5>
                                        <h5 class="card-title">Guías:</h5>
                                    </div>
                                    <div class="rating-container">
                                        <span class="fa fa-star star"></span>
                                        <span class="fa fa-star star"></span>
                                        <span class="fa fa-star star"></span>
                                        <span class="fa fa-star star"></span>
                                        <span class="fa fa-star star"></span>
                                    </div>
                                    <div class="rating-text">
                                        <small>1 calificación</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
    <br>
</div>
