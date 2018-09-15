<nav id="nav" class="position-relative d-flex justify-content-center align-items-center">
    <div class="container position-relative d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <div class="logo d-flex justify-content-center align-items-center">
                <a href="/">
    
                    @if (Route::currentRouteNamed('home'))
                        <img src="{{asset('assets/logo-light.png')}}" alt="drib">
                    @else
                        <img src="{{asset('assets/logo-dark.png')}}" alt="drib">
                    @endif
    
                </a>
                
            </div>

            <div id="nav-dropdown" class="dropdown ml-3">
                <button class="dropdown-toggle round-button dark text-dark d-flex justify-content-center" type="button" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="material-icons">menu</i>
                    <div class="rippleJS"></div>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="/">
                        <div class="d-table-cell">Home</div>
                    </a>
                    <a class="dropdown-item" href="/about">
                        <div class="d-table-cell">About</div>
                    </a>
                    <a class="dropdown-item" href="/terms">
                        <div class="d-table-cell">Terms</div>
                    </a>
                    <a class="dropdown-item" href="/privacy">
                        <div class="d-table-cell">Privacy</div>
                    </a>
                </div>
            </div>

            <div class="link-list d-flex justify-content-center align-items-center ml-4">
                <a class="link-item" href="/">Home</a>
                <a class="link-item" href="/about">About</a>
                <a class="link-item" href="/terms">Terms</a>
                <a class="link-item" href="/privacy">Privacy</a>
            </div>
        </div>

        @if (Auth::guest())

            <div class="signin-link d-flex justify-content-center align-items-center">
                <a class="mx-1 py-2" href="/login">Sign In</a>
            </div>

        @else

            <div class="user-panel d-flex justify-content-center align-items-center">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle d-flex justify-content-between align-items-center" data-toggle="dropdown" role="button" aria-expanded="false">

                        @if (Auth::user()->isAdmin())
                            <span class="admin-badge d-flex justify-content-center align-items-center">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        @endif

                        @if (!empty(Auth::user()->avatar))

                            <img class="user-avatar rounded-circle mr-2" src="{{ url('/storage/'.Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" width="30px" height="30px">

                        @else

                            <img class="user-avatar rounded-circle mr-2" src="{{ asset('assets/default-avatar.png') }}" alt="{{ Auth::user()->name }}" width="30px" height="30px">

                        @endif

                        <h5 class="user-name text-truncate mb-0">{{ Auth::user()->name }}</h5>
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a class="dropdown-item" href="/dashboard">
                            <div class="d-table-cell text-center pr-3"><i class="fas fa-columns"></i></div>
                            <div class="d-table-cell">Dashboard</div>
                        </a>
                        
                        @if (Auth::user()->isAdmin())

                            <a class="dropdown-item" href="/dashboard/admin">
                                <div class="d-table-cell text-center pr-3"><i class="fas fa-shield-alt"></i></div>
                                <div class="d-table-cell">Admin</div>
                            </a>

                        @endif

                        <a class="dropdown-item" href="/account/settings">
                            <div class="d-table-cell text-center pr-3"><i class="fas fa-cog"></i></div>
                            <div class="d-table-cell">Settings</div>
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <div class="d-table-cell text-center pr-3"><i class="fas fa-sign-out-alt"></i></div>
                            <div class="d-table-cell">Sign Out</div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>

        @endif

    </div>
</nav>
