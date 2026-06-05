<nav id="mainNavbar" class="navbar navbar-dark bg-dark fixed-top shadow-sm border-bottom border-secondary border-opacity-10">
    <div class="container">
        <div class="d-flex align-items-center w-100">

            <!-- Brand -->
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 me-auto" href="{{ route('products.index') }}">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-25" style="width:30px;height:30px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
                    </svg>
                </span>
                SmartTrade Africa Ltd
            </a>

            <!-- Desktop nav (lg+) -->
            <ul class="navbar-nav flex-row d-none d-lg-flex align-items-center gap-3 me-3 desktop-nav">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active fw-bold' : '' }}" href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active fw-bold' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active fw-bold' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('faq') ? 'active fw-bold' : '' }}" href="{{ route('faq') }}">FAQ</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart.*') ? 'active fw-bold' : '' }}" href="{{ route('cart.index') }}">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('wishlist.*') ? 'active fw-bold' : '' }}" href="{{ route('wishlist.index') }}">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('orders.*') ? 'active fw-bold' : '' }}" href="{{ route('orders.index') }}">Orders</a>
                    </li>
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-semibold {{ request()->routeIs('admin.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.dashboard') }}">Admin</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Desktop Auth Buttons -->
            <div class="d-none d-lg-flex align-items-center gap-2">
                @guest
                    <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-light btn-sm" href="{{ route('register') }}">Register</a>
                @else
                    <!-- Notification Dropdown -->
                    <div class="dropdown" id="notif-dropdown">
                        <button class="btn btn-outline-light btn-sm rounded-3 position-relative" data-bs-toggle="dropdown" aria-expanded="false" id="notif-bell">
                            <svg id="notif-bell-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                            </svg>
                            <span id="notif-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:9px;display:none;">0</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow" style="width:320px;" id="notif-menu">
                            <li><h6 class="dropdown-header d-flex align-items-center gap-2">Notifications <span class="badge bg-danger small" id="notif-new-badge" style="display:none;">new</span></h6></li>
                            <li><div id="notif-list" class="px-3 py-2 text-center text-muted small">Loading...</div></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <a class="dropdown-item text-center small d-flex align-items-center justify-content-center gap-1" href="{{ route('notifications.index') }}">
                                    View all
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle rounded-3 px-3 d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="rounded-circle bg-dark text-white d-inline-flex align-items-center justify-content-center flex-shrink-0 fw-bold" style="width:28px;height:28px;font-size:12px;">
                                {{ strtoupper(substr(Auth::user()->first_name ?? 'U', 0, 1)) }}
                            </span>
                            <span class="d-none d-xl-inline">{{ Auth::user()->first_name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow border-secondary border-opacity-25 rounded-3 py-1">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4q0 1-1 1H7a1 1 0 0 1-1-1H2s-2 0-2-2zm1 1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1m1 1h2v2H2zm3 0h2v2H5zm3 0h2v2H8z"/></svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('history.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m0-7a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H1.5a.5.5 0 0 0-.5.5"/></svg>
                                    History
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.edit') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/></svg>
                                    Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item d-flex align-items-center gap-2 text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/><path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/></svg>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>

            <!-- Mobile toggler -->
            <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav" aria-controls="offcanvasNav">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </div>
</nav>

<!-- Offcanvas Mobile Menu -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
    <div class="offcanvas-header border-bottom border-secondary border-opacity-10">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('products.index') }}">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-25" style="width:30px;height:30px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
                </svg>
            </span>
            SmartTrade Africa Ltd
        </a>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <ul class="navbar-nav gap-0">
            <li class="nav-item">
                <a class="nav-link px-3 py-2 {{ request()->routeIs('products.*') ? 'active fw-bold' : '' }}" href="{{ route('products.index') }}">
                    <span class="d-inline-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1"/></svg>
                        Products
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 py-2 {{ request()->routeIs('about') ? 'active fw-bold' : '' }}" href="{{ route('about') }}">
                    <span class="d-inline-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/></svg>
                        About
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 py-2 {{ request()->routeIs('contact') ? 'active fw-bold' : '' }}" href="{{ route('contact') }}">
                    <span class="d-inline-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/></svg>
                        Contact
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 py-2 {{ request()->routeIs('faq') ? 'active fw-bold' : '' }}" href="{{ route('faq') }}">
                    <span class="d-inline-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/></svg>
                        FAQ
                    </span>
                </a>
            </li>

            @auth
                <hr class="border-secondary border-opacity-10 my-1 mx-3">

                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4q0 1-1 1H7a1 1 0 0 1-1-1H2s-2 0-2-2zm1 1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1m1 1h2v2H2zm3 0h2v2H5zm3 0h2v2H8z"/></svg>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('cart.*') ? 'active fw-bold' : '' }}" href="{{ route('cart.index') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/></svg>
                            Cart
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('wishlist.*') ? 'active fw-bold' : '' }}" href="{{ route('wishlist.index') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/></svg>
                            Wishlist
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('orders.*') ? 'active fw-bold' : '' }}" href="{{ route('orders.index') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/><path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.5-.5z"/></svg>
                            Orders
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('history.*') ? 'active fw-bold' : '' }}" href="{{ route('history.index') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m0-7a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H1.5a.5.5 0 0 0-.5.5"/></svg>
                            History
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('notifications.*') ? 'active fw-bold' : '' }}" href="{{ route('notifications.index') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/></svg>
                            Notifications
                        </span>
                    </a>
                </li>
                @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 text-warning fw-semibold {{ request()->routeIs('admin.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.dashboard') }}">
                            <span class="d-inline-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M13.5 8a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 0 0 .5.5h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H15v.5a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 1-.5-.5v-.5h-1.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5h1.5v-.5a1.5 1.5 0 0 1 1.5-1.5m-8-.5a.5.5 0 0 1 .5.5v.5H7v.5a.5.5 0 0 1-.5.5H6v.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V10h-1.5a.5.5 0 0 1-.5-.5V9a.5.5 0 0 1 .5-.5H4.5V8a.5.5 0 0 1 .5-.5zM8 5.5a3 3 0 1 0-6 0 3 3 0 0 0 6 0m-3 2a2 2 0 1 1 0-4 2 2 0 0 1 0 4m5.5-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/></svg>
                                Admin
                            </span>
                        </a>
                    </li>
                @endif

                <hr class="border-secondary border-opacity-10 my-1 mx-3">

                <li class="nav-item">
                    <a class="nav-link px-3 py-2" href="{{ route('profile.edit') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/></svg>
                            Profile
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link px-3 py-2 text-danger border-0 bg-transparent w-100 text-start">
                            <span class="d-inline-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/><path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/></svg>
                                Logout
                            </span>
                        </button>
                    </form>
                </li>
            @else
                <hr class="border-secondary border-opacity-10 my-1 mx-3">

                <li class="nav-item">
                    <a class="nav-link px-3 py-2" href="{{ route('login') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/><path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/></svg>
                            Login
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2" href="{{ route('register') }}">
                        <span class="d-inline-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/></svg>
                            Register
                        </span>
                    </a>
                </li>
            @endauth

        </ul>

        <!-- Sticky Footer -->
        <div class="position-absolute bottom-0 start-0 end-0 p-3 border-top border-secondary border-opacity-10">
            <small class="text-secondary">&copy; {{ date('Y') }} SmartTrade Africa Ltd. All rights reserved.</small>
        </div>
    </div>
</div>

<!-- Development Notice Banner -->
<div class="dev-notice-bar">
    <div class="dev-notice-track">
        <span class="dev-notice-text">
            🚧 Development Notice: This e-commerce platform is under active development. New features, security enhancements, and performance improvements are being added regularly. ⚠️ Work in Progress: Some services may be temporarily unavailable while testing and updates are being performed. Thank you for your patience and support.
        </span>
        <span class="dev-notice-text">
            🚧 Development Notice: This e-commerce platform is under active development. New features, security enhancements, and performance improvements are being added regularly. ⚠️ Work in Progress: Some services may be temporarily unavailable while testing and updates are being performed. Thank you for your patience and support.
        </span>
    </div>
</div>

<!-- Sub-navbar info bar (auth only, desktop) -->
@auth
<div class="bg-light border-bottom small d-none d-lg-block">
    <div class="container d-flex gap-4 py-1 text-muted">
        <span class="text-success fw-semibold d-inline-flex align-items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path d="M9.5 0a.5.5 0 0 1 .5.5V3h3a.5.5 0 0 1 0 1h-3v2.5a.5.5 0 0 1-1 0V4h-3a.5.5 0 0 1 0-1h3V.5a.5.5 0 0 1 .5-.5"/><path d="M4.5 9.5a.5.5 0 0 1 .5.5v1.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 1 0 1h-1A1.5 1.5 0 0 1 4 11.5V10a.5.5 0 0 1 .5-.5m8 0a.5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-1a.5.5 0 0 1 0-1h1a.5.5 0 0 0 .5-.5V10a.5.5 0 0 1 .5-.5"/><path d="M14.5 3a.5.5 0 0 1 .5.5v9.5a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 2 13V3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H3v9.5a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V3.5a.5.5 0 0 1 .5-.5"/></svg>
            Fingerprint Verified Login
        </span>
        <span class="text-primary fw-semibold d-inline-flex align-items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path d="M2 3h10a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z"/><path d="M6.5 7.5a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/></svg>
            Secure Payment via Stripe
        </span>
        <span class="d-inline-flex align-items-center gap-1" style="color:#a78bfa;">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1z"/></svg>
            Trusted Session
        </span>
    </div>
</div>
@endauth

<style>
    /* ── Stagger fade-in down for desktop nav items ── */
    .desktop-nav > .nav-item {
        opacity: 0;
        animation: fadeInDown 0.4s ease forwards;
    }
    .desktop-nav > .nav-item:nth-child(1) { animation-delay: 0.1s; }
    .desktop-nav > .nav-item:nth-child(2) { animation-delay: 0.15s; }
    .desktop-nav > .nav-item:nth-child(3) { animation-delay: 0.2s; }
    .desktop-nav > .nav-item:nth-child(4) { animation-delay: 0.25s; }
    .desktop-nav > .nav-item:nth-child(5) { animation-delay: 0.3s; }
    .desktop-nav > .nav-item:nth-child(6) { animation-delay: 0.35s; }
    .desktop-nav > .nav-item:nth-child(7) { animation-delay: 0.4s; }
    .desktop-nav > .nav-item:nth-child(8) { animation-delay: 0.45s; }
    .desktop-nav > .nav-item:nth-child(9) { animation-delay: 0.5s; }
    .desktop-nav > .nav-item:nth-child(10) { animation-delay: 0.55s; }
    .desktop-nav > .nav-item:nth-child(11) { animation-delay: 0.6s; }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Slide underline for nav links ── */
    .navbar-nav .nav-link {
        position: relative;
    }
    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 50%;
        width: 0;
        height: 2px;
        background: #0d6efd;
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }
    .navbar-nav .nav-link.text-warning::after {
        background: #ffc107;
    }
    .navbar-nav .nav-link:hover::after,
    .navbar-nav .nav-link.active::after {
        width: 80%;
    }

    /* ── Active pulse ── */
    .navbar-nav .nav-link.active {
        animation: activePulse 2s infinite;
    }
    .navbar-nav .nav-link.text-warning.active {
        animation: activePulseYellow 2s infinite;
    }
    @keyframes activePulse {
        0%, 100% { text-shadow: none; }
        50%      { text-shadow: 0 0 6px rgba(13,110,253,0.4); }
    }
    @keyframes activePulseYellow {
        0%, 100% { text-shadow: none; }
        50%      { text-shadow: 0 0 6px rgba(255,193,7,0.4); }
    }

    /* ── Scroll blur ── */
    #mainNavbar {
        transition: background 0.3s ease, box-shadow 0.3s ease;
    }
    #mainNavbar.navbar-scrolled {
        background: rgba(33,37,41,0.92) !important;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    /* ── Dropdown fade ── */
    .dropdown-menu.show {
        animation: dropFade 0.2s ease forwards;
    }
    @keyframes dropFade {
        from { opacity: 0; transform: translateY(-4px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Badge bounce ── */
    #notif-badge.bounce {
        animation: badgeBounce 0.5s ease;
    }
    @keyframes badgeBounce {
        0%   { transform: translate(-50%, -50%) scale(1); }
        25%  { transform: translate(-50%, -50%) scale(1.4); }
        50%  { transform: translate(-50%, -50%) scale(0.9); }
        70%  { transform: translate(-50%, -50%) scale(1.1); }
        100% { transform: translate(-50%, -50%) scale(1); }
    }

    /* ── Offcanvas stagger slide-in ── */
    .offcanvas-body .nav-item {
        opacity: 0;
        animation: slideInNav 0.4s ease forwards;
    }
    .offcanvas-body .nav-item:nth-child(1)  { animation-delay: 0.05s; }
    .offcanvas-body .nav-item:nth-child(2)  { animation-delay: 0.1s; }
    .offcanvas-body .nav-item:nth-child(3)  { animation-delay: 0.15s; }
    .offcanvas-body .nav-item:nth-child(4)  { animation-delay: 0.2s; }
    .offcanvas-body .nav-item:nth-child(5)  { animation-delay: 0.25s; }
    .offcanvas-body .nav-item:nth-child(6)  { animation-delay: 0.3s; }
    .offcanvas-body .nav-item:nth-child(7)  { animation-delay: 0.35s; }
    .offcanvas-body .nav-item:nth-child(8)  { animation-delay: 0.4s; }
    .offcanvas-body .nav-item:nth-child(9)  { animation-delay: 0.45s; }
    .offcanvas-body .nav-item:nth-child(10) { animation-delay: 0.5s; }
    .offcanvas-body .nav-item:nth-child(11) { animation-delay: 0.55s; }
    .offcanvas-body .nav-item:nth-child(12) { animation-delay: 0.6s; }
    .offcanvas-body .nav-item:nth-child(13) { animation-delay: 0.65s; }
    .offcanvas-body .nav-item:nth-child(14) { animation-delay: 0.7s; }
    .offcanvas-body .nav-item:nth-child(15) { animation-delay: 0.75s; }
    .offcanvas-body .nav-item:nth-child(16) { animation-delay: 0.8s; }
    .offcanvas-body .nav-item:nth-child(17) { animation-delay: 0.85s; }
    .offcanvas-body .nav-item:nth-child(18) { animation-delay: 0.9s; }

    @keyframes slideInNav {
        from { opacity: 0; transform: translateX(-20px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    /* ── Offcanvas backdrop opacity ── */
    .offcanvas-backdrop.show {
        opacity: 0.6 !important;
    }

    /* ── Brand hover ── */
    .navbar-brand {
        transition: transform 0.3s ease;
    }
    .navbar-brand:hover {
        transform: scale(1.03);
    }

    /* ── Toggler rotate ── */
    .navbar-toggler {
        transition: transform 0.3s ease;
    }
    .navbar-toggler[aria-expanded="true"] {
        transform: rotate(90deg);
    }

    /* ── Bell vibrate ── */
    @keyframes bell-vibrate {
        0%   { transform: rotate(0deg); }
        10%  { transform: rotate(15deg); }
        20%  { transform: rotate(-12deg); }
        30%  { transform: rotate(10deg); }
        40%  { transform: rotate(-8deg); }
        50%  { transform: rotate(6deg); }
        60%  { transform: rotate(-4deg); }
        70%  { transform: rotate(2deg); }
        80%  { transform: rotate(-1deg); }
        90%  { transform: rotate(1deg); }
        100% { transform: rotate(0deg); }
    }
    #notif-bell-icon.bell-vibrate {
        animation: bell-vibrate 0.6s ease-in-out;
        transform-origin: top center;
    }

    /* ── OTP debug code ── */
    #otpDebugCode {
        color: #b45309;
    }

    /* ── Dev Notice Bar ── */
    .dev-notice-bar {
        position: fixed;
        top: 56px;
        left: 0;
        right: 0;
        background: #dc3545;
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        line-height: 1.3;
        overflow: hidden;
        white-space: nowrap;
        padding: 4px 0;
        box-shadow: 0 2px 6px rgba(0,0,0,0.12);
        z-index: 1020;
    }
    .dev-notice-track {
        display: inline-flex;
        animation: marquee 40s linear infinite;
    }
    .dev-notice-bar:hover .dev-notice-track {
        animation-play-state: paused;
    }
    .dev-notice-text {
        padding: 0 2rem;
        flex-shrink: 0;
    }
    @keyframes marquee {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    @media (max-width: 991.98px) {
        .dev-notice-bar {
            font-size: 10px;
            padding: 3px 0;
        }
        .dev-notice-text {
            padding: 0 1rem;
        }
    }

    /* ── Transitions for notif-items ── */
    .notif-item {
        transition: background 0.15s ease;
    }
    .notif-item:hover {
        background: rgba(255,255,255,0.05) !important;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Scroll behavior ── */
    const nav = document.getElementById('mainNavbar');
    if (nav) {
        window.addEventListener('scroll', function () {
            nav.classList.toggle('navbar-scrolled', window.scrollY > 30);
        });
    }

    /* ── Notifications ── */
    const bell = document.getElementById('notif-bell');
    if (!bell) return;

    const badge = document.getElementById('notif-badge');
    const list  = document.getElementById('notif-list');
    const icon  = document.getElementById('notif-bell-icon');
    let prevCount = 0;

    function updateBadge() {
        fetch('{{ route('notifications.unreadCount') }}')
            .then(r => r.json())
            .then(d => {
                if (d.count > 0) {
                    badge.style.display = 'inline';
                    badge.textContent = d.count > 99 ? '99+' : d.count;
                    if (prevCount === 0 && icon) {
                        icon.classList.remove('bell-vibrate');
                        void icon.offsetWidth;
                        icon.classList.add('bell-vibrate');
                        badge.classList.remove('bounce');
                        void badge.offsetWidth;
                        badge.classList.add('bounce');
                    }
                } else {
                    badge.style.display = 'none';
                }
                prevCount = d.count;
            });
    }

    function loadDropdown() {
        fetch('{{ route('notifications.recent') }}')
            .then(r => r.json())
            .then(items => {
                if (!list) return;
                if (items.length === 0) {
                    list.innerHTML = '<div class="text-muted small py-2 text-center">No notifications yet.</div>';
                    return;
                }
                const baseReadUrl = '{{ url('notifications') }}/';
                const indexUrl = '{{ route('notifications.index') }}';
                list.innerHTML = items.map(n => {
                    const dest = n.read ? (n.url || indexUrl) : baseReadUrl + n.id + '/read?redirect=' + encodeURIComponent(n.url || indexUrl);
                    return '<a href="' + dest + '" class="dropdown-item notif-item ' + (n.read ? '' : 'fw-semibold bg-dark bg-opacity-25') + ' px-3 py-2 border-bottom border-secondary border-opacity-25" style="white-space:normal;" data-id="' + n.id + '" data-read="' + (n.read ? '1' : '0') + '">' +
                        '<div class="small">' + n.message + '</div>' +
                        '<small class="text-muted">' + n.time + '</small>' +
                        '</a>';
                }).join('');
            })
            .catch(function () {
                if (list) list.innerHTML = '<div class="text-muted small py-2 text-center">Could not load.</div>';
            });

        updateBadge();
    }

    document.addEventListener('click', function (e) {
        var item = e.target.closest('.notif-item');
        if (!item || item.dataset.read === '1') return;
        e.preventDefault();
        var id = item.dataset.id;
        var href = item.getAttribute('href');
        var redirect = href.split('redirect=')[1] || '{{ route('notifications.index') }}';
        fetch('{{ url('notifications') }}/' + id + '/read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-HTTP-Method-Override': 'PATCH',
                'Accept': 'application/json',
            },
        }).then(function () {
            window.location.href = decodeURIComponent(redirect);
        }).catch(function () {
            window.location.href = decodeURIComponent(redirect);
        });
    });

    var dropdownEl = document.getElementById('notif-dropdown');
    if (dropdownEl) {
        dropdownEl.addEventListener('shown.bs.dropdown', loadDropdown);
    }

    updateBadge();
    setInterval(updateBadge, 30000);
});
</script>
@endpush
