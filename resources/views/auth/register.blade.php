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
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block mb-3">
                                    <button type="button" class="close" data-dismiss="alert">×</button>    
                                    {{ $message }}
                                </div>
                            @endif
                            <form autocomplete="off" method="POST" action="{{ route('post_register') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="small mb-1" for="name">{{ __('Full Name') }}</label>
                                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter your fullname" value="{{ old('name') }}" />
                                        @if ($errors->has('name'))<small class="text-danger" role="alert">{{ $errors->first('name') }}</small>@endif
                                    </div>
                                    @if(session()->has('emailTerpakai'))<p class="text-danger">{{session('emailTerpakai')}}</p>@endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="email">{{ __('Email') }}</label>
                                    <input class="form-control" id="email" name="email" type="email" aria-describedby="email" placeholder="Enter email address" value="{{ old('email') }}" />
                                    @if ($errors->has('email'))<small class="text-danger" role="alert">{{ $errors->first('email') }}</small>@endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="password">{{ __('Password') }}</label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Enter password" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="password">{{ __('Confirm Password') }}</label>
                                    <input class="form-control" id="password" name="password_confirmation" type="password" placeholder="Enter password" />
                                    @if ($errors->has('password'))<small class="text-danger" role="alert">{{ $errors->first('password') }}</small>@endif
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <button type="submit" class="btn btn-primary btn-block lift">{{ __('Create Account') }}</button>
                                </div>
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