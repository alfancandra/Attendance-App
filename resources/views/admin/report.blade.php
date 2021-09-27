@extends('partials.admin_partials')
@section('admin_content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="bar-chart-2"></i></div>
                                {{ __('Report') }}
                            </h1>
                            <div class="page-header-subtitle">{{ __('Employee Attendance App') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    {{ __('Absent More Than 3 Days') }}
                </div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="absent_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Employee') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Absent Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    {{ __('Attendace Report') }}
                </div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="report_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Employee') }}</th>
                                    <th>{{ __('Check In Time') }}</th>
                                    <th>{{ __('Check Out Time') }}</th>
                                    <th>{{ __('Work Time') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    {{-- Delete this below td tag and uncomment line 74-84
                                        if finish get report data for Admin --}}
                                    <td></td>
                                    {{-- 0:absent, 1:present, 2:late --}}
                                    {{-- <td>
                                        @if ($report->absent==0)
                                            <div class="badge badge-danger badge-pil">Absent</div>
                                        @elseif ($report->absent==1)
                                            <div class="badge badge-primary badge-pil">Present</div>
                                        @elseif ($report->absent==2)
                                            <div class="badge badge-warning badge-pil">Late</div>
                                        @else
                                            <div class="badge badge-dark badge-pil">Undefined</div>
                                        @endif
                                    </td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection