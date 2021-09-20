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
                            <form autocomplete="off" action="{{route('newpassword', ['userToken' => $token, 'timestamp' => $timestamp])}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="small mb-1" for="password">{{ __('Password') }}</label>
                                        <input class="form-control" id="password" name="password" type="password" maxlength="16" placeholder="Enter password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="confirmPassword">{{ __('Confirm Password') }}</label>
                                    <input class="form-control" id="confirmPassword" name="password_confirmation" type="password" maxlength="16" placeholder="Confirm password" />
                                </div>
                                <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" type="submit">{{ __('Create Password') }}</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
