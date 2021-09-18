<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminEmployeeController extends Controller {
    public function index() {
        return view('admin.employee');
    }
}
