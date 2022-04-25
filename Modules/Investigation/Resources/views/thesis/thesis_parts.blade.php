<x-master>
    @section('styles')
    <style type="text/css">
        .ventana_flotante {
            background: none repeat scroll 0 0 #FFFFFF;
            border: 1px solid #DDDDDD;
            border-radius: 5px 5px 5px 5px;
            bottom: 2px;
            left: auto;
            margin-left: -120px;
            padding: 0px 0 0;
            position: fixed;
            text-align: center;
            width: 320px;
            z-index: 15;
        }
    </style>
    @stop
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary">
            <div class="py-32pt">
                <div class="container">
                    <h1 class="text-white mb-8pt">{{ __('investigation::labels.thesis') }}</h1>
                    <p class="lead text-white-50 measure-hero-lead mb-24pt">
                        {{ __('investigation::labels.parts_the_thesis') }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="navbar navbar-expand-sm navbar-dark-white bg-gradient-primary p-sm-0 ">
        <div class="container page__container">
            <button class="navbar-toggler ml-n16pt" type="button" data-toggle="collapse" data-target="#navbar-submenu2">
                <i class="fa fa-bars"></i>
            </button>
            @livewire('nav.nav-global')
        </div>
    </div>
    @livewire('investigation::thesis.thesis-parts',['thesis_id' => $thesis_id, 'sub_part' => $sub_part])
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot>
    @section('script')
        <script src="{{ asset('ckeditor-4/ckeditor.js') }}"></script>
        <script src="{{ asset('ckeditor-4/config.js') }}"></script>
        <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    @endsection
</x-master>








