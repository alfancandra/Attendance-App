@extends('partials.error_partials')
@section('error_content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mt-4">
                        <img class="img-error p-4" src="{{ asset('assets') }}/assets/img/404-error.svg" alt="Error404" />
                        <p class="lead">URL not found!</p>
                        <a class="text-arrow-icon" href="javascript:history.go(-1)">
                            <i class="ml-0 mr-1" data-feather="arrow-left"></i>
                            Back to previous page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection