<nav class="navbar navbar-expand fixed-top">
    <div class="navbar-brand d-none d-lg-block">
        <a href="index.html"><img src="{{ asset('assets/images/logo-white.png') }}" alt="Klorofil Pro Logo" class="img-fluid logo"></a>
    </div>
    <div class="container-fluid p-0">
        <button id="tour-fullwidth" type="button" class="btn btn-default btn-toggle-fullwidth"><i class="ti-menu"></i></button>
        <div id="navbar-menu">
            <ul class="nav navbar-nav align-items-center">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="https://i.imgur.com/M701HZb.jpg" class="user-picture"" alt=" Avatar"> <span>Samuel</span></a>
                    <ul class="dropdown-menu dropdown-menu-right logged-user-menu">
                        <li>
                            <a href="{{ route('admin.profile.index') }}">
                                <i class="ti-user"></i> <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="onLogout(event)">
                                <i class="ti-power-off"></i> <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<form id="form-logout" action="{{ route('admin.logout') }}" method="POST">
    @csrf
</form>

@push('scripts')
<script>
    function onLogout(e) {
        e.preventDefault();

        const formLogout = document.getElementById('form-logout');

        formLogout.submit();
    }
</script>
@endpush