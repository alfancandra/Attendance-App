<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;

class AdminEmployeeController extends Controller {
    // Page Employee
    public function index() {
        $datauser = User::where('role_id',0)
        ->where('active',0)
        ->whereNotNull('email_verified_at')->get();

        return view('admin.employee',compact('datauser'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    // Acc Employee
    public function accept($id)
    {
        $datauser = User::where('id',$id)->first();
        $datauser->active = 1;
        $datauser->save();
        return redirect()->route('adm.employee')->with(['success' => 'Berhasil Acc']);
    }

    // Reject Employee
    public function reject($id)
    {
        $datauser = User::where('id',$id)->first();
        $datauser->delete();
        $usermail = $datauser->email;
        Mail::html("Hello $datauser->name , your account has been rejected by Admin", function ($message) use ($usermail) {
            $message
                ->to($usermail)
                ->subject("Account Rejected");
        });
        return redirect()->route('adm.employee')->with(['success' => 'Berhasil Reject']);
    }
}
