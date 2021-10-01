@extends('partials.user_partials')
@section('user_content')
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
                    {{ __('Attendace Report') }}
                </div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="userreport_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Check In Time') }}</th>
                                    <th>{{ __('Check Out Time') }}</th>
                                    <th>{{ __('Work Time') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;?>
                                @foreach($reports as $report)
                                <tr>
                                    <td>{{$report->created_at->format('d F Y')}}</td>
                                    <td>{{Carbon\Carbon::parse($report->check_in)->format('H:i:s')}}</td>
                                    <td>{{$report->check_out ? Carbon\Carbon::parse($report->check_out)->format('H:i:s') : null}}</td>
                                    <td>{{$durations[$i++]}}</td>
                                    {{-- 0:absent, 1:present, 2:late --}}
                                    <td>
                                        @if ($report->absent==0)
                                            <div class="badge badge-danger badge-pil">Absent</div>
                                        @elseif ($report->absent==1)
                                            <div class="badge badge-primary badge-pil">Present</div>
                                        @elseif ($report->absent==2)
                                            <div class="badge badge-warning badge-pil">Late</div>
                                        @else
                                            <div class="badge badge-dark badge-pil">Undefined</div>
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
@push('after-script')
    <script>
        $(document).ready(function() {
            $('#userreport_table').DataTable();
        });
   </script>
@endpush