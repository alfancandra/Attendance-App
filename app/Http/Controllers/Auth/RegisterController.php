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
use Mail;

class RegisterController extends Controller {
    /**
     * Show register page
     */
    public function index() {
        if (Auth::check() && Auth::user()->role_id==0) {
            return redirect() -> route('usr.dashboard');
        }
        
        return view('auth.register');
    }

    /**
     * Methode that use to store user data to database
     */
    public function store(Request $request) {
        // Validasi data
        $this->validate(request(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|min:8|max:255',
            'password' => 'required|confirmed|min:8|max:16',
        ]);

        // Store user data to database
        try {
            $register = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $response = [
                'message' => 'User Created',
                'data' => $register
            ];

            // Email verification process, and user can't login
            $this->emailverification($request->email);

            return redirect()->route('login')->with(['success' => 'Success create account. Please check your email and click the link to activate your account.']);
        } catch (QueryException $e) {
            return redirect()->route('register')->with(['error' => $e->errorInfo]);
        }
    }

    /**
     * Sending email verification to user
     * @param $email
     */
    protected function emailverification($email) {
        $user = User::where('email', $email) -> first();

        $token = Str::uuid();
        $user->email_verify_token = $token;
        $user->update();

        $verify_url = route("verifyLink", $token);
        $userEmail = $user->email;
        $userName = $user->name;

        $data = [
            'name' => $userName, 
            'link' => $verify_url
        ];

        Mail::send('auth.emailregistration', $data, function ($message) use ($userEmail) {
            $message
                ->from('admin@attendance-app.com', 'Attendance App')
                ->to($userEmail)
                ->subject("Account Activation");
        });
    }

    /**
     * Method that use to verify when user have to click the verification link
     * @param $user_token
     */
    public function verify($user_token) {

        // Search user email verification token
        $user = User::where('email_verify_token', $user_token) -> first();

        // If user not found
        if (!$user) {
            return redirect()->route('register')->with('error','Invalid verification token!');
        }

        $user->email_verified_at = now();
        $user->email_verify_token = null;
        $user->update();

        return redirect()->route('login')->with('success','Account activation is successful! Please log in.');
    }
}
