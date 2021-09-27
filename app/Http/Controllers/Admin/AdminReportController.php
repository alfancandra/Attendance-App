<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminReportController extends Controller {
    // 0 = absent
    // 1 = masuk
    // 2 = late
    // Page Report
    public function index() {
        $absent = DB::table('attendances')
        ->join('users','users.id','=','attendances.user_id')
        ->select('attendances.absent','users.email','attendances.created_at','attendances.user_id','users.name',DB::raw('count(absent) as total'))
        ->havingRaw('count(attendances.absent) >= 3',[2500] )
        ->groupBy('attendances.user_id')
        ->get();

        $reports = Attendance::join('users','users.id','=','attendances.user_id')
        ->select('users.name','attendances.check_in','attendances.check_out','attendances.absent','attendances.created_at')
        ->get();

        $durations = [];
        $i=0;
        foreach ($reports as $r){ // 7281 -> 2:21
            $checkin = new Carbon($r->check_in);
            $checkout= new Carbon($r->check_out);
            $hours = (int) $checkout->diffInHours($checkin);
            $minutes = (int) $checkout->diffInMinutes($checkin) - ($hours * 60); // 121 - 120 = 1
            $seconds = (int) $checkout->diffInSeconds($checkin)%60;
            $durations[$i++] = (string) ($hours) . ":" . (string) ($minutes) . ":"  . (string) ($seconds);
        }
        
        return view('admin.report',compact('absent','reports','durations'));
    }

}