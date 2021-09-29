<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Office;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    // Page Dashboard
    
    public function index() {
        
        $now = Carbon::now()->toDateString();
        $office = Office::first();
        $attendance = Attendance::join('users','users.id','=','attendances.user_id')
        ->where('users.id',Auth::user()->id)
        ->whereDate('check_in',$now)->first();

        // $startTime = Carbon::parse($attendance->check_in);
        // $endTime = Carbon::now();

        // $totalDuration =  $startTime->diff($endTime)->format('%S');
        // dd($totalDuration);
        // dd($attendance->check_in);
        return view('user.dashboard',compact('attendance','office'));
    }
}
