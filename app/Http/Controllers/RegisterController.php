<?php

namespace App\Http\Controllers;

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

    // Page Register
    public function index() {
        return view('auth.register');
    }

    // Fungsi Register
    public function store(Request $request)
    {
        // Validasi data
        // $validator = Validator::make($request->all(),[
        //     'name' => ['required'],
        //     'email' => ['required'],
        //     'password' => ['min:6', 'required_with:confirm_password', 'same:confirm_password'],
        //     'confirm_password' => ['min:6']
        // ]);
        // if($validator->fails()){
        //     return response()->json($validator->errors(),
        //     Response::HTTP_UNPROCESSABLE_ENTITY);
        // }

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        // Store to DB
        try{
            $register = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $response = [
                'message' => 'User Created',
                'data' => $register
            ];

            // Proses verifikasi email, dan jangan langsung di loginkan
            $this->emailverification($request->email);

            return redirect()->route('login')->with(['success' => 'Success create account!. Please check your email and click the link to activate your account.']);
        }catch(QueryException $e){
            // return response()->json([
            //     'message' => "Failed " . $e->errorInfo
            // ]);
            return redirect()->route('register')->with(['error' => $e->errorInfo]);
        }
    }

    // Send Verify Email
    protected function emailverification($email)
    {
        $user = User::where('email', $email) -> first();

        $token = Str::uuid();
        $user->email_verify_token = $token;
        $user->update();

        $verify_url = route("verifyLink", $token);
        $userEmail = $user->email;
        $userName = $user->name;

        $data = array('name'=>$userName, "link" => $verify_url);

        // Lalu kita kirim link verifikasinya melalui email
        Mail::html("Hello $user->name , please click $verify_url to verify your account. Thanks", function ($message) use ($userEmail) {
            $message
                ->to($userEmail)
                ->subject("Account activation!");
        });
    }

    /**
     * Method yang akan dipanggil ketika user menekan link verifikasi
     * @param $user_token
     */
    public function verify($user_token) {

        // cari kedalam database
        $user = User::where('email_verify_token', $user_token) -> first();

        // Jika user tidak ditemukan
        if(!$user) {
            return redirect()->route('register.index')->with('warning','Token verifikasi tidak valid');
        }

        $user->email_verified_at = now();
        $user->email_verify_token = null;
        $user->update();

        return redirect()->route('loginUser')
                        ->with('success','Verifikasi berhasil silahkan login');
    }
}
