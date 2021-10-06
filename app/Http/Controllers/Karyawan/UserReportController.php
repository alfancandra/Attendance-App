<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller {
    /**
     * Show user report page
     */
    public function index() {
        $reports = Attendance::where(['user_id' => Auth::user()->id])->get();
        
        $durations = [];
        $i=0;
        foreach ($reports as $r) { // 7281 -> 2:21
            $hours = (int) $r->updated_at->diffInHours($r->created_at);
            $minutes = (int) $r->updated_at->diffInMinutes($r->created_at) - ($hours * 60); // 121 - 120 = 1
            $seconds = (int) $r->updated_at->diffInSeconds($r->created_at)%60;
            $durations[$i++] = (string) ($hours) . ":" . (string) ($minutes) . ":"  . (string) ($seconds);
        }

        return view('user.report', compact(['reports', 'durations']));
    }
}
