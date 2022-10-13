<?php

namespace App\Http\Controllers\Backend\SchoolSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class ManagementController extends Controller
{
    public function viewClass(){
        $data['allData'] = StudentClass::all();
        return view('backend.management.viewclass', $data);
    }

    public function addClass(){
        return view('backend.management.addclass');
    }

    public function storeClass(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name'
        ]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('class.view');
    }

    public function editClass($id){
        $editData = StudentClass::find($id);
        return view('backend.management.editclass', compact('editData'));
    }

    public function updateClass(Request $request, $id){
        $data = StudentClass::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name,'.$data->id
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('class.view');
    }
}
