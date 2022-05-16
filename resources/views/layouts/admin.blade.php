<!doctype html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME', 'Laravel') }} | @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap-custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    @stack('css')
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">

        <!-- NAVBAR -->
        @include('layouts.includes.navbar')
        <!-- END NAVBAR -->

        <!-- LEFT SIDEBAR -->
        @include('layouts.includes.sidebar')
        <!-- END LEFT SIDEBAR -->

        <!-- MAIN -->
        <div id="app" class="main">

            <!-- MAIN CONTENT -->
            <div class="main-content">

                @include('layouts.includes.heading')

                <div class="container-fluid">
                    @include('layouts.includes.alert')
                    @yield('content')
                </div>
            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN -->

        <div class="clearfix"></div>

        <!-- footer -->
        @include('layouts.includes.footer')
        <!-- end footer -->

    </div>
    <!-- END WRAPPER -->

    <!-- Scripts -->
    <script src="https://unpkg.com/vue@3"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vendor -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    @stack('scripts')
    <!-- End Scripts -->
</body>

</html>