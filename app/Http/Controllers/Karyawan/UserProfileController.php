<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller {
    public function index() {
        return view('user.user_profile');
    }

    public function updateprofile(Request $request)
    {
        try{
            $user = User::where('id',Auth::user()->id)->first();
            if(!empty($request->name)){
                $user->name = $request->name;
            }
            if(!empty($request->password) && !empty($request->password_confirmation)){
                if($request->password == $request->password_confirmation){
                    $user->password = Hash::make($request->password);
                }else{
                    return redirect() -> route('usr.profile') -> with(['password' => 'Password confirmation Not same!']);
                }
            }
            if(!empty($request->image)) {
                $resource = $request->file('image');
                $name = uniqid() . '_' . time(). '.' .$resource->getClientOriginalName();
                $resource->move(public_path().'/img/photo/', $name);  
                $user->image = $name;
            }
            $user->update();
            return redirect() -> route('usr.profile') -> with(['error' => 'Password confirmation Not same!']);
        }catch(QueryException $e){
            return redirect() -> route('usr.profile') -> with(['error' => $e->errorInfo]);
        }

    }
}