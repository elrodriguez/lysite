<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ url('assets/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- Fix Footer CSS -->
    <link type="text/css" href="{{ url('assets/vendor/fix-footer.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ url('assets/css/material-icons.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ url('assets/css/material-icons.rtl.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{ url('assets/css/fontawesome.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ url('assets/css/fontawesome.rtl.css') }}" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="{{ url('assets/css/preloader.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ url('assets/css/preloader.rtl.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ url('assets/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ url('assets/css/app.rtl.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ url('assets/js/cute-alert/style.css') }}" rel="stylesheet">

    <link type="text/css" href="{{ url('assets/css/chat.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body class="layout-navbar-mini-fixed-bottom">
    <div class="preloader">
        <div class="sk-double-bounce">
            <div class="sk-child sk-double-bounce1"></div>
            <div class="sk-child sk-double-bounce2"></div>
        </div>
    </div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->
        <x-header></x-header>
        <!-- // END Header -->
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">
            {{ $jumbotron }}

            {{ $slot }}

            <x-footer></x-footer>
        </div>
        <!-- // END Header Layout Content -->
    </div>

    <!-- // END Header Layout -->
    {{ $navigation }}
    <!--  livewire -->
    @if (!Auth::guest())
        @livewire('chat::chat-messages')
    @endif
    @livewireScripts
    <!-- jQuery -->
    <script src="{{ url('assets/vendor/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ url('assets/vendor/popper.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap.min.js') }}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{ url('assets/vendor/perfect-scrollbar.min.js') }}"></script>

    <!-- DOM Factory -->
    <script src="{{ url('assets/vendor/dom-factory.js') }}"></script>

    <!-- MDK -->
    <script src="{{ url('assets/vendor/material-design-kit.js') }}"></script>

    <!-- Fix Footer -->
    <script src="{{ url('assets/vendor/fix-footer.js') }}"></script>

    {{-- <!-- Chart.js -->
    <script src="{{ url('assets/vendor/Chart.min.js') }}"></script> --}}

    <!-- App JS -->
    <script src="{{ url('assets/js/app.js') }}"></script>

    <!-- Highlight.js -->
    <script src="{{ url('assets/js/hljs.js') }}"></script>

    <!-- App Settings (safe to remove) -->
    <script src="{{ url('assets/js/app-settings.js') }}"></script>

    <script src="{{ url('assets/js/cute-alert/cute-alert.js') }}"></script>
    @yield('script')
    @yield('modales')
    <!-- Modal -->

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script-chat')
</body>

</html>
