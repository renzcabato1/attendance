<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
class DepartmentController extends Controller
{
    //
    public function department_view()
    {
        $departments = Department::get();
        return view('department',array
        (
            'departments' => $departments,
        )); 
    }
    public function new_department(Request $request)
    {
        $this->validate(request(),[
            'department' => 'required|string|max:255',
            ]    
        );
        
        $data = new Department;
        $data->name = $request->department;
        $data->save();
        $request->session()->flash('status',$data->name . 'was successfully added ');
        return back();
    }
    public function save_edit_department(Request $request, $id)
    {
        $this->validate(request(),[
            'department' => 'required|max:255',
            ]    
        ); 
        $data =  Department::find($id);
        $data->name = $request->input('department');
        $data->save();
        $request->session()->flash('status',$data->name . ' Successfully Changed!');
        return back();
    }
}
