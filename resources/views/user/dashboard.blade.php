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
            <br>
            <h5 class="text-primary">you are <span id="location" class="badge badge-primary"></span> meters from the office</h5>
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
                                            $waktu='00:00:00';
                                            $officeLat = $office->langitude;
                                            $officeLon = $office->longitude;
                                        @endphp
                                    
                                        <script>
                                            var latitude, longitude, gg;
                                            
                                            localStorage.removeItem('startTime');
                                            localStorage.removeItem('checkoutTime');

                                            $(document).ready(function(){
                                                if (navigator.geolocation) {
                                                    navigator.geolocation.getCurrentPosition(handle_geolocation_query,handle_errors);
                                                } else {
                                                    alert('Device probably not ready.');
                                                }
                                            });
                                            function handle_errors(error) {  
                                                // error handling here
                                            }
                                            function handle_geolocation_query(position){  
                                                var officeLat = {{ $office->langitude }};
                                                var officeLon = {{ $office->longitude }};
                                                latitude = (position.coords.latitude);
                                                longitude = (position.coords.longitude);
                                                gg = calculateDistance(latitude,longitude,officeLat,officeLon);
                                                console.log(latitude,longitude);
                                                document.getElementById("location").innerHTML = parseInt(gg);
                                            }
                                            function onPositionReady() {
                                                alert(latitude, longitude);
                                                // proceed
                                            }
                                        </script>
                                        
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
                                </div>
                            </div>

                            <div class="justify-content-between">
                                @if(empty($attendance) && Carbon\Carbon::now()->format('H:i:s') <= $workinghour->check_out)
                                    <a class="btn btn-primary lift p-3 checkin-button" id="start" data-href="{{ route('usr.checkin',Auth::user()->id) }}">
                                        {{ __('Check In') }}
                                    </a>
                                    <a class="btn btn-danger lift p-3 disabled" id="checkout" onclick="confirm_modal()" data-toggle="modal" data-target="#modalCheckout">
                                        {{ __("Check Out") }}
                                    </a>
                                @elseif(!empty($attendance->check_out) && !empty($attendance->check_in))
                                    <a class="btn btn-primary lift p-3 disabled" id="start">
                                        {{ __('Check In') }}
                                    </a>
                                    <a class="btn btn-danger lift p-3 disabled" id="checkout" onclick="confirm_modal()" data-toggle="modal" data-target="#modalCheckout">
                                        {{ __("Check Out") }}
                                    </a>
                                @elseif(!empty($attendance->check_in))
                                    <a class="btn btn-primary lift p-3 disabled" id="start" href="{{ route('usr.checkin',Auth::user()->id) }}">
                                        {{ __('Check In') }}
                                    </a>
                                    <a class="btn btn-danger lift p-3" data-toggle="modal" data-target="#modalCheckout">
                                        {{ __("Check Out") }}
                                    </a>
                                
                                @endif
                            </div>
                            <script>
                                $('#start').click(function () {
                                    if(gg <= 10){
                                        window.location.href = $(this).data('href');
                                    }else{
                                        $('#locationModal').modal('show');
                                    }

                                    $('#close').click(function() {
                                        location.reload();
                                    });
                                });  
                            </script>
                        </div>
                        <div class="col justify-content-center align-items-center d-none d-lg-block">
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
        </div>

        <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="locationModalLabel">Location Alert</h5>
                        <button class="close" id="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Your location is too far, the maximum radius is 100 meters from office.</p>
                    </div>
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
    var startTime;
    var timerr;

    function checkin(){
        // x = setInterval(timer, 10);
        // $('#start').attr("disabled",true);
        if (localStorage.getItem('startTime')) {
            startTime = parseInt(localStorage.getItem('startTime'));
        }else{
            startTime = Date.now();
            localStorage.setItem('startTime', startTime);
        }
        timerr = setInterval(timer, 1000);
    }

    function checkout(){
        stop();
        if (localStorage.getItem('checkoutTime')) {
            var checkoutTime = localStorage.getItem('checkoutTime');
        } else {
            var checkoutTime = Date.now();
            localStorage.setItem('checkoutTime', checkoutTime);
        }

        var time2 = localStorage.getItem('startTime');
        var timeElapsed = new Date(checkoutTime - time2);
        var hours = timeElapsed.getUTCHours();
        var minutes = timeElapsed.getUTCMinutes();
        var secs = timeElapsed.getUTCSeconds();

        document.getElementById("sec").innerHTML = checkTime(secs);
        document.getElementById("min").innerHTML = checkTime(minutes);
        document.getElementById("hour").innerHTML = checkTime(hours);
    }
    
    /* Stop */
    function stop() {
        $('#start').removeAttr("disabled");
        document.getElementById("text").innerHTML = "You've checked out!";
        clearInterval(timerr);
    }

    /* Output variable End */
    function timer() {
    /* Main Timer */
        var currtime = Date.now();
        var timeElapsed = new Date(currtime - startTime);
        var hours = timeElapsed.getUTCHours();
        var minutes = timeElapsed.getUTCMinutes();
        var secs = timeElapsed.getUTCSeconds();

        document.getElementById("sec").innerHTML = checkTime(secs);
        document.getElementById("min").innerHTML = checkTime(minutes);
        document.getElementById("hour").innerHTML = checkTime(hours);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    // Calculate Distance
    function calculateDistance(lat1, long1, lat2, long2)
    {    

        //radians
        lat1 = (lat1 * 2.0 * Math.PI) / 60.0 / 360.0;      
        long1 = (long1 * 2.0 * Math.PI) / 60.0 / 360.0;    
        lat2 = (lat2 * 2.0 * Math.PI) / 60.0 / 360.0;   
        long2 = (long2 * 2.0 * Math.PI) / 60.0 / 360.0;       


        // use to different earth axis length    
        var a = 6378137.0;        // Earth Major Axis (WGS84)    
        var b = 6356752.3142;     // Minor Axis    
        var f = (a-b) / a;        // "Flattening"    
        var e = 2.0*f - f*f;      // "Eccentricity"      

        var beta = (a / Math.sqrt( 1.0 - e * Math.sin( lat1 ) * Math.sin( lat1 )));    
        var cos = Math.cos( lat1 );    
        var x = beta * cos * Math.cos( long1 );    
        var y = beta * cos * Math.sin( long1 );    
        var z = beta * ( 1 - e ) * Math.sin( lat1 );      

        beta = ( a / Math.sqrt( 1.0 -  e * Math.sin( lat2 ) * Math.sin( lat2 )));    
        cos = Math.cos( lat2 );   
        x -= (beta * cos * Math.cos( long2 ));    
        y -= (beta * cos * Math.sin( long2 ));    
        z -= (beta * (1 - e) * Math.sin( lat2 ));       
        
        return (Math.sqrt( (x*x) + (y*y) + (z*z) )/1000)*10000;
        }

</script>
