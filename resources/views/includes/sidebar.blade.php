<aside id="sidebar" class="border-right">
    <div class="position-relative d-flex flex-column justify-content-between h-100 pb-3">
        <section>
            <div class="brand d-flex justify-content-between align-items-center">
                <a href="/">
                    
                    @if (Auth::user()->theme == 'dark')
                        <img src="{{asset('assets/logo-light.png')}}" alt="drib">
                    @else
                        <img src="{{asset('assets/logo-dark.png')}}" alt="drib">
                    @endif

                </a>
                <button id="sidebar-hide" class="round-button dark text-dark justify-content-center mr-2" type="button">
                    <i class="material-icons">close</i>
                    <div class="rippleJS"></div>
                </button>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <hr class="brand-border w-100 mt-0">
                <a class="item-list {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <div class="d-table-cell text-center pr-3">
                        <i class="fas fa-columns"></i>
                    </div>
                    <div class="d-table-cell">Dashboard</div>
                    <div class="rippleJS"></div>
                </a>
                <a class="item-list {{ Route::currentRouteNamed('all') ? 'active' : '' }}" href="/dashboard/all">
                    <div class="d-table-cell text-center pr-3">
                        <i class="fas fa-folder"></i>
                    </div>
                    <div class="d-table-cell">All</div>
                    <div class="rippleJS"></div>
                </a>
                <a class="item-list {{ Route::currentRouteNamed('recent') ? 'active' : '' }}" href="/dashboard/recent">
                    <div class="d-table-cell text-center pr-3">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="d-table-cell">Recent</div>
                    <div class="rippleJS"></div>
                </a>
                <a class="item-list {{ Route::currentRouteNamed('shared') ? 'active' : '' }}" href="/dashboard/shared">
                    <div class="d-table-cell text-center pr-3">
                        <i class="fas fa-link"></i>
                    </div>
                    <div class="d-table-cell">Shared</div>
                    <div class="rippleJS"></div>
                </a>
                <hr class="w-100">
                <a class="item-list {{ Route::currentRouteNamed('trash') ? 'active' : '' }}" href="/dashboard/trash">
                    <div class="d-table-cell text-center pr-3">
                        <i class="fas fa-trash"></i>
                    </div>
                    <div class="d-table-cell">Trash</div>
                    <div class="rippleJS"></div>
                </a>

                @if (auth()->user()->isAdmin())

                    <hr class="w-100">
                    <a class="item-list {{ Route::currentRouteNamed('admin') ? 'active' : '' }}" href="/dashboard/admin">
                        <div class="d-table-cell text-center pr-3">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="d-table-cell">Admin</div>
                        <div class="rippleJS"></div>
                    </a>

                @endif
                
            </div>
        </section>
        <footer>
            <div class="text-center py-2">
                <div class="small">© 2018<a href="{{url('/')}}"> drib</a>. All rights reserved.</div>
                <div class="d-flex flex-wrap justify-content-center small">
                    <a class="mx-1" href="/">Home</a>
                    <a class="mx-1" href="/about">About</a>
                    <a class="mx-1" href="/terms">Terms</a>
                    <a class="mx-1" href="/privacy">Privacy</a>
                </div>
            </div>
        </footer>
    </div>    
</aside>
<div class="sidebar-backdrop"></div>
