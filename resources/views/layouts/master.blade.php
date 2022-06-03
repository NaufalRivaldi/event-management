<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        {{ str_replace('_', ' ', env('APP_NAME', 'Laravel')) }} | @yield('title')
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
    />

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    @stack('css')
</head>

<body>
    <section class="h-100 w-100" style="box-sizing: border-box;position: relative;background-color: #FAFCFF;">
        <div class="header-3-3 container-xxl mx-auto p-0 position-relative">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="#">
                    <img style="margin-right: 0.75rem" src="{{ asset('assets/images/logo.jpeg') }}" alt="logo" width="50px" />
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal" data-bs-target="#targetModal-item">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu Modal -->
                <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog" aria-labelledby="targetModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-white border-0">
                            <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                                <a class="modal-title" id="targetModalLabel">
                                    <img style="margin-right: 0.75rem" src="{{ asset('assets/images/logo.jpeg') }}" alt="logo" width="50px" />
                                </a>
                                <button type="button" class="close btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                                <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                                    <li class="nav-item position-relative">
                                        <a class="nav-link" href="#sejarah">Sejarah</a>
                                    </li>
                                    <li class="nav-item position-relative">
                                        <a class="nav-link" href="#visimisi">Visi & Misi</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer border-0" style="padding: 2rem; padding-top: 0.75rem">
                                @guest
                                <a href="{{ route('admin.login') }}" class="btn btn-fill text-white">Login</a>
                                @endguest

                                @auth
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-fill text-white">Dashboard</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Navbar -->
                <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                        <li class="nav-item position-relative">
                            <a class="nav-link" href="#sejarah">Sejarah</a>
                        </li>
                        <li class="nav-item position-relative">
                            <a class="nav-link" href="#visimisi">Visi & Misi</a>
                        </li>
                    </ul>
                    @guest
                    <a href="{{ route('admin.login') }}" class="btn btn-fill text-white">Login</a>
                    @endguest

                    @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-fill text-white">Dashboard</a>
                    @endauth
                </div>
            </nav>
            <div class="hr">
                <hr style="border-color: #F4F4F4;background-color: #F4F4F4;opacity: 1;margin: 0 !important;" />
            </div>
        </div>
    </section>

    @yield('content')

    <section class="h-100 w-100" style="box-sizing: border-box; background-color: #141432">
        <div class="footer-2-3 container-xxl mx-auto position-relative p-0" style="font-family: 'Poppins', sans-serif">
            <div class="list-footer">
                <div class="row gap-md-0 gap-3">
                    <div class="col-lg-3 col-md-6">
                        <div class="">
                            <div class="list-space">
                                <img src="{{ asset('assets/images/logo.jpeg') }}" alt="logo" width="60px" style="border-radius: 100%;" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h2 class="footer-text-title text-white">Stt Segara Madu</h2>
                        <nav class="list-unstyled">
                            <li class="list-space">
                                <a href="#sejarah" class="list-menu">Sejarah</a>
                            </li>
                            <li class="list-space">
                                <a href="#visimisi" class="list-menu">Visi & Misi</a>
                            </li>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="border-color info-footer">
                <div class="">
                    <hr class="hr" />
                </div>
                <div class="footer-info-space" style="text-align: right;">
                    <p style="margin: 0">Copyright © 2022 Stt Segara Madu</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    @stack('scripts')
</body>

</html>