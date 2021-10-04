<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Attendance;
use App\Models\WorkingHour;
use App\Models\User;
use App\Models\Absent;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('attendance:absent',function(){
    
    $getAlluser = User::select('id','name')->whereNotIn('id',function($query){
        $query->select('user_id')->whereDate('check_in',date('Y-m-d'))->from('attendances');
    })->get();
    foreach($getAlluser as $user){
        Absent::create([
            'user_id' => $user->id,
        ]);
    }

    // Attendance::where('id',49)->delete();
})->purpose('Absent All user');
