<?php

namespace App\Http\Controllers;
use App\Manpower;
use App\Department;
use App\Agency;
use App\Work;
use Illuminate\Http\Request;
use App\Notifications\RequestManpower;
use App\Notifications\ApprovedManpower;
use App\Notifications\RequestManpowerAgency;
use App\Notifications\DisapprovedManpower;
use App\User;
class ManpowerController extends Controller
{
    //
    public function manpower_view()
    {
        $manpowers = Manpower::where('user_id',auth()->user()->id)
        ->leftJoin('departments','manpowers.department','=','departments.id')
        ->leftJoin('works','manpowers.position','=','works.id')
        ->leftJoin('agencies','manpowers.agency','=','agencies.id')
        ->leftJoin('users','manpowers.action_by','=','users.id')
        ->select('manpowers.*','departments.name as department_name','works.work_name as position_name','users.name as user_name','agencies.agency_name as agency_name')
        ->get();
      
        $departments = Department::whereIn('id',json_decode(auth()->user()->department))->orderBy('name','asc')->get();
        $positions = Work::whereIn('id',json_decode(auth()->user()->work))->orderBy('work_name','asc')->get();

        return view('view_manpower',array
        (
            'manpowers' => $manpowers,
            'departments' => $departments,
            'positions' => $positions,
        ));
    }
    public function new_manpower(Request $request)
    {
        
        $manpower = new Manpower;
        $manpower->user_id = auth()->user()->id;
        $manpower->number_of_manpower = $request->number_of_manpower;
        $manpower->department = $request->department;
        $manpower->position = $request->position;
        $manpower->remarks = $request->remarks;
        $manpower->save();
        
        $department = Department::findOrfail($request->department);
        $work = Work::findOrfail($request->position);
        $users = User::where('role',1)->get();
        $name = auth()->user()->name;
        foreach($users as $user)
        {
            $user->notify(new RequestManpower($manpower,$name,$department,$work));
            
        }
        $request->session()->flash('status','Successfully Posted');
        return back();
    }
    public function for_approval()
    {
        $manpowers = Manpower::where('manpowers.status','!=',null)
        ->leftJoin('departments','manpowers.department','=','departments.id')
        ->leftJoin('works','manpowers.position','=','works.id')
        ->leftJoin('users','manpowers.user_id','=','users.id')
        ->select('manpowers.*','departments.name as department_name','works.work_name as position','users.name as user_name')
        ->get();
        $departments = Department::orderBy('name','asc')->get();
        $positions = Work::orderBy('work_name','asc')->get();
        $agencies = Agency::orderBy('agency_name','asc')->get();
        return view('for_approval',array
        (
            'manpowers' => $manpowers,
            'departments' => $departments,
            'positions' => $positions,
            'agencies' => $agencies,
        ));
    }
    public function edit_manpower(Request $request, $id)
    {
        $manpower = Manpower::findOrfail($id);
        $manpower->number_of_manpower = $request->number_of_manpower;
        $manpower->department = $request->department;
        $manpower->position = $request->position;
        $manpower->remarks = $request->remarks;
        $manpower->save();
        $request->session()->flash('status','Successfully Updated');
        return back();
    }
    public function cancel_request(Request $request,$id)
    {
        $manpower = Manpower::findOrfail($id);
        $manpower->status = "Cancelled";
        $manpower->action_by = auth()->user()->id;
        $manpower->save();
        $request->session()->flash('status','Successfully Cancelled');
        return back();
    }
    public function approved_manpower(Request $request, $id)
    {
        $manpower = Manpower::findOrfail($id);
        $approved_by = auth()->user()->name;
        $user_notif = User::findOrfail($manpower->user_id);
        $manpower->status = "Approved";
        $manpower->action_by = auth()->user()->id;
        $manpower->approved_number = $request->number_of_manpower;
        $manpower->remarks_status = $request->remarks;
        $manpower->agency = $request->agency;
        $manpower->save();
        $manpower_department = Department::findOrfail($manpower->department);
        $manpower_position = work::findOrfail($manpower->position);
        $agency_selected = Agency::findOrfail($request->agency);
        $user_notif->notify(new ApprovedManpower($request,$agency_selected,$approved_by));
        $users = User::where('role','=',4)->get();
        foreach($users as $user)
        {
            $agency_array  = json_decode($user->agency);
            if(in_array($request->agency,$agency_array))
            {
                $user->notify(new RequestManpowerAgency($user_notif,$manpower,$manpower_department,$manpower_position));
            }
        }
        $request->session()->flash('status','Successfully Approved');
        return back();
    }
    public function cancelled_request(Request $request, $id)
    {
        $manpower = Manpower::findOrfail($id);
        $manpower->status = "Cancelled";
        $manpower->remarks_status = $request->remarks;
        $manpower->action_by = auth()->user()->id;
        $manpower->save();
        $name = auth()->user()->name;
        $user_notif = User::findOrfail($manpower->user_id);
        $user_notif->notify(new DisapprovedManpower($request,$manpower,$name));
        $request->session()->flash('status','Successfully Cancelled');
        return back();
    }    
    
}
