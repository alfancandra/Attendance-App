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
                                {{ __('Working Hours') }}
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
                    <a class="btn btn-primary btn-sm shadow-sm" href="addworkinghours">
                        Add Data
                    </a>
                </div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="report_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="50">{{ __('No') }}</th>
                                    <th>{{ __('Day') }}</th>
                                    <th>{{ __('Check In Time') }}</th>
                                    <th>{{ __('Check Out Time') }}</th>
                                    <th width="150" class="text-center">{{ __('Status') }}</th>
                                    <th width="200" class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datahours as $hours)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $hours->name }}</td>
                                        <td>{{ $hours->check_in }}</td>
                                        <td>{{ $hours->check_out }}</td>
                                        <td class="text-center">
                                            {{-- 0 = Deactive --}}
                                            @if ($hours->active==0)
                                                <div class="badge badge-danger badge-pil text-sm py-2 px-2">Deactive</div>
                                            @else
                                                <div class="badge badge-primary badge-pil text-sm py-2 px-2">Active</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{-- 0 = Deactive --}}
                                            @if ($hours->active == 0)
                                                <a onclick="return confirm('Are you sure to activate this working hour?')" href="{{ route('adm.activatehours', $hours->id) }}" class="btn btn-sm btn-active text-sm"><i class="fab fa fa-check mr-1" aria-hidden="true"></i>Activate</a>
                                            @else
                                                <a onclick="return confirm('Are you sure to deactivate this working hour?')" href="{{ route('adm.deactivatehours', $hours->id) }}" class="btn btn-sm btn-deactive text-sm"><i class="fab fa fa-times mr-1" aria-hidden="true"></i>Deactivate</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection