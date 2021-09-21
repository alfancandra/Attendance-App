@extends('partials.admin_partials')
@section('admin_content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="home"></i></div>
                                {{ __('Office Profile') }}
                            </h1>
                            <div class="page-header-subtitle">{{ __('Employee Attendance App') }}</div>
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
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="officename">{{ __('Office Name') }}</label>
                                    <input class="form-control" id="officename" name="officename" type="text" maxlength="9" placeholder="Office Name" required/>
                                    @if(session()->has('officename'))<p class="text-danger">{{session('officename')}}</p>@endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="longitude">{{ __('Longitude') }}</label>
                                    <input class="form-control" id="longitude" name="longitude" type="text" placeholder="Longitude" required/>
                                    @if(session()->has('longitude'))<p class="text-danger">{{session('longitude')}}</p>@endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="latitude">{{ __('Latitude') }}</label>
                                    <input class="form-control" id="latitude" name="latitude" type="text" placeholder="Latitude" required/>
                                    @if(session()->has('latitude'))<p class="text-danger">{{session('latitude')}}</p>@endif
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <button class="btn btn-primary lift" type="submit">Save</button>
                        <a class="btn btn-danger lift" href="javascript:history.go(-1)">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection