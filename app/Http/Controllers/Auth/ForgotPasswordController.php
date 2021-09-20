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
use App\Mail\VerifyEmail;
use Carbon\Carbon;
use Mail;

class ForgotPasswordController extends Controller {
    // Page Forgot Password
    public function index() {
        if(Auth::check() && Auth::user()->role_id==0){
            return redirect() -> route('usr.dashboard');
        }
        return view('auth.forgotpassword');
    }

    // Function forgot password
    public function SendLink(Request $request)
    {
        // Validasi Form
        $this->validate(request(), [
            'email' => 'required|email|max:255'
        ]);

        try{
            $user = User::where('email',$request->email)->first();

            if (!$user) {
                return redirect() -> back() -> with('error', "Tidak dapat menemukan user tersebut!");
            }

            $usermail = $user->email;
            $token = base64_encode($user->name . "|" . $user->email . "|" . $user->created_at);
            $timestamp = time();
            $timestamp_string = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
            $token_expired = Carbon::parse($timestamp_string) -> addDay(1);
            $link = route('CheckLink', ['userToken' => $token, 'timestamp' => $timestamp]);

            Mail::html("Hello $user->name , please click $link to reset your password. This token valid until $token_expired <br> Thanks", function ($message) use ($usermail) {
                $message
                    ->to($usermail)
                    ->subject("Reset Password");
            });

            return redirect()->route('login') -> with('success', "Berhasil mengirimkan email reset password!");
        }catch(QueryException $e){
            return redirect()->route('register')->with(['error' => $e->errorInfo]);
        }
    }

    // Check Link
    public function CheckLink($userToken, $timestamp) {
        return view('auth.resetpassword')
            -> with('token', $userToken)
            -> with('timestamp', $timestamp);
    }

    // Save New Password
    public function newpassword($userToken, $timestamp)
    {
        try{
            $token = explode("|", base64_decode($userToken));
            empty($token[0]) ? $name='' : $name=$token[0];
            empty($token[1]) ? $email='' : $email=$token[1];
            empty($token[2]) ? $created_at='' : $created_at=$token[2];

            $user = User::where('name', $name) -> where('email', $email) -> where('created_at', $created_at) -> first();
            if(!$user) {
                return redirect() -> route('login') -> with('error', "Tidak dapat memproses permintaan! Token tidak valid");
            }
            if (!$this->isValidTimeStamp($timestamp)) {
                return redirect() -> route('login') -> with('error', "Tidak dapat memproses permintaan! Timestamp tidak valid");
            } else {
                $timestamp_string = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
                $timestamp_string_add_1_day = Carbon::parse($timestamp_string)->addDays(1);
                $waktu_saat_ini = Carbon::parse(now());

                if ($waktu_saat_ini->greaterThan($timestamp_string_add_1_day)) {
                    return redirect() -> route('login') -> with('error', "Tidak dapat memproses permintaan! Token sudah expired");
                }
            }

            if (request('password') != request('password_confirmation')) {
                return redirect() -> back() -> with('error', "Password Tidak sama");
            }

            $user->password = Hash::make(request('password'));
            $user->save();

            $userEmail = $user->email;

            Mail::html("Hello $user->name. Your password has been changed, contact us if you don't do this. Thanks", function ($message) use ($userEmail) {
                $message
                    ->to($userEmail)
                    ->subject("Password Changed");
            });

            return redirect() -> route('login') -> with('success', "Berhasil reset password! Silahkan login");
        }catch(QueryException $e){
            return redirect()->route('forgotpassword')->with(['error' => $e->errorInfo]);
        }
        
    }

    // Validasi TimeStamp
    private function isValidTimeStamp($timestamp): bool
    {
        return ((string) (int) $timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
}
