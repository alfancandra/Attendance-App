@extends('partials.user_partials')
@section('user_content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                {{ __('User Profile') }}
                            </h1>
                            <div class="page-header-subtitle">{{ __('Employee Attendance App') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="" id="upload-image" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="col-xxl-12 col-xl-12 mb-3">
                            <div class="text-center">
                                <img class="img-account-profile mb-2" id="preview-image-before-upload" name="preview-image-before-upload" src="{{ asset('assets') }}/assets/img/user.png" alt="Preview Image">
                                <div class="small font-italic text-muted mb-4">{{ __('JPG or PNG, no more than 2 MB') }}</div>
                                <label class="btn btn-secondary lift" type="button" for="image">{{ __('Choose Photo') }}</label>
                                <input id="image" name="image" type="file" accept="image/x-png,image/jpeg" style="display: none;" required>
                                @if(session()->has('btn_image'))<p class="text-danger">{{session('btn_image')}}</p>@endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="email">{{ __('Email') }}</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email address" disabled/>
                                    @if(session()->has('email'))<p class="text-danger">{{session('email')}}</p>@endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="name">{{ __('Fullname') }}</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter your fullname" required/>
                                    @if(session()->has('name'))<p class="text-danger">{{session('name')}}</p>@endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="password">{{ __('Password') }}</label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password"/>
                                    @if(session()->has('password'))<p class="text-danger">{{session('password')}}</p>@endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="name">{{ __('Confirm Password') }}</label>
                                    <input class="form-control" id="password" name="password_confirmation" type="password" placeholder="Confirm your password" required/>
                                    @if(session()->has('name'))<p class="text-danger">{{session('name')}}</p>@endif
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <button class="btn btn-primary lift" type="submit">Save</button>
                        <a class="btn btn-danger lift" href="/dashboard">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function (e) {
        $('#image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>