@extends('partials.auth_partials')
@section('auth_content')
    <main class="auth-container">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header justify-content-center bg-white">
                            <img class="img-fluid login-logo mx-auto" src="{{ asset('assets') }}/assets/img/logo.png" alt="Logo Glints">
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block mb-2">
                                    <button type="button" class="close" data-dismiss="alert">×</button>    
                                    {{ $message }}
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block mb-2">
                                    <button type="button" class="close" data-dismiss="alert">×</button>    
                                    {{ $message }}
                                </div>
                            @endif
                            <form action="{{ route('post_login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="small mb-1" for="email">{{ __('Email') }}</label>
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="password">{{ __('Password') }}</label>
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Enter password" />
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="/forgotpassword">{{ __('Forgot Password?') }}</a>
                                    <button class="btn btn-primary lift" type="submit">{{ __('Login') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <div class="small"><a href="/register">{{ __('Need an account? Sign up!') }}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
