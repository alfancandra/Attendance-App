<?php

namespace App\Http\Controllers;

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
        return view('auth.login');
    }

    // Function Login
    public function login(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(),[
            'email' => ['required'],
            'password' => ['required']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try{
            $akun = $request->only('email','password');
            if(Auth::attempt($akun)){
                $AuthUser = Auth::user();
                return response()->json('login');
            }else{
                return response()->json('gagal');
            }
        }catch(QueryException $e){
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
