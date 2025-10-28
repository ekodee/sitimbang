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
                        <span class="pc-micon"><svg width="20" height="20" class="icon">
                                <use xlink:href="#icon-home"></use>
                            </svg></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                {{-- Timbangan --}}
                @can('timbangan-list')
                    <li class="pc-item pc-caption">
                        <label>Sampah</label>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('timbangan.index') }}" class="pc-link">
                            <span class="pc-micon"><svg width="20" height="20" class="icon">
                                    <use xlink:href="#icon-scale"></use>
                                </svg></span>
                            <span class="pc-mtext">Timbangan</span>
                        </a>
                    </li>
                @endcan

                {{-- Master Data --}}
                @can('truk-list')
                    <li class="pc-item pc-caption">
                        <label>Master Data</label>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('truk.index') }}" class="pc-link">
                            <span class="pc-micon"><svg width="20" height="20" class="icon">
                                    <use xlink:href="#icon-truck"></use>
                                </svg></span>
                            <span class="pc-mtext">Truk</span>
                        </a>
                    </li>
                @endcan
                @can('supir-list')
                    <li class="pc-item">
                        <a href="{{ route('supir.index') }}" class="pc-link">
                            <span class="pc-micon"><svg width="20" height="20" class="icon">
                                    <use xlink:href="#icon-user"></use>
                                </svg></span>
                            <span class="pc-mtext">Supir</span>
                        </a>
                    </li>
                @endcan


                {{-- Laporan --}}
                @can('laporan-list')
                    <li class="pc-item pc-caption">
                        <label>Laporan</label>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('laporan.index') }}" class="pc-link">
                            <span class="pc-micon"><svg width="20" height="20" class="icon">
                                    <use xlink:href="#icon-report"></use>
                                </svg></span>
                            <span class="pc-mtext">Laporan </span>
                        </a>
                    </li>
                @endcan

                {{-- Users & Role --}}
                @can('role-list')
                    <li class="pc-item pc-caption">
                        <label>Users</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('user.index') }}" class="pc-link">
                            <span class="pc-micon"><svg width="20" height="20" class="icon">
                                    <use xlink:href="#icon-user-plus"></use>
                                </svg></span>
                            <span class="pc-mtext">Users</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('role.index') }}" class="pc-link">
                            <span class="pc-micon"><svg width="20" height="20" class="icon">
                                    <use xlink:href="#icon-lock-access"></use>
                                </svg></span>
                            <span class="pc-mtext">Role</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
    </div>
</nav>
