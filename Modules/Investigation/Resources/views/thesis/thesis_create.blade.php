<x-master>
    @section('styles')
        <link href="{{ asset('x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet" />
        <link type="text/css" href="{{ url('assets/css/flatpickr.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ url('assets/css/flatpickr.rtl.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ url('assets/css/flatpickr-airbnb.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ url('assets/css/flatpickr-airbnb.rtl.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ url('select2@4.1.0/select2.bundle.css') }}" rel="stylesheet">

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
            <button class="navbar-toggler ml-n16pt" type="button" data-toggle="collapse"
                data-target="#navbar-submenu2">
                <i class="fa fa-bars"></i>
            </button>
            @livewire('nav.nav-global')
        </div>
    </div>
    <livewire:investigation::thesis.thesis-create />
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot>
    @section('modales')
        <livewire:investigation::thesis.thesis-help-create-titles />
        <livewire:investigation::thesis.thesis-format-modal />
        <livewire:investigation::thesis.thesis-format-modal-edit />
    @endsection
    @section('script')
        <script src="{{ asset('x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js') }}"></script>
        <!-- Flatpickr -->
        <script src="{{ url('assets/vendor/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ url('assets/js/flatpickr.js') }}"></script>
        <script src="{{ url('select2@4.1.0/select2.js') }}"></script>

    @stop
</x-master>
