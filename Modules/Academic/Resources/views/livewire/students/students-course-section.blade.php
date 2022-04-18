<div>
    
    <div class="container page__container">
        <div class="row">
            <div class="col-lg-7">
                <div class="border-left-2 page-section pl-32pt">

                    @foreach ($sections as $key => $section )
                        <div class="d-flex align-items-center page-num-container" id="{{ $section->id }}">
                            <div class="page-num">{{ $key + 1 }}</div>
                            <h4>{{ $section->title }}</h4>
                        </div>

                        <p class="text-70 mb-24pt">{{ $section->description }}</p>

                        <div class="card mb-32pt mb-lg-64pt">
                            <ul class="accordion accordion--boxed js-accordion mb-0" id="toc-1">
                                <li class="accordion__item open">
                                    <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-1"
                                        href="#toc-content-{{ $key+1 }}">
                                        <span class="flex"> {{ ($section->n_contents_completed).' '.__('labels.of') }} {{ $section->n_contents.' '.__('labels.Steps') }}</span>
                                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <ul class="list-unstyled collapse show" id="toc-content-{{ $key+1 }}">
                                        @livewire('academic::students.students-course-contents',['section_id' => $section->id])
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="col-lg-5 page-nav">
                <div class="page-section">
                    <div class="page-nav__content">
                        <h4 class="mb-16pt">{{ __('labels.Index') }}</h4>
                    </div>
                    <nav class="nav page-nav__menu">
                        @foreach ($sections as $key => $section )
                        <a class="nav-link active" href="{{ '#'.$section->id }}">{{ ($key + 1).". ".$section->title }}</a>
                        @endforeach
                    </nav>
                </div>
            </div>
        </div>
    </div>

    
</div>
