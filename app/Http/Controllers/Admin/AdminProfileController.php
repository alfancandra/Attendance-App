<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller {
    // Admin Profile Page
    public function index() {
        return view('admin.profile');
    }

    // Update Function Admin Profile
    public function updateadminprofile(Request $request) {
        // Form Validation
        $validator = Validator::make($request->all(),[
            'password' => ['min:8', 'max:16']
        ]);

        try {
            $user = User::where('id',Auth::user()->id)->first();
            if (!empty($request->name)){
                // Get Admin Name
                $user->name = $request->name;
            }

            if (!empty($request->current_password)){
                if ($validator->fails()) {
                    return redirect() -> route('adm.adminprofile') -> with(['password' => 'The password must be at least 8 characters.']);
                }

                if (Hash::check($request->current_password, $user->password)) {
                    if($request->password == $request->password_confirmation) {
                        // Get Admin Password
                        $user->password = Hash::make($request->password);
                    } else {
                        return redirect() -> route('adm.adminprofile')->with(['password' => 'Password confirmation not same!']);
                    }
                } else {
                    return redirect() -> route('adm.adminprofile')->with(['current_password' => 'Wrong Password!']);
                }
            }

            $user->update();

            return redirect()->route('adm.adminprofile')->with(['success' => 'Success updated admin profile!']);
        } catch (QueryException $e) {
            return redirect()->route('adm.adminprofile')->with(['error' => $e->errorInfo]);
        }

    }
}
