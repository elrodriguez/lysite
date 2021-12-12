<x-master>
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary border-bottom-white py-32pt">
            <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                <img src="{{ url('assets/images/illustration/admin/avatar.png') }}" width="104" class="mr-md-32pt mb-32pt mb-md-0" alt="instructor">
                <div class="flex mb-32pt mb-md-0">
                    <h2 class="text-white mb-0">{{ auth()->user()->name }}</h2>
                    <p class="lead text-white-50 d-flex align-items-center">{{ auth()->user()->email }}</p>
                </div>
                <a href="{{ route('user_edit_account') }}" class="btn btn-outline-white">{{ __('labels.Edit Account') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="navbar navbar-expand-sm navbar-dark-white bg-gradient-primary p-sm-0 ">
        <div class="container page__container">

            <!-- Navbar toggler -->
            <button class="navbar-toggler ml-n16pt" type="button" data-toggle="collapse" data-target="#navbar-submenu2">
                <span class="material-icons">people_outline</span>
            </button>
            @livewire('nav.nav-admin')
        </div>
    </div>
    <div class="py-24pt bg-white border-bottom-2">
        <div class="container page__container">
            @livewire('dashboard.dashboard-admin-quantities')
        </div>
    </div>
    <div class="container page__container">
        <div class="page-section">
            @livewire('dashboard.dashboard-admin')
        </div>
    </div>
    <x-slot name="navigation">
        <x-navigation></x-navigation>
    </x-slot>
    @section('script')
    <!-- Global Settings -->
    <script src="{{ url('assets/js/settings.js') }}"></script>

    <!-- Moment.js -->
    <script src="{{ url('assets/vendor/moment.min.js') }}"></script>
    <script src="{{ url('assets/vendor/moment-range.min.js') }}"></script>

    <!-- Chart.js -->
    <script src="{{ url('assets/vendor/Chart.min.js') }}"></script>

    <!-- Charts JS -->
    <script src="{{ url('assets/js/chartjs.js') }}"></script>

    <!-- Chart.js Samples -->
    <script src="{{ url('assets/js/page.student-dashboard.js') }}"></script>
    @endsection
</x-master>
