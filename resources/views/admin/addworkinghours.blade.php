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
                    <form autocomplete="off" method="POST" action="{{ route('adm.post_hours') }}"">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="name">{{ __('Day') }}</label>
                                    <select class="form-control" id="name" name="name">
                                        <option selected disabled hidden>-- Select Day --</option>
                                        <option value="0">Sunday</option>
                                        <option value="1">Monday</option>
                                        <option value="2">Tuesday</option>
                                        <option value="3">Wednesday</option>
                                        <option value="4">Thursday</option>
                                        <option value="5">Friday</option>
                                        <option value="6">Saturday</option>
                                    </select>
                                    @if(session()->has('name'))<p class="text-danger">{{session('name')}}</p>@endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="check_in">{{ __('Check In Time') }}</label>
                                    <input class="form-control" id="check_in" name="check_in" type="time" placeholder="Enter check in time" required/>
                                    @if(session()->has('check_in'))<p class="text-danger">{{session('check_in')}}</p>@endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="check_out">{{ __('Check Out Time') }}</label>
                                    <input class="form-control" id="check_out" name="check_out" type="time" placeholder="Enter check out time" required/>
                                    @if(session()->has('check_out'))<p class="text-danger">{{session('check_out')}}</p>@endif
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