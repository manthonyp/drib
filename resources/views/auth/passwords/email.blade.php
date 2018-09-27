@extends('layouts.page')

@section('title', 'Forgot Password - drib')

@section('content')

    <div class="row">
        <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto py-3">
            <h1 class="text-center mb-5">Forgot Password</h1>

            @if (session('status'))

                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @endif

            <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">

                @csrf

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
                    <button type="submit" class="btn btn-dark btn-lg w-100 has-ripple">
                        {{ __('Send Password Reset Link') }}<div class="rippleJS"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
