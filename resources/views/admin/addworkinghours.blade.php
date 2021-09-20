@extends('partials.admin_partials')
@section('admin_content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="clock"></i></div>
                                {{ __('Add Working Hours') }}
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
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="day">{{ __('Day') }}</label>
                                    <input class="form-control" id="day" name="day" type="text" maxlength="9" placeholder="Enter day" required/>
                                    @if(session()->has('day'))<p class="text-danger">{{session('day')}}</p>@endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="check_in_time">{{ __('Check In Time') }}</label>
                                    <input class="form-control" id="check_in_time" name="check_in_time" type="text" placeholder="Enter check in time" required/>
                                    @if(session()->has('check_in_time'))<p class="text-danger">{{session('check_in_time')}}</p>@endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="check_out_time">{{ __('Check Out Time') }}</label>
                                    <input class="form-control" id="check_out_time" name="check_out_time" type="text" placeholder="Enter check out time" required/>
                                    @if(session()->has('check_out_time'))<p class="text-danger">{{session('check_out_time')}}</p>@endif
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