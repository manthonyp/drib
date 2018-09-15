@extends('layouts.page')

@section('title', 'Sign Up - drib')

@section('content')
        
    <div class="row">
        <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto py-3">
            <h1 class="text-center mb-5">Sign Up</h1>
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                
                @csrf

                <div class="form-group">
                    <label for="name" class="col-form-label text-md-right">{{ __('Username:') }}</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))

                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>

                    @endif
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label text-md-right">{{ __('Email:') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))

                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>

                    @endif

                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label text-md-right">{{ __('Password:') }}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))

                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password:') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark btn-lg w-100 has-ripple">
                        {{ __('Register') }}<div class="rippleJS"></div>
                    </button>
                </div>
                <div class="form-group">
                    <a href="{{ url('login') }}">
                        {{ __('Already have an account?') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
