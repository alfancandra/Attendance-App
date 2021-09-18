<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserReportController extends Controller {
    public function index() {
        return view('user.report');
    }
}
