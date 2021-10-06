<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class AdminOfficeController extends Controller {
    // Edit Page Office Detail
    public function edit() {
        $dataoffice = Office::first();

        return view('admin.officeprofile', compact('dataoffice'))->with('i',(request()->input('page',1)-1)*5);
    }

    // Update Function Office Page
    public function update(Request $request, $id) {
        // Form Validation
        $this->validate(request(), [
            'name' => 'required',
            'longitude' => 'required',
            'langitude' => 'required',
        ]);

        try {
            $dataoffice = Office::where('id', 1) -> first();
            $dataoffice -> name = $request->name;
            $dataoffice -> longitude = $request->longitude;
            $dataoffice -> langitude = $request->langitude;
            $dataoffice->update();

            $response = [
                'message' => 'Office Detail Updated',
                'data' => $dataoffice
            ];
            
            return redirect()->route('adm.officeprofile')->with(['success' => 'Success update office detail!']);
        } catch (QueryException $e) {
            return redirect()->route('adm.officeprofile')->with(['error' => $e->errorInfo]);
        }
    }
}
