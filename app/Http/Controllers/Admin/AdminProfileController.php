<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller {

    public function index() {
        return view('admin.profile');
    }

    // Function To Update Profile Admin
    public function updateadminprofile(Request $request)
    {
        try{
            $user = User::where('id',Auth::user()->id)->first();
            if(!empty($request->name)){
                $user->name = $request->name;
            }

            if(Hash::check($request->current_password, $user->password)){
                if(!empty($request->password) && !empty($request->password_confirmation)){
                    if($request->password == $request->password_confirmation){
                        $user->password = Hash::make($request->password);
                    }else{
                        return redirect() -> route('adm.adminprofile') -> with(['password' => 'Password confirmation not same!']);
                    }
                }
            }else{
                return redirect() -> route('adm.adminprofile') -> with(['current_password' => 'Wrong Password!']);
            }

            if(!empty($request->image)) {
                $resource = $request->file('image');
                $name = uniqid() . '_' . time(). '.' .$resource->getClientOriginalName();
                $resource->move(public_path().'/img/photo/', $name);  
                $user->image = $name;
            }
            $user->update();
            return redirect() -> route('adm.adminprofile') -> with(['error' => 'Password confirmation Not same!']);
        }catch(QueryException $e){
            return redirect() -> route('adm.adminprofile') -> with(['error' => $e->errorInfo]);
        }

    }
}
