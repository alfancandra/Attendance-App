<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller {
    public function index() {
        return view('user.user_profile');
    }
}