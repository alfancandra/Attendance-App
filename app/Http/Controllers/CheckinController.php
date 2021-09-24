<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CheckinController extends Controller
{
    public function checkin(Request $request){
      $id = auth::user()->id;
      $attendance = Attendance::create([
        'user_id' => $id,
        'check_in' => Carbon::now(),
        'check_out' => null,
        'absent' => 1,
        'working_hour_id' =>1
      ]);
      return redirect()->route('usr.dashboard');
    }

    public function checkout(Request $request){
      $id = auth::user()->id;
      // $attendance = Attendance::update([
      //   'check_out' => Carbon::now()
      // ])->where(['check_out' => null]);
      // $attendance = Attendance::where('check_out', null)->update('check_out',(null => Carbon::now()) );
      Attendance::where('check_out', null)
      ->where('user_id',$id)
      ->update(['check_out' => Carbon::now()]);
      return redirect()->route('usr.dashboard');
    }
}