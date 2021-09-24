<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Page Login
    public function index() {
        if(Auth::check() && Auth::user()->role_id==0){
            return redirect() -> route('usr.dashboard');
        }elseif(Auth::check() && Auth::user()->role_id==1){
            return redirect() -> route('adm.employee');
        }
        return view('auth.login');
    }

    // Function Login
    public function login(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'max:255'],
            'password' => ['required', 'max:16']
        ]);

        if($validator->fails()){
            // return response()->json($validator->errors(),
            // Response::HTTP_UNPROCESSABLE_ENTITY);
            return redirect() -> route('login') -> with(['error' => 'Please enter email and password!']);
        }

        try{
            $akun = $request->only('email','password');
            if(Auth::attempt($akun)){
                $AuthUser = Auth::user();
                if($AuthUser->role_id==0 && !empty($AuthUser->email_verified_at) && $AuthUser->active==1){
                    return redirect() -> route('usr.dashboard');
                }elseif($AuthUser->role_id==1 && !empty($AuthUser->email_verified_at) && $AuthUser->active==1){
                    return redirect()->route('adm.employee');
                }else{
                    Auth::logout();
                    return redirect() -> route('login') -> with(['error' => 'account not verified by Admin']);
                }
            } else {
                return redirect() -> route('login') -> with(['error' => 'Wrong email or password!']);
            }
        }catch(QueryException $e){
            // return response()->json([
            //     'message' => "Failed " . $e->errorInfo
            // ]);
            return redirect() -> route('login') -> with(['error' => $e->errorInfo]);
        }
    }

    // Function Logout
    public function logout(Request $request) {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login')->with(['success' => 'Success Logout!']);
    }
}
