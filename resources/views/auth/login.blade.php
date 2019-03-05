@extends('layouts.app3')

@section('title') CSS | Login @endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/class/login.class.css') }}">
@endsection

@section('content')
<div class="container-fluid position-relative">
    <div class="row login-form">
        <div class="col-md-4 mx-auto mt-5">
            
            <div class="card card-1">
                <div class="card-header text-center" style="background: #fefefe;">
                    <img src="{{ asset('imgs/lvcc-logo/logo.png') }}" class="img-responsive img-circle">
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <div>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-email" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-password" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check ml-2">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-11 mx-auto mb-2">
                                <button type="submit" class="btn btn-outline-primary form-control">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="col-md-12">
                                <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>

                                <a href="{{ route('register') }}" class="btn btn-link pull-right" hidden>
                                    Do not have any account?
                                </a>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
