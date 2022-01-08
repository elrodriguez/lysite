<div class="accordion__menu">

    @foreach ($contents as $key => $content)

    @switch($content->content_type_id)
    @case(1)
    <li class="accordion__menu-link">
        <span class="icon-16pt icon--left text-body"><i class="fa fa-play-circle"></i></span>
        <a class="flex" href="{{ route('academic_students_take_lesson', [$course_id, $section_id, $content->id]) }}">{{ $content->name }}</a>
        @if ($content->completed)
        <span class="badge badge-success">{{ __('labels.Viewed') }}</span>
        <span class="icon-16pt icon--right text-body"><i class="fa fa-check"></i></span>
        @endif
    </li>
    @break
    @case(2)
    <li class="accordion__menu-link">
        <span class="icon-16pt icon--left text-body"><i class="fa fa-book-open"></i></span>
        <a class="flex" href="student-take-lesson.html">{{ $content->name }}</a>
        @if ($content->completed)
        <span class="badge badge-success">{{ __('labels.Viewed') }}</span>
        <span class="icon-16pt icon--right text-body"><i class="fa fa-check"></i></span>
        @endif
    </li>

    @break
    @case(3)

    @if (substr($content->original_name, -4) =='.doc' ||
    substr($content->original_name, -5) =='.docx')
    <li class="accordion__menu-link">
        <span class="icon-16pt icon--left text-body"><i class="fa fa-file-word"></i></span>
        <a class="flex" href="student-take-lesson.html">{{ $content->name }}</a>
        @if ($content->completed)
        <span class="badge badge-success">{{ __('labels.Viewed') }}</span>
        <span class="icon-16pt icon--right text-body"><i class="fa fa-check"></i></span>
        @endif
    </li>
    @endif
    @if (substr($content->original_name, -4) =='.xls' ||
    substr($content->original_name, -5) =='.xlsx')
    <li class="accordion__menu-link">
        <span class="icon-16pt icon--left text-body"><i class="fa fa-file-excel"></i></span>
        <a class="flex" href="student-take-lesson.html">{{ $content->name }}</a>
        @if ($content->completed)
        <span class="badge badge-success">{{ __('labels.Viewed') }}</span>
        <span class="icon-16pt icon--right text-body"><i class="fa fa-check"></i></span>
        @endif
    </li>
    @endif
    @if (substr($content->original_name, -4) =='.pdf')
    <li class="accordion__menu-link">
        <span class="icon-16pt icon--left text-body"><i class="fa fa-file-pdf"></i></span>
        <a class="flex" href="student-take-lesson.html">{{ $content->name }}</a>
        @if ($content->completed)
        <span class="badge badge-success">{{ __('labels.Viewed') }}</span>
        <span class="icon-16pt icon--right text-body"><i class="fa fa-check"></i></span>
        @endif
    </li>
    @endif
    @break
    @case(4)
    <li class="accordion__menu-link">
        <span class="icon-16pt icon--left text-body"><i class="fa fa-image"></i></span>
        <a class="flex" href="student-take-quiz.html">{{ $content->name }}</a>
        @if ($content->completed)
        <span class="badge badge-success">{{ __('labels.Viewed') }}</span>
        <span class="icon-16pt icon--right text-body"><i class="fa fa-check"></i></span>
        @endif
    </li>
    @break

    @endswitch




    @endforeach
</div>
