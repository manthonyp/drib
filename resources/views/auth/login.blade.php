@extends('layouts.page')

@section('title', 'Sign In - drib')

@section('content')

    <div class="row">
        <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto py-3">
            <h1 class="text-center mb-5">Sign In</h1>
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                
                @csrf

                <div class="form-group">
                    <label for="email" class="col-form-label text-md-right">{{ __('Email:') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark btn-lg w-100 has-ripple">
                        {{ __('Login') }}<div class="rippleJS"></div>
                    </button>

                </div>
                <div class="form-group d-flex justify-content-between">
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    <a href="{{ url('register') }}">
                        {{ __('Don\'t have an account') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
