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
    <livewire:investigation::thesis.thesis-edit :thesis_id="$id" />
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot>
</x-master>
