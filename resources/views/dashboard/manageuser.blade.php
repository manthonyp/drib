@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')

    <h1 class="page-title mb-3">Manage Users</h1>

    <input type="text" class="form-control col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3 search-user" name="search" placeholder="Search" autocomplete="off" required>

    @if(count($users) > 0)
        <div class="row list">

            @foreach ($users as $user)
        
                <div data-id="{{ $user->id }}" class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3 user-data">
                    <div class="card" tabindex='1'>
                        <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">

                            @if (!empty($user->avatar))
            
                                <div class="image-thumb rounded-circle" style="background:url('../../storage/{{$user->avatar}}') no-repeat scroll center center / cover;"></div>

                            @else

                                <div class="image-thumb rounded-circle" style="background:url('../../assets/default-avatar.png') no-repeat scroll center center / cover;"></div>

                            @endif
            
                        </div>
                        <div class="card-body position-relative px-2 py-2">
                            <h6 class="text-truncate mb-0">{{$user->name}}</h6>
                            <h6 class="text-truncate text-secondary mt-1 mb-0 account-type">{{$user->type}}</h6>          
                        </div>

                        @if($user->type !== 'admin')

                            <div class="card-dropdown dropup rounded-circle position-static">
                                <button class="dropdown-toggle rounded-circle px-2 py-1" id="cardDropdown" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                    <div class="rippleJS"></div>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item change-type" href="javascript:void(0)">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-exchange-alt"></i></div>
                                        <div class="d-table-cell">Change Type</div>
                                    </a>

                                    <a class="dropdown-item delete-user" href="javascript:void(0)">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-trash"></i></div>
                                        <div class="d-table-cell">Delete</div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            
            @endforeach
        </div>
    @else
        <p>No Users.</p>
    @endif

@endsection
