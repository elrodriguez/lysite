<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Take Course</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('assets/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- Fix Footer CSS -->
    <link type="text/css" href="{{ asset('assets/vendor/fix-footer.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('assets/css/material-icons.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/material-icons.rtl.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/fontawesome.rtl.css') }}" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/preloader.rtl.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/app.rtl.css') }}" rel="stylesheet">

    <!-- Theme Lyontech CSS -->
    <link type="text/css" href="{{ asset('assets/css/themeLyontech.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/app.rtl.css') }}" rel="stylesheet">

    @yield('lycss')

</head>

<body class="layout-navbar-mini-fixed-bottom">
    @yield('content')
    <!--  livewire -->
    @if (!Auth::guest())
        @livewire('chat::chat-messages-new')
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

    <!-- Chart.js -->
    {{-- <script src="{{ url('assets/vendor/Chart.min.js') }}"></script> --}}

    <!-- App JS -->
    <script src="{{ url('assets/js/app.js') }}"></script>

    <!-- Highlight.js -->
    <script src="{{ url('assets/js/hljs.js') }}"></script>

    <!-- App Settings (safe to remove) -->
    <script src="{{ url('assets/js/app-settings.js') }}"></script>

    <script src="{{ url('assets/js/cute-alert/cute-alert.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="
                                https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js
                                "></script>
    @yield('script')
    @yield('modales')
    <!-- Modal -->
    @yield('script-chat')
    <script>
        setTimeout(function() {
            let b = document.getElementsByClassName('preloader')[0];
            b.style.display = 'none';
        }, 10000);
    </script>
    @if (auth()->check())
        <script>
            // Verifica si la variable "user" existe en el localStorage
            if (localStorage.getItem("user_name")) {
                // Si existe, elimina la variable "user"
                localStorage.removeItem("user_name");
            }

            // Crea la variable "user" y asigna un valor
            localStorage.setItem("user_name", '{{ auth()->user()->name }}');
        </script>
    @endif
    @yield('global-modal')

</body>

</html>
