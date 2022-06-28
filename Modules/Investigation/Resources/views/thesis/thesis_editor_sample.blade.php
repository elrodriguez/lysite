<x-master>
    @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ url('ckeditor5/sample/styles.css') }}">
    @stop
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
        <div class="centered">
            <div class="row">
                <div class="document-editor__toolbar"></div>
            </div>
            <div class="row row-editor">
                <div class="editor-container">
                    <div id="editor">
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot>
    @section('script')
    <script src="{{ url('ckeditor5/build/ckeditor.js') }}"></script>
    <script>DecoupledDocumentEditor
        .create( document.querySelector( '#editor' ), {
            
            licenseKey: '',
            
            
            
        } )
        .then( editor => {
            window.editor = editor;
    
            // Set a custom container for the toolbar.
            document.querySelector( '.document-editor__toolbar' ).appendChild( editor.ui.view.toolbar.element );
            document.querySelector( '.ck-toolbar' ).classList.add( 'ck-reset_all' );
        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: nqbbe5edhs9m-u9490jx48w7r' );
            console.error( error );
        } );
</script>
    @stop
</x-master>
