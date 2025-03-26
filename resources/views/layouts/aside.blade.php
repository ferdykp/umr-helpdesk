<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 bg-primary text-white }}" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logo-master.png') }}" width="40px" height="40px"
                class="navbar-brand-img h-100 inline" alt="main_logo">
            <span class="ms-1 font-weight-bold">Master Label Helpdesk</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-9">Choose Menu</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-gauge text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('report') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('report') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-circle-exclamation text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('manualbook') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('manualbook') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-solid fa-book text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Manual Book</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('audit') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('audit') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-solid fa-folder-open text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Audit Dokumen</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('maintenance') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('maintenance') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-solid fa-calendar-days text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Maintenance</span>
                </a>
            </li>




            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-9">Master</h6>
            </li>
            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('machine') ? 'bg-primary text-white rounded-lg' : '' }}"
                        href="{{ route('machine') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-warehouse text-dark text-sm"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mesin</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('location') ? 'bg-primary text-white rounded-lg' : '' }}"
                        href="{{ route('location') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-map-marker-alt text-dark text-sm"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lokasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('shift') ? 'bg-primary text-white rounded-lg' : '' }}"
                        href="{{ route('shift') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-clock text-dark text-sm"></i>
                        </div>
                        <span class="nav-link-text ms-1">Shift</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('sparepart') || request()->is('tracking') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="#" id="sparepartDropdown" role="button" data-bs-toggle="collapse"
                    data-bs-target="#sparepartMenu" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-gear text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sparepart</span>
                    {{-- <i class="fa-solid fa-chevron-down ms-auto"></i> --}}
                </a>
                <div class="collapse  {{ request()->is('sparepart*') || request()->is('tracking') ? 'show' : '' }}"
                    id="sparepartMenu">
                    <ul class="nav flex-column ms-3 my-2">
                        <li class="nav-item">
                            <a class="nav-link p-2 {{ request()->is('sparepart') ? 'active bg-light rounded' : '' }}"
                                href="sparepart">
                                Inventory Sparepart
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2 {{ request()->is('tracking') ? 'active bg-light rounded' : '' }}"
                                href="tracking">
                                Tracking Sparepart
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</aside>
