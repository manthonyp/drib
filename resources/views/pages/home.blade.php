@extends('layouts.page')

@section('title', 'drib - Simple Cloud Storage')

@section('style')

    <style>
        #app {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100vh;
            background-color: #000;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url(/assets/front.png);
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        main {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
                -ms-flex-direction: column;
                    flex-direction: column;
            -webkit-box-pack: center;
                -ms-flex-pack: center;
                    justify-content: center;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
        }
        
        nav .link-list .link-item,
        nav .signin-link a,
        .dropdown-toggle,
        .front, footer a {
            color: #fff !important;
        }

        .round-button.dark:hover {
            background-color: #8a8a8a !important;
        }

        .front-title {
            font-size: 80px;
        }

        .btn--sign-in,
        .btn--sign-up,
        .btn--sign-in:hover,
        .btn--sign-up:hover {
            background-color: rgba(255, 255, 255, 0.11);
            border-radius: 25px;
            padding: .3rem 2rem;
            border: 1px solid #fff !important;
            color: #fff;
            font-size: 20px;
            cursor: pointer !important;
        }

        footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            color: #adadad;
        }

        

        @media(max-width: 768px) {
            .front .front-title {
                font-size: 50px !important;
            }

            .front-desc {
                font-size: 20px !important;
                margin-bottom: 1.3rem !important;
            }

            .btn--sign-in,
            .btn--sign-up,
            .btn--sign-in:hover,
            .btn--sign-up:hover {
                padding: .2rem 1.5rem !important;
                font-size: 16px !important
            }
        }

        @media(max-width: 576px) {
            .front .front-title {
                font-size: 40px !important;
            }

            .front-desc {
                font-size: 18px !important;
                margin-bottom: 1rem !important;
            }

            .btn--sign-in,
            .btn--sign-up,
            .btn--sign-in:hover,
            .btn--sign-up:hover {
                padding: .2rem 1.2rem !important;
                font-size: 13px !important
            }
        }
        
    </style>

@endsection

@section('content')
    
    <div class="front pb-5">
        <div class="front-slogan text-center">
            <h1 class="front-title site-name font-weight-light">drib</h1>
            <h1 class="front-desc font-weight-light mb-5">Simple cloud storage to save your files and documents</h1>
            
            @if (Auth::guest())

                <div class="mb-2">Sign in or create an account now</div>
                <div class="d-flex justify-content-center align-items-center">
                    <a class="text-light mr-1" href="{{ route('login') }}">
                        <button type="button" class="btn--sign-in font-weight-light has-ripple">
                            Sign In<div class="rippleJS"></div>
                        </button>
                    </a>
                    {{-- <span class="badge text-light mx-2">OR</span> --}}
                    <a class="text-light ml-1" href="{{ route('register') }}">
                        <button type="button" class="btn--sign-up font-weight-light has-ripple">
                            Sign Up<div class="rippleJS"></div>
                        </button>
                    </a>
                </div>
                
            @endif

        </div>
    </div>

@endsection
