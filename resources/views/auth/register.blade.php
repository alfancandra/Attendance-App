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
                            <form autocomplete="off">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="small mb-1" for="fullname">{{ __('Full Name') }}</label>
                                        <input class="form-control" id="fullname" type="text" placeholder="Enter your fullname" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="email">{{ __('Email') }}</label>
                                    <input class="form-control" id="email" type="email" aria-describedby="email" placeholder="Enter email address" />
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="password">{{ __('Password') }}</label>
                                            <input class="form-control" id="password" type="password" placeholder="Enter password" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="confirmPassword">{{ __('Confirm Password') }}</label>
                                            <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4 mb-0"><a class="btn btn-primary btn-block" href="/login">{{ __('Create Account') }}</a></div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <div class="small"><a href="/login">{{ __('Have an account? Go to login') }}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
