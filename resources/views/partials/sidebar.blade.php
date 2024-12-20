<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- <li class="nav-heading">Menu Sidebar</li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ asset('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">ASET</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('aset*') || request()->is('jenis-aset*') || request()->is('lokasi-aset*') || request()->is('unit*') ? '' : 'collapsed' }}"
                data-bs-target="#nav-aset" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>ASET HARDWARE</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="nav-aset"
                class="nav-content collapse {{ request()->is('aset*') || request()->is('jenis-aset*') || request()->is('lokasi-aset*') || request()->is('unit*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('aset') }}" class="{{ request()->is('aset') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        <span>Data Aset</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('jenis-aset') }}" class="{{ request()->is('jenis-aset') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        <span>Jenis Aset</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('lokasi-aset') }}" class="{{ request()->is('lokasi-aset') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        <span>Lokasi Aset</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('unit') }}" class="{{ request()->is('unit') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        <span>Unit</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('public-apps*') ? '' : 'collapsed' }}" data-bs-target="#nav-app-public"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>PUBLIC APPS</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="nav-app-public" class="nav-content collapse {{ request()->is('public-apps*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('public-apps') }}" class="{{ request()->is('public-apps') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        <span>Cloudflare</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ asset('serah-terima') }}">
                <i class="bi bi-person"></i>
                <span>SERAH TERIMA</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->is('aset-software*') ? '' : 'collapsed' }}" data-bs-target="#nav-app"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>ASET SOFTWARE</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="nav-app" class="nav-content collapse {{ request()->is('aset-software*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('aset-software') }}" class="{{ request()->is('aset-software') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        <span>Aplikasi</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#art-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>ASET RUMAH TANGGA</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="art-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ asset('art-aset') }}">
                        <i class="bi bi-circle"></i>
                        <span>Data Aset</span>
                    </a>
                </li>

                <li>
                    <a href="{{ asset('art-jenis-aset') }}">
                        <i class="bi bi-circle"></i>
                        <span>Jenis Aset</span>
                    </a>
                </li>

                <li>
                    <a href="{{ asset('art-lokasi-aset') }}">
                        <i class="bi bi-circle"></i>
                        <span>Lokasi Aset</span>
                    </a>
                </li>

                <li>
                    <a href="{{ asset('art-unit') }}">
                        <i class="bi bi-circle"></i>
                        <span>Unit</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- <li class="nav-heading">MAINTENANCE</li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#nav-maintenance" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>MAINTENANCE</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="nav-maintenance" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ asset('aset') }}">
                        <i class="bi bi-circle"></i>
                        <span>Permintaan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ asset('aset') }}">
                        <i class="bi bi-circle"></i>
                        <span>Perbaikan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ asset('jenis-aset') }}">
                        <i class="bi bi-circle"></i>
                        <span>Penggantian</span>
                    </a>
                </li>

                <li>
                    <a href="{{ asset('lokasi-aset') }}">
                        <i class="bi bi-circle"></i>
                        <span>Pemusnahan</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
