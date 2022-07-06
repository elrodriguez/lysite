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

    <div class="div-body" data-editor="DecoupledDocumentEditor" data-collaboration="false" data-revision-history="false">
       <div class="div-main">
        <div class="centered">
            <div class="row">
                <div class="document-editor__toolbar"></div>
            </div>
            <div class="row row-editor">
                <div class="editor-container">
                    <div id="editor" class="editor">
                        <h2>Bilingual Personality Disorder</h2>
                        <figure class="image image-style-side"><img src="https://c.cksource.com/a/1/img/docs/sample-image-bilingual-personality-disorder.jpg">
                            <figcaption>One language, one person.</figcaption>
                        </figure>
                        <p>
                            This may be the first time you hear about this made-up disorder but
                            it actually isn’t so far from the truth. Even the studies that were conducted almost half a century show that
                            <strong>the language you speak has more effects on you than you realise</strong>.
                        </p>
                        <p>
                            One of the very first experiments conducted on this topic dates back to 1964.
                            <a href="https://www.researchgate.net/publication/9440038_Language_and_TAT_content_in_bilinguals">In the experiment</a>
                            designed by linguist Ervin-Tripp who is an authority expert in psycholinguistic and sociolinguistic studies,
                            adults who are bilingual in English in French were showed series of pictures and were asked to create 3-minute stories.
                            In the end participants emphasized drastically different dynamics for stories in English and French.
                        </p>
                        <p>
                            Another ground-breaking experiment which included bilingual Japanese women married to American men in San Francisco were
                            asked to complete sentences. The goal of the experiment was to investigate whether or not human feelings and thoughts
                            are expressed differently in <strong>different language mindsets</strong>.
                            Here is a sample from the the experiment:
                        </p>
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>English</th>
                                    <th>Japanese</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Real friends should</td>
                                    <td>Be very frank</td>
                                    <td>Help each other</td>
                                </tr>
                                <tr>
                                    <td>I will probably become</td>
                                    <td>A teacher</td>
                                    <td>A housewife</td>
                                </tr>
                                <tr>
                                    <td>When there is a conflict with family</td>
                                    <td>I do what I want</td>
                                    <td>It's a time of great unhappiness</td>
                                </tr>
                            </tbody>
                        </table>
                        <p>
                            More recent <a href="https://books.google.pl/books?id=1LMhWGHGkRUC">studies</a> show, the language a person speaks affects
                            their cognition, behaviour, emotions and hence <strong>their personality</strong>.
                            This shouldn’t come as a surprise
                            <a href="https://en.wikipedia.org/wiki/Lateralization_of_brain_function">since we already know</a> that different regions
                            of the brain become more active depending on the person’s activity at hand. Since structure, information and especially
                            <strong>the culture</strong> of languages varies substantially and the language a person speaks is an essential element of daily life.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div> 
    </div>
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot>
    @section('script')
    {{-- <script src="{{ url('ckeditor5/build/ckeditor.js') }}"></script> --}}
    {{-- <script>DecoupledDocumentEditor
        .create( document.querySelector( '.editor' ), {
            
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
</script> --}}
        <script src="{{ url('ckeditor-4/ckeditor.js') }}"></script>
        <script src="{{ url('ckeditor-4/init.js') }}"></script>
    <script>
        initSample();
    </script>
    @stop
</x-master>
