<!doctype html>
<html lang="en" class="fullscreen-bg">

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
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper" class="d-flex align-items-center justify-content-center">
        <div class="auth-box" style="height: auto">
            <div class="left">
                <div id="app" class="content pt-5 pb-5">
                    @yield('content')
                </div>
            </div>
            <div class="right">
                <div class="overlay"></div>
                <div class="content text">
                    <h1 class="heading font-weight-bold">
                        {{ env('APP_NAME', 'Laravel') }}
                    </h1>
                    <p>by The Develovers</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->

    <!-- Scripts -->
    <script src="https://unpkg.com/vue@3"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('scripts')
    <!-- End Scripts -->
</body>

</html>