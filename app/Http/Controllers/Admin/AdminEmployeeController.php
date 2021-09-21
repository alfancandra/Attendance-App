<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;

class AdminEmployeeController extends Controller {
    // Page Employee
    public function index() {
        $datauser = User::where('role_id',0)->get();

        return view('admin.employee',compact('datauser'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    // Acc Employee
    public function accept($id)
    {
        $datauser = User::where('id',$id)->first();
        $datauser->active = 1;
        $datauser->save();
        return redirect()->route('adm.employee')->with(['success' => 'Success accept user!']);
    }

    // Reject Employee
    public function reject($id)
    {
        $datauser = User::where('id',$id)->first();
        $datauser->delete();
        $usermail = $datauser->email;
        Mail::html("Hello $datauser->name, your account has been rejected by Admin", function ($message) use ($usermail) {
            $message
                ->to($usermail)
                ->subject("Account Rejected");
        });
        return redirect()->route('adm.employee')->with(['success' => 'Success reject user!']);
    }

    public function destroy($id)
    {
        $datauser = User::find($id);
        $datauser->delete();
        $usermail = $datauser->email;
        Mail::html("Hello $datauser->name , your account has been Delete by Admin", function ($message) use ($usermail) {
            $message
                ->to($usermail)
                ->subject("Account Deleted");
        });
        return redirect()->route('adm.employee')->with(['success' => 'Berhasil Hapus']);
    }
}
 