@extends('layouts.page')

@section('title', 'Account Settings - drib')

@section('content')

    <div class="row">
        <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto py-3">
            <div class="settings-module text-center">
                <h1 class="mb-5">Account Settings</h1>

                {!! Form::open(['action' => 'UsersController@update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                    <div class="text-center mb-3">

                        @if (!empty($user->avatar))

                            <div class="avatar-placeholder position-relative rounded-circle mx-auto mb-3" style="background:url(../storage/{{$user->avatar}}) no-repeat scroll center center / cover;width:150px;height:150px">
                                <div class="avatar-overlay position-absolute avatar-overlay d-flex flex-column justify-content-center rounded-circle text-light h-100 w-100">Change</div>
                                {{ Form::label('avatar', 'Choose avatar',['class' => 'change-avatar position-relative w-100 h-100 mb-0']) }}
                            </div>
                            <div class="file-selected">Change Avatar</div>
                            {{ Form::file('avatar') }}

                        @else

                            <div class="avatar-placeholder position-relative rounded-circle mx-auto mb-3" style="background:url(../assets/default-avatar.png) no-repeat scroll center center / cover;width:150px;height:150px">
                                <div class="avatar-overlay position-absolute avatar-overlay d-flex flex-column justify-content-center rounded-circle text-light h-100 w-100">Change</div>
                                {{ Form::label('avatar', 'Choose avatar',['class' => 'change-avatar position-relative w-100 h-100 mb-0']) }}
                            </div>
                            <div class="file-selected">Upload Avatar</div>
                            {{ Form::file('avatar') }}

                        @endif
                        
                    </div>
                    <div class="form-group text-left">
                        {{ Form::label('name', 'Username:') }}
                        {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group text-left">
                        {{ Form::label('email', 'Email:') }}
                        {{ Form::text('email', $user->email, ['class' => 'form-control']) }}
                    </div>
                    <hr>
                    <div class="text-left">
                        <h4>Change Password</h4>
                        <small><i class="fas fa-info-circle mr-1"></i>Leave blank to remain unchange</small>
                    </div>
                    <hr>
                    <div class="form-group text-left">
                        {{ Form::label('current_password', 'Current Password:') }}
                        {{ Form::password('current_password', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group text-left">
                        {{ Form::label('new_password', 'New Password:') }}
                        {{ Form::password('new_password', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group text-left">
                        {{ Form::label('new_password_confirmation', 'Confirm Password:') }}
                        {{ Form::password('new_password_confirmation', ['class' => 'form-control']) }}
                    </div>

                    <button class="btn btn-dark btn-lg w-100 has-ripple" type="submit">
                        Save Changes<div class="rippleJS"></div>
                    </button>
                    
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
