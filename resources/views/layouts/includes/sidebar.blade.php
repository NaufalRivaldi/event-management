<div id="sidebar-nav" class="sidebar">
    <nav>
        <ul class="nav" id="sidebar-nav-menu">
            <li class="menu-group">Main</li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="">
                    <i class="ti-dashboard"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            @if (auth()->user()->isAnggota)
            <li>
                <a href="{{ route('admin.event-list.index') }}" class="">
                    <i class="fas fa-calendar"></i>
                    <span class="title">Event List</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->isAdmin)
            <li class="menu-group">Master</li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="">
                    <i class="ti-user"></i>
                    <span class="title">User</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.anggota.index') }}" class="">
                    <i class="ti-user"></i>
                    <span class="title">Anggota</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.events.index') }}" class="">
                    <i class="fas fa-calendar"></i>
                    <span class="title">Event</span>
                </a>
            </li>
            @endif
        </ul>
        <button type="button" class="btn-toggle-minified" title="Toggle Minified Menu"><i class="ti-arrows-horizontal"></i></button>
    </nav>
</div>