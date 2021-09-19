<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserReportController extends Controller {
    // Page User Report
    public function index() {
        return view('user.report');
    }
}
