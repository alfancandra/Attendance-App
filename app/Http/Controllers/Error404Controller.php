<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Error404Controller extends Controller {
    /**
     * Show error 404 page
     */
    public function index() {
        return view('error.404');
    }
}
