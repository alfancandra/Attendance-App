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

    // Report Page
    public function index() {
        $absent = DB::table('absents')
        ->join('users','users.id','=','absents.user_id')
        ->select('users.email','absents.created_at','absents.id as idabsent','absents.user_id','users.name',DB::raw('count(absents.id) as total'),DB::raw('YEAR(absents.created_at) year, MONTH(absents.created_at) month'),'absents.created_at as monthyear')
        ->havingRaw('count(absents.id) >= 3',[2500] )
        ->groupBy('absents.user_id')
        ->groupby('month')
        ->get();

        $reports = Attendance::join('users','users.id','=','attendances.user_id')
            ->select('users.name','attendances.check_in','attendances.check_out','attendances.absent','attendances.created_at')
            ->get();

        $durations = [];
        $i=0;
        foreach ($reports as $r) { // 7281 -> 2:21
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