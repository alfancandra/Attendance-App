@extends('partials.user_partials')
@section('user_content')
    <main>
        <div class="container">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mt-5">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0">{{ __('Welcome,') }} {{ Auth::user()->name }}</h1>
                    <div class="small">
                        <span id="day" class="font-weight-500 text-primary"></span>
                        &middot; <span id="date"></span> &middot; <span id="time"></span>
                    </div>
                </div>
            </div>
            <div class="card card-waves mb-4 mt-5">
                <div class="card-body p-5">
                    <div class="row align-items-center justify-content-between">
                        <div class="col text-center">
                            <h2 id="text" class="text-primary">You're not check in yet!</h2>
                            <h1 class="text-xl py-4">
                                <span id="hour">00</span> :
                                <span id="min">00</span> :
                                <span id="sec">00</span>
                                <span hidden id="milisec">00</span>
                            </h1>
                            <div class="justify-content-between">                
                                <div>
                                    <!-- <button class="btn btn-primary lift p-3" onclick="start()" id="start">{{ __('Check In') }}</button> -->
                                    <a class="btn btn-primary lift p-3" href="{{ route('usr.checkin', Auth::user()->id) }}">{{ __('Check In') }}</a>
                                    <!-- <button class="btn btn-danger lift p-3" onclick="stop()" id="stop">{{ __("Check Out") }}</button> -->
                                    <a class="btn btn-danger lift p-3"  href="{{ route('usr.checkout', Auth::user()->id) }}" onclick="confirm_modal() data-toggle="modal" data-target="#modalCheckout">
                                    {{ __("Check Out") }}</a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col justify-content-center align-items-center d-none d-lg-block">
                            <img class="img-dashboard px-xl-4" src="{{ asset('assets') }}/assets/img/illustration.svg" alt="Illustration">
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
                        <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="stop()" id="stop">Yes</button>
                    </div>
                </div>
            </div>
    </main>
@endsection

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

    /* Start */
    function start() {
        $("#start").attr("disabled", true);
        document.getElementById("text").innerHTML = "Enjoy your work!";
        x = setInterval(timer, 10);
    }

    /* Stop */
    function stop() {
        $('#start').removeAttr("disabled");
        document.getElementById("text").innerHTML = "You've checked out!";
        clearInterval(x);
    }

    /* holds incrementing value */
    var milisec = 0;
    var sec = 0;
    var min = 0;
    var hour = 0;

    /* Contains and outputs returned value of  function checkTime */
    var miliSecOut = 0;
    var secOut = 0;
    var minOut = 0;
    var hourOut = 0;

    /* Output variable End */
    function timer() {
    /* Main Timer */
        miliSecOut = checkTime(milisec);
        secOut = checkTime(sec);
        minOut = checkTime(min);
        hourOut = checkTime(hour);
        milisec = ++milisec;
        if (milisec === 100) {
            milisec = 0;
            sec = ++sec;
        }
        if (sec == 60) {
            min = ++min;
            sec = 0;
        }
        if (min == 60) {
            min = 0;
            hour = ++hour;
        }
        document.getElementById("milisec").innerHTML = miliSecOut;
        document.getElementById("sec").innerHTML = secOut;
        document.getElementById("min").innerHTML = minOut;
        document.getElementById("hour").innerHTML = hourOut;
    }


    /* Adds 0 when value is <10 */
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
</script>
