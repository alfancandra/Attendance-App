@extends('partials.user_partials')
@section('user_content')
        @php    
        if(!empty(Auth::user()->image)){
            $photo = '/img/photo/'.Auth::user()->image;
        }else{
            $photo = '/assets/assets/img/user.png';
        }
        @endphp
    <main>
        <div class="container">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mt-5">
                <div class="row ml-1 mr-4 mb-3 mb-sm-0">
                    <img class="img-photo-profile mb-1" src="{{ asset($photo) }}" alt="User photo profile">
                    <div class="ml-2">
                        <h2 class="mb-0">{{ __('Welcome,') }} {{ Auth::user()->name }}</h2>
                        <div class="small">
                            <span id="day" class="font-weight-500 text-primary"></span>
                            &middot; <span id="date"></span> &middot; <span id="time"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-waves mb-4 mt-5">
                <div class="card-body p-5">
                    <div class="row align-items-center justify-content-between">
                        <div class="col text-center">
                            @if($attendance)
                            <h2 id="text" class="text-primary">Enjoy Your Work!</h2>
                            @else
                            <h2 id="text" class="text-primary">You're not check in yet!</h2>
                            @endif
                            <h1 class="text-xl py-4">
                                <span id="hour">00</span> :
                                <span id="min">00</span> :
                                <span id="sec">00</span>
                                <span hidden id="milisec">00</span>
                            </h1>
                            <div class="justify-content-between">                
                                <div>

                            {{-- If Attendance is Null, just init variable timer --}}
                            @if(empty($attendance))
                                @php
                                    $checkoutTime='00:00:00';
                                    $waktu='00:00:00'
                                @endphp
                            {{-- If Attendance checkout row is null, 
                                init variable checkin from database & Init variable checkout to null --}}
                            @elseif(empty($attendance->check_out))
                                @php
                                    $waktu=$attendance->check_in;
                                    $checkoutTime='00:00:00';
                                @endphp
                            <script type="text/javascript">
                                checkin()
                            </script>
                            @endif

                            {{-- If Attendance checkout row is not null, 
                                init variable checkin from database & Init variable checkout from database --}}
                            @if(!empty($attendance->check_out))
                                @php
                                    $waktu=$attendance->check_in;
                                    $checkoutTime=$attendance->check_out;
                                @endphp
                            <script type="text/javascript">
                                checkout()
                            </script>
                            @endif

                            <div class="justify-content-between">
                                {{-- <button class="btn btn-primary lift p-3" onclick="start()" id="start">{{ __('Check In') }}</button> --}}
                                @if(empty($attendance))
                                <a class="btn btn-primary lift p-3" id="start" href="{{ route('usr.checkin',Auth::user()->id) }}">{{ __('Check In') }}</a>
                                <a class="btn btn-danger lift p-3 disabled" id="checkout" onclick="confirm_modal()" data-toggle="modal" data-target="#modalCheckout">
                                    {{ __("Check Out") }}</a>
                                @elseif(!empty($attendance->check_out))
                                <a class="btn btn-primary lift p-3 disabled" id="start" href="{{ route('usr.checkin',Auth::user()->id) }}">{{ __('Check In') }}</a>
                                <a class="btn btn-danger lift p-3 disabled" data-toggle="modal" data-target="#modalCheckout">
                                    {{ __("Check Out") }}</a>
                                @else
                                <a class="btn btn-primary lift p-3 disabled" id="start">{{ __('Check In') }}</a>
                                <a class="btn btn-danger lift p-3" id="checkout" onclick="confirm_modal()" data-toggle="modal" data-target="#modalCheckout">
                                    {{ __("Check Out") }}</a>
                                @endif
                                
                            </div>
                        </div>
                        <div class="col justify-content-center align-items-center">
                            <img class="img-dashboard" src="{{ asset('assets') }}/assets/img/illustration.svg" alt="Illustration">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout Confirmation</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure want to checkout?</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('usr.checkout',Auth::user()->id) }}" class="btn btn-danger" id="stop">Yes</a>
                    </div>
                </div>
            </div>
    </main>
@endsection
<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    
    function clockTick() {
        var d = new Date();
        var day = d.getDay();
        var date = d.getDate();
        var year = d.getFullYear();
        var month = d.getMonth();
        var dayArr = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var monthArr = ["January", "February", "March", "April", "Mei", "June", "July", "August", "September", "October", "November", "December"];
        day = dayArr[day];
        month = monthArr[month];
        document.getElementById("day").innerHTML = day;
        document.getElementById("date").innerHTML = date + " " + month + " " + year;

        var t = new Date();
        var hour = t.getHours();
        var minute = t.getMinutes();
        var second = t.getSeconds();
        document.getElementById("time").innerHTML = hour + ":" + minute + ":" + second + " WIB";
    }
    setInterval(clockTick, 1000);

    // Stopwatch
    var x;

    function checkin(){
        x = setInterval(timer, 10);
        $('#start').attr("disabled",true);
    }

    function checkout(){
        document.getElementById("text").innerHTML = "You've checked out!";
        var d = new Date();
        var hh = {{ date('H', strtotime($waktu)) }};
        var mm = {{ date('i', strtotime($waktu)) }};
        var ss = {{ date('i', strtotime($waktu)) }};
        var hournow = {{ date('H', strtotime($checkoutTime)) }};
        var minutenow = {{ date('i', strtotime($checkoutTime)) }};
        var secondnow = d.getSeconds();
        var diff = hournow - hh;
        var diffminute = minutenow - mm;
        document.getElementById("min").innerHTML = convert_positive(diffminute);
        document.getElementById("hour").innerHTML = convert_positive(diff);
    }
    
    /* Stop */
    function stop() {
        $('#start').removeAttr("disabled");
        document.getElementById("text").innerHTML = "You've checked out!";
        clearInterval(x);
    }

    function convert_positive(a) {
        // Check the number is negative
        if (a < 0) {
            // Multiply number with -1
            // to make it positive
            a = a * -1;
        }
        // Return the positive number
        return a;
    }

    /* Output variable End */
    function timer() {
    /* Main Timer */
        var d = new Date();
        var hh = {{ date('H', strtotime($waktu)) }};
        var mm = {{ date('i', strtotime($waktu)) }};
        var ss = {{ date('i', strtotime($waktu)) }};
        var hournow = d.getHours();
        var minutenow = d.getMinutes();
        var secondnow = d.getSeconds();
        var diff = hournow - hh;
        var diffminute = minutenow - mm;
        document.getElementById("sec").innerHTML = secondnow;
        document.getElementById("min").innerHTML = convert_positive(diffminute);
        document.getElementById("hour").innerHTML = convert_positive(diff);
    }


    /* Adds 0 when value is <10 */
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    
</script>
