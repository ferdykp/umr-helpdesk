<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" {{ request()->is('dashboard*') ? 'bg-primary text-white' : '' }}"
            href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logo-mining.png') }}" width="40px" height="40px"
                class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">D-Bridge Tim</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-9">Choose Menu</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('allDashboard') ? 'bg-primary text-white' : '' }}"
                    href="{{ route('allDashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard*') ? 'bg-primary text-white' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Outstanding WR @if (Auth::user()->role == 'supplier')
                            UT
                        @endif
                    </span>
                </a>
            </li>

            @if (in_array(Auth::user()->role, ['sm']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('stockCode.index') || request()->routeIs('stockCode.create') ? 'bg-primary text-white' : '' }}"
                        href="{{ route('stockCode.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Stock Code</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('bcs') || request()->routeIs('bcs') ? 'bg-primary text-white' : '' }}"
                    href="{{ route('bcs') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-books text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">BCS @if (Auth::user()->role == 'supplier')
                            UT
                        @endif
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('midlife') || request()->routeIs('midlife') ? 'bg-primary text-white' : '' }}"
                    href="{{ route('midlife') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bag-17 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Midlife @if (Auth::user()->role == 'supplier')
                            UT
                        @endif
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('overhaul') || request()->routeIs('overhaul') ? 'bg-primary text-white' : '' }}"
                    href="{{ route('overhaul') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-box-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Overhaul @if (Auth::user()->role == 'supplier')
                            UT
                        @endif
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('periodic') || request()->routeIs('periodic') ? 'bg-primary text-white' : '' }}"
                    href="{{ route('periodic') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-ruler-pencil text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Periodic Service @if (Auth::user()->role == 'supplier')
                            UT
                        @endif
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lainnya') || request()->routeIs('lainnya') ? 'bg-primary text-white' : '' }}"
                    href="{{ route('lainnya') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lainnya @if (Auth::user()->role == 'supplier')
                            UT
                        @endif
                    </span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('pages/rtl') ? 'bg-primary text-white' : '' }}"
                    href="../pages/rtl.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">RTL</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.show', 1) ? 'bg-primary text-white' : '' }}"
                    href="{{ route('users.show', 1) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li> --}}
            {{-- @if (Auth::user()->role == 'sm')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.create') ? 'bg-primary text-white' : '' }}"
                        href="{{ route('users.create') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Create Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.index', 1) ? 'bg-primary text-white' : '' }}"
                        href="{{ route('users.index', 1) }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Show Users</span>
                    </a>
                </li>
            @endif --}}
        </ul>
    </div>
</aside>
