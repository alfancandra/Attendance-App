<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\WorkingHour;

use Illuminate\Http\Request;

class AdminWorkingHoursController extends Controller {
    // Page Working Hours
    public function index() {
        $datahours = WorkingHour::get();

        return view('admin.workinghours', compact('datahours'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    // Activate Working Hours
    public function activate($id) {
        $datahours = WorkingHour::where('id', $id)->first();
        $datahours->active = 1;
        $datahours->save();
        return redirect()->route('adm.workinghours')->with(['success' => 'Success activate working hours!']);
    }

    public function deactivate($id) {
        $datahours = WorkingHour::where('id', $id)->first();
        $datahours->active = 0;
        $datahours->save();
        return redirect()->route('adm.workinghours')->with(['success' => 'Success deactivate working hour!']);
    }
}
