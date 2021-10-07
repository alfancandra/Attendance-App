@extends('partials.admin_partials')
@section('admin_content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="users"></i></div>
                                {{ __('Employee List') }}
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
                    <div id="alert" class="alert alert-success alert-block mb-2">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        {{ $message }}
                    </div>
                @endif
            </div>
        </header>
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    {{ __('Employee List') }}
                </div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="employee_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('No') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Fullname') }}</th>
                                    <th>{{ __('Registered Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datauser as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->created_at->format('d F Y H:i:s') }}</td>
                                        <td>
                                            @if ($user->active==0)
                                                <div class="badge badge-danger badge-pil">Not Activated</div>
                                            @else
                                                <div class="badge badge-primary badge-pil">Active</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($user->email_verified_at) && $user->active == 0)
                                                <a href="{{ route('adm.accemployee', $user->id) }}" class="btn btn-datatable btn-icon btn-transparent-dark" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Approve"><i class="text-dark" data-feather="check"></i></a>
                                                <span data-toggle="modal" data-target="#rejectModal">
                                                    <a class="btn btn-datatable btn-icon btn-transparent-dark" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Reject"><i class="text-dark" data-feather="x"></i></a>
                                                </span>
                                            @else
                                                <span data-toggle="modal" data-target="#removeModal">
                                                    <a class="btn btn-datatable btn-icon btn-transparent-dark" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Remove"><i class="text-dark" data-feather="trash"></i></a>
                                                </span>
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

        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Reject User Confirmation</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to reject this user?</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('adm.rejectemployee', $user->id) }}" class="btn btn-danger" id="stop">Yes</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removeModalLabel">Remove User Confirmation</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to remove this user?</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('adm.destroyemployee', $user->id) }}" class="btn btn-danger" id="stop">Yes</a>
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
            $('#employee_table').DataTable();
        });
    </script>
@endpush