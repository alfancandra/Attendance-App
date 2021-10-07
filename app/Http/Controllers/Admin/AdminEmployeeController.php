<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;

class AdminEmployeeController extends Controller {
    // Employee Page
    public function index() {
        $datauser = User::where('role_id',0)->get();

        return view('admin.employee',compact('datauser'))->with('i',(request()->input('page',1)-1)*5);
    }

    // Acc Employee
    public function accept($id) {
        $datauser = User::where('id',$id)->first();
        $datauser->active = 1;
        $datauser->save();
        $usermail = $datauser->email;
        Mail::html("Hello $datauser->name, your account has been accepted by Admin", function ($message) use ($usermail) {
            $message
                ->from('admin@attendance-app.com', 'Attendance App')
                ->to($usermail)
                ->subject("Account Accepted");
        });

        return redirect()->route('adm.employee')->with(['success' => 'Success accept user!']);
    }

    // Reject Employee
    public function reject($id) {
        $datauser = User::where('id',$id)->first();
        $datauser->delete();
        $usermail = $datauser->email;
        Mail::html("Hello $datauser->name, your account has been rejected by Admin", function ($message) use ($usermail) {
            $message
                ->from('admin@attendance-app.com', 'Attendance App')
                ->to($usermail)
                ->subject("Account Rejected");
        });

        return redirect()->route('adm.employee')->with(['success' => 'Success reject user!']);
    }

    // Delete Employee
    public function destroy($id) {
        $datauser = User::find($id);
        $datauser->delete();
        $usermail = $datauser->email;
        Mail::html("Hello $datauser->name, your account has been removed by Admin", function ($message) use ($usermail) {
            $message
                ->from('admin@attendance-app.com', 'Attendance App')
                ->to($usermail)
                ->subject("Account Deleted");
        });

        return redirect()->route('adm.employee')->with(['success' => 'Success remove user!']);
    }
}
 