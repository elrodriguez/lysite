<x-master>
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary">
            <div class="py-32pt">
                <div class="container">
                    <h1 class="text-white mb-8pt">{{ __('investigation::labels.thesis') }}</h1>
                    <p class="lead text-white-50 measure-hero-lead mb-24pt">
                        {{ __('investigation::labels.create_project') }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="navbar navbar-expand-sm navbar-dark-white bg-gradient-primary p-sm-0 ">
        <div class="container page__container">

            <!-- Navbar toggler -->
            <button class="navbar-toggler ml-n16pt" type="button" data-toggle="collapse" data-target="#navbar-submenu2">
                <i class="fa fa-bars"></i>
            </button>
            @livewire('nav.nav-global')
        </div>
    </div>
    <div>
        <textarea name="editor" id="editor" cols="30" rows="10"></textarea>
    </div> 
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot>
    @section('script')
    <script src="{{ url('ckeditor-5/src/ckeditor.js') }}"></script>
    <script>
        ClassicEditor.create( document.querySelector( '#editor' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                }
            })
            .catch( error => {
                console.log( error );
            } );
    </script>
    @stop
</x-master>
