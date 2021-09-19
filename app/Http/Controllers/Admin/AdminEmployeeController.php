<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminEmployeeController extends Controller {
    // Page Employee
    public function index() {
        $datauser = User::where('role_id',0);
        return view('admin.employee',compact('datauser'))
        ->with('i',(request()->input('page',1)-1)*5);
    }
}
