<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header d-flex justify-content-center align-items-center">
            <a href="{{ route('dashboard.index') }}" class="b-brand text-primary fs-2 text-success fw-bold">
                SITIMBANG
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                {{-- Dashboard --}}
                <li class="pc-item">
                    <a href="{{ route('dashboard.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-home"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                {{-- Timbangan --}}
                <li class="pc-item pc-caption">
                    <label>Sampah</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('timbangan.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-scale"></i></span>
                        <span class="pc-mtext">Timbangan</span>
                    </a>
                </li>

                @if (Auth::user()->role->role_name == 'admin' || Auth::user()->role->role_name == 'superadmin')
                    {{-- Master Data --}}
                    <li class="pc-item pc-caption">
                        <label>Master Data</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('truk.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-truck"></i></span>
                            <span class="pc-mtext">Truk</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('supir.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user"></i></span>
                            <span class="pc-mtext">Supir</span>
                        </a>
                    </li>


                    {{-- Laporan --}}
                    <li class="pc-item pc-caption">
                        <label>Laporan</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('laporan.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-report"></i></span>
                            <span class="pc-mtext">Laporan </span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role->role_name == 'superadmin')
                    {{-- Users & Role --}}
                    <li class="pc-item pc-caption">
                        <label>Users</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('user.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Users & Role</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
