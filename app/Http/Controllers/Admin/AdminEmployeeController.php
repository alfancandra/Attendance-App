<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminEmployeeController extends Controller {
    // Page Employee
    public function index() {
        return view('admin.employee');
    }
}
