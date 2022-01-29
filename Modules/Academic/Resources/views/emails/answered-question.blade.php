<div>
    <div class="card card--raised">
        <div class="card-header d-flex align-items-center">
            <div class="flex">
                <h4 class="card-title">{{ $subject }}</h4>
                <p class="card-subtitle">{{ __('labels.by').": ".$by }}</p>
            </div>
        </div>
        <div class="card-body"><br>
            <p>{{ __('labels.Question') }}: {{ $question }}</p>
            <p class="text-70">{{ __('labels.Answer') }}: <b>{{ $answer }}</b></p>
            <a href="{{ route('academic_students_discussion', [$a, $b, $c, $d]) }}" class="btn btn-accent">{{ __('labels.Go to Lysite') }}</a>
        </div>
    </div>
</div>
