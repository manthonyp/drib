<div id="topnav" class="fixed-top border-bottom">
    <div class="container-fluid position-relative d-flex justify-content-between align-items-center">
        <div class="logo d-flex justify-content-center align-items-center">
            <a href="/">

                @if (Auth::user()->theme == 'dark')
                    <img src="{{asset('assets/logo-light.png')}}" alt="drib">
                @else
                    <img src="{{asset('assets/logo-dark.png')}}" alt="drib">
                @endif
                
            </a>
            <div class="d-flex">
                <button id="sidebar-show" class="round-button dark text-dark d-flex justify-content-center ml-2" type="button">
                    <i class="material-icons">menu</i>
                    <div class="rippleJS"></div>
                </button>
            </div>
        </div>
        <div id="form-sm" class="d-flex justify-content-between px-3">

            {!! Form::open(['action' => 'DashboardController@search', 'method' => 'GET', 'class' => 'd-flex justify-content-between align-items-center border-bottom w-100 mr-2']) !!}
                <div class="d-flex w-100">
                    <input type="text" class="search" name="search" placeholder="Search" autocomplete="off" required>
                </div>
                <div class="d-flex">
                    <button class="search-icon round-button dark text-dark d-flex justify-content-center ml-2" type="submit" data-toggle="tooltip" data-placement="bottom" title="Submit">
                        <i class="material-icons">search</i>
                        <div class="rippleJS"></div>
                    </button>
                </div>
                
            {!! Form::close() !!}

            <div class="d-flex">
                <button id="search-mobile--hide" class="round-button dark text-dark d-flex justify-content-center" type="button" data-toggle="tooltip" data-placement="bottom" title="Back">
                    <i class="material-icons">arrow_forward</i>
                    <div class="rippleJS"></div>
                </button>
            </div>       
        </div>
        
        {!! Form::open(['action' => 'DashboardController@search', 'method' => 'GET', 'id' => 'form-sd', 'class' => 'position-relative']) !!}
            <input type="text" class="search" name="search" placeholder="Search" autocomplete="off">
            <button class="search-icon round-button d-flex justify-content-center">
                <i class="material-icons">search</i>
            </button>
        {!! Form::close() !!}

        <div class="user-panel d-flex justify-content-center align-items-center">
            <button id="search-mobile--show" class="round-button dark text-dark justify-content-center mr-3" type="button" data-toggle="tooltip" data-placement="bottom" title="Search">
                <i class="material-icons">search</i>
                <div class="rippleJS"></div>
            </button>
            <span data-toggle="tooltip" data-placement="bottom" title="Upload">
                <button id="upload-show" class="round-button dark text-dark d-flex justify-content-center mr-4" type="button" data-toggle="modal" data-target="#upload_modal">
                    <i class="material-icons">publish</i>
                    <div class="rippleJS"></div>
                </button>
            </span>
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

                    @if (Auth::user()->theme == 'dark')

                        <a class="dropdown-item" href="javascript:void(0)" onclick="document.getElementById('theme_changer').submit();">
                            <div class="d-table-cell text-center pr-3"><i class="fas fa-adjust"></i></div>
                            <div class="d-table-cell">Disable Dark Mode</div>
                        </a>
 
                        {!! Form::open(['action' => 'UsersController@update', 'method' => 'POST', 'id' => 'theme_changer', 'class' => 'd-none']) !!}
                            <input type="text" name="theme" id="theme" value="light">
                        {!! Form::close() !!}
                    
                    @else

                        <a class="dropdown-item" href="javascript:void(0)" onclick="document.getElementById('theme_changer').submit();">
                            <div class="d-table-cell text-center pr-3"><i class="fas fa-adjust"></i></div>
                            <div class="d-table-cell">Enable Dark Mode</div>
                        </a>
                        
                        {!! Form::open(['action' => 'UsersController@update', 'method' => 'POST', 'id' => 'theme_changer', 'class' => 'd-none']) !!}
                            <input type="text" name="theme" id="theme" value="dark">
                        {!! Form::close() !!}
                        
                    @endif
                    
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
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        {{ csrf_field() }}
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <div class="d-table-cell text-center pr-3"><i class="fas fa-sign-out-alt"></i></div>
                        <div class="d-table-cell">Sign Out</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>