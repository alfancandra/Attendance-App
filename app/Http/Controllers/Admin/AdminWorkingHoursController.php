<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\WorkingHour;
use Illuminate\Http\Request;

class AdminWorkingHoursController extends Controller {
    // Working Hours Page
    public function index() {
        $datahours = WorkingHour::get();

        return view('admin.workinghours', compact('datahours'))->with('i',(request()->input('page',1)-1)*5);
    }

    // Activate Working Hours
    public function activate($id) {
        $getDayname = WorkingHour::where('id',$id)->first();
        $getSameWorkingHour = WorkingHour::where('name',$getDayname->name)->where('id','!=',$id)->get();
        $datahours = WorkingHour::where('id', $id)->first();
        if($getSameWorkingHour){
            $datahours->active = 1;
            $datahours->save();
            foreach($getSameWorkingHour as $getSame){
                $getSame->active = 'false';
                $getSame->save();
            }
        }else{
            $datahours->active = 1;
            $datahours->save();
        }
        

        return redirect()->route('adm.workinghours')->with(['success' => 'Success activate working hours!']);
    }

    // Deactivate Working Hours
    public function deactivate($id) {
        $getDayname = WorkingHour::where('id',$id)->first();
        $count = WorkingHour::where('name',$getDayname->name)->count();
        if($count>1){
            $datahours = WorkingHour::where('id', $id)->first();
            $datahours->active = 0;
            $datahours->save();

            $firstInSameDay = WorkingHour::where('name',$getDayname->name)->where('id','!=',$id)->first();
            $firstInSameDay->active = 1;
            $firstInSameDay->save();
            return redirect()->route('adm.workinghours')->with(['success' => 'Success deactivate working hour!']);
        }else{
            return redirect()->route('adm.workinghours')->with(['error' => 'Cannot deactivate because there is only 1 working hour. At least there are 2 working hours with the same day.']);
        }
        
    }

    // Add Working Hours Page
    public function addworkinghours() {
        return view('admin.addworkinghours');
    }

    // Post Working Hours Function
    public function store(Request $request) {
        // Form Validation
        $this->validate(request(), [
            'name' => 'required|max:9',
            'check_in' => 'required',
            'check_out' => 'required',
        ]);

        try {
            
            $getSameWorkingHour = WorkingHour::where('name',$request->name)->get();
            if($getSameWorkingHour){
                foreach($getSameWorkingHour as $getSame){
                    $getSame->active = 'false';
                    $getSame->save();
                }
            }
            $workinghour = WorkingHour::create([
                'name' => $request->name,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'active' => 1
            ]);
            
            $response = [
                'message' => 'User Created',
                'data' => $workinghour
            ];

            return redirect()->route('adm.workinghours')->with(['success' => 'Success create working hour!']);
        } catch (QueryException $e) {
            return redirect()->route('adm.workinghours')->with(['error' => $e->errorInfo]);
        }
    }

    // Edit Working Hours Page
    public function edit($id) {
        $dataworkinghours = WorkingHour::where('id', $id)->first();

        return view('admin.editworkinghours',compact('dataworkinghours'));
    }

    // Edit Working Hours Function
    public function update(Request $request, $id) {

        try {
            $getSameWorkingHour = WorkingHour::where('name',$request->name)->get();
            if($getSameWorkingHour){
                foreach($getSameWorkingHour as $getSame){
                    $getSame->active = 'false';
                    $getSame->save();
                }
            }
            $workinghour = WorkingHour::where('id', $id) -> first();
            $workinghour -> name = $request->name;
            $workinghour -> check_in = $request->check_in;
            $workinghour -> check_out = $request->check_out;
            $workinghour -> active = 1;
            $workinghour->update();

            $response = [
                'message' => 'Working Hour Updated',
                'data' => $workinghour
            ];

            return redirect()->route('adm.workinghours')->with(['success' => 'Success update working hour!']);
        } catch (QueryException $e) {
            return redirect()->route('adm.workinghours')->with(['error' => $e->errorInfo]);
        }
    }

    // Delete Working Hours Function
    public function destroy($id) {
        $getDayname = WorkingHour::where('id',$id)->first();
        
        $count = WorkingHour::where('name',$getDayname->name)->count();
        if($count>1 && $getDayname->active == 1){
            $datauser = WorkingHour::find($id);
            $datauser->delete();

            $firstInSameDay = WorkingHour::where('name',$getDayname->name)->first();
            $firstInSameDay->active = 1;
            $firstInSameDay->save();
            return redirect()->route('adm.workinghours')->with(['success' => 'Success delete working hour!']);
        }elseif($count>1 && $getDayname->active == 0){
            $datauser = WorkingHour::find($id);
            $datauser->delete();
            return redirect()->route('adm.workinghours')->with(['success' => 'Success delete working hour!']);
        }else{
            return redirect()->route('adm.workinghours')->with(['error' => 'Cannot delete working hour if there is only 1 day']);
        }

        return redirect()->route('adm.workinghours')->with(['success' => 'Success delete working hour!']);
    }
}
