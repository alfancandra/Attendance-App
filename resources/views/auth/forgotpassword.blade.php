@extends('partials.auth_partials')
@section('auth_content')
    <main class="auth-container">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header justify-content-center">
                            <img class="img-fluid login-logo mx-auto" src="{{ asset('assets') }}/assets/img/logo.png" alt="Logo Glints">
                        </div>
                        <div class="card-body">
                            <div class="small mb-3 text-muted">{{ __('Enter your email address and we will send you a link to reset your password.') }}</div>
                            <form>
                                <div class="form-group">
                                    <label class="small mb-1" for="email">{{ __('Email') }}</label>
                                    <input class="form-control" id="email" type="email" aria-describedby="email" placeholder="Enter email address" />
                                </div>
                                <a class="btn btn-primary" href="/resetpassword">{{ __('Submit') }}</a>
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
