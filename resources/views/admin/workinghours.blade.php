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
                @if ($message = Session::get('success'))
                    <div id="alert" class="alert alert-success alert-block mb-2">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        {{ $message }}
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div id="alert" class="alert alert-danger alert-block mb-2">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        {{ $message }}
                    </div>
                @endif
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
                        <table class="table table-bordered table-hover" id="hours_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="50">{{ __('No') }}</th>
                                    <th>{{ __('Day') }}</th>
                                    <th>{{ __('Check In Time') }}</th>
                                    <th>{{ __('Check Out Time') }}</th>
                                    <th width="150" class="text-center">{{ __('Status') }}</th>
                                    <th width="150" class="text-center">{{ __('Action') }}</th>
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
                                            @if ($hours->active==0)
                                                <div class="badge badge-danger badge-pil">Deactive</div>
                                            @elseif ($hours->active==1)
                                                <div class="badge badge-primary badge-pil">Active</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($hours->active == 0)
                                                <span data-toggle="modal" data-target="#activateModal">
                                                    <a class="btn btn-datatable btn-icon btn-transparent-dark"  data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Activate">
                                                        <i class="text-dark" data-feather="check"></i>
                                                    </a>
                                                </span>
                                            @elseif ($hours->active == 1)
                                                <span data-toggle="modal" data-target="#deactivateModal">
                                                    <a class="btn btn-datatable btn-icon btn-transparent-dark" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Deactivate">
                                                        <i class="text-dark" data-feather="x"></i>
                                                    </a>
                                                </span>
                                            @endif
                                            <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ route('adm.editworkinghours', $hours->id) }}" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Edit">
                                                <i class="text-dark" data-feather="edit"></i>
                                            </a>
                                            <span data-toggle="modal" data-target="#deleteModal">
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Remove">
                                                    <i class="text-dark" data-feather="trash"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="activateModalLabel">Activate Confirmation</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Are you sure want to activate this working hour?</div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                            <a href="{{ route('adm.activatehours', $hours->id) }}" class="btn btn-danger" id="stop">Yes</a>
                        </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deactivateModalLabel">Deactivate Confirmation</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure want to deactivate this working hour?</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('adm.deactivatehours', $hours->id) }}" class="btn btn-danger" id="stop">Yes</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure want to delete this working hour?</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('adm.destroyworkinghours', $hours->id) }}" class="btn btn-danger" id="stop">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('after-script')
    <script>
       var timeout = 3000;
       $('#alert').delay(timeout).fadeOut(300);
       $(document).ready(function() {
            $('#hours_table').DataTable();
        });
   </script>
@endpush