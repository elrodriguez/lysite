<x-master>
    <x-slot name="jumbotron">
        <div class="bg-gradient-primary border-bottom-white py-32pt">
            <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                <img src="{{ url('assets/images/illustration/admin/avatar.png') }}" width="104" class="mr-md-32pt mb-32pt mb-md-0" alt="instructor">
                <div class="flex mb-32pt mb-md-0">
                    <h2 class="text-white mb-0">{{ auth()->user()->name }}</h2>
                    <p class="lead text-white-50 d-flex align-items-center">{{ auth()->user()->email }}</p>
                </div>
                <a href="student-edit-account.html" class="btn btn-outline-white">Editar cuenta</a>
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

            <div class="row">
                <div class="col-lg-4">
                    <div class="border-1 border-left-3 border-left-accent rounded text-70 text-center mb-lg-0">
                        <div class="card-body">
                            Earnings this month
                            <p class="lead text-body mb-0"><strong>$1,569.00</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="border rounded text-70 text-center mb-lg-0">
                        <div class="card-body">
                            Account Balance
                            <p class="lead text-body mb-0"><strong>$3,917.80</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="border rounded text-70 text-center mb-lg-0">
                        <div class="card-body">
                            Total Sales
                            <p class="lead text-body mb-0"><strong>$10,211.50</strong></p>
                        </div>
                    </div>
                </div>
            </div>

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