<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Office;
use App\Models\WorkingHour;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    /**
     * Show user dashboard page
     */
    public function index() {
        $daynow = Carbon::now()->format('l');
        $now = Carbon::now()->toDateString();
        $office = Office::first();
        $workinghour = WorkingHour::where('name',$daynow)->first();
        $attendance = Attendance::join('users','users.id','=','attendances.user_id')
        ->where('users.id',Auth::user()->id)
        ->whereDate('check_in',$now)->first();

        return view('user.dashboard',compact('attendance','office','workinghour'));
    }
}
