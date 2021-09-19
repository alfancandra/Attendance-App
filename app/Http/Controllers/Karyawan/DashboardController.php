<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    // Page Dashboard
    public function index() {
        return view('user.dashboard');
    }
}
