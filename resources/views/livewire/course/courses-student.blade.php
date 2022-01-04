<div>
    <div class="page-heading">
        <h4>{{ __('labels.Courses') }}</h4>
    </div>

    @if(count($courses)>0)
        @foreach($courses as $course)
        <div class="col-12 col-sm-6">
            <a class="card mb-0" href="{{ route('academic_students_my_course',$course->id) }}">
                <img src="{{ url($course->course_image) }}" alt="Flinto" class="card-img" style="max-height: 100%; width: initial;">
                <div class="fullbleed bg-primary" style="opacity: .5;"></div>
                <span class="card-body fullbleed">
                    <span class="row">
                        <span class="col-5 text-center">
                            <span class="h5 text-white text-uppercase font-weight-normal m-0 d-block"></span>
                            <span class="text-white-60 d-block mb-16pt">Jun 5, 2018</span>
                            <img src="{{ url('assets/images/illustration/achievement/128/white.png') }}" alt="achievement">
                        </span>
                        <span class="col-7 d-flex flex-column">
                            <span class="text-right flex">
                                <img src="{{ url('assets/images/paths/flinto_40x40@2x.png') }}" width="64" alt="Flinto" class="rounded">
                            </span>
                            <span>
                                <span class="h4 text-white m-0 d-block">{{ $course->name }}</span>
                                <span class="text-white-60">{{ Str::limit($course->description,30) }}</span>
                            </span>
                        </span>
                    </span>
                </span>
            </a>
        </div>
        @endforeach
    @endif
    <br>
</div>