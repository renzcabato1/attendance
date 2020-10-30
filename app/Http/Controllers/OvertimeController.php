<?php

namespace App\Http\Controllers;
use App\OtRequest;
use App\Attendance;
use App\Company;
use App\Department;
use App\Work;
use App\Laborer;
use App\MaxOt;
use App\Approved_ot;
use App\FileOt;
use App\Generate;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    //

    public function overtime_manpower()
    {
        $generate = Generate::orderBy('date_to','desc')->first();
        $ot_requests = OtRequest::where('request_by',auth()->user()->id)
        ->where('status','=','Pending')
        ->leftJoin('laborers','ot_requests.laborer_id','=','laborers.usruid')
        ->leftJoin('users','ot_requests.action_by','=','users.id')
        ->select('laborers.name','ot_requests.*','users.name as username')
        ->get();
        $max_ot = MaxOt::first(['max_ot']);
        if (auth()->user()->role == 1)
        {
            // $laborers = Laborer::where('active','AC')->orderBy('name','asc')->get();
        }
        else
        {
            // $laborers = Laborer::where('active','AC')->whereIn('department',json_decode(auth()->user()->department))->whereIn('agency_id',json_decode(auth()->user()->agency))->orderBy('name','asc')->get();
        }
        
        return view('ot_request',array
        (
            'ot_requests' => $ot_requests,
            // 'laborers' => $laborers,
            'max_ot' => $max_ot,
            'generate' => $generate,
        )
    );
    }
    public function new_ot_request(Request $request)
    {

        $attendance = Attendance::whereIn('laborer_id',$request->laborer)->whereDate('time_in',$request->date_of_ot)->first();
        if($attendance)
        {
            foreach($request->laborer as $laborer_id)
            {
                $attendance = Attendance::where('laborer_id',$laborer_id)->whereDate('time_in',$request->date_of_ot)->first();
                if($attendance != null)
                {
                    $ot_request = OtRequest::where('attendance_id',$attendance->id)->where('date_ot','=',$request->date_of_ot)->where('status','!=','Cancelled')->first();
                    if($ot_request == null)
                    {
                        $new_ot_request = new OtRequest;
                        $new_ot_request->request_by = auth()->user()->id;
                        $new_ot_request->laborer_id = $laborer_id;
                        $new_ot_request->ot_request = $request->number_of_ot;
                        $new_ot_request->date_ot = $request->date_of_ot;
                        $new_ot_request->remarks = $request->remarks;
                        $new_ot_request->attendance_id = $attendance->id;
                        $new_ot_request->status = 'Pending';
                        $new_ot_request->save();
                    }
                }
            }
            $request->session()->flash('status','Successfully Posted');
            return back();
        }
        else
        {
            $request->session()->flash('error_status','No Attendance Found (Please check again your request Date)!');
            return back();
        }

    }
    public function save_edit_request(Request $request,$id)
    {

        $attendance = Attendance::where('laborer_id',$request->laborer)->whereDate('time_in',$request->date_of_ot)->first();
        if($attendance)
        {
           
                $ot_request = OtRequest::where('attendance_id',$attendance->id)->where('date_ot','=',$request->date_of_ot)->where('id','!=',$id)->first();
                if($ot_request == null)
                {
                    $new_ot_request = OtRequest::findOrfail($id);
                    $new_ot_request->request_by = auth()->user()->id;
                    $new_ot_request->laborer_id = $request->laborer;
                    $new_ot_request->ot_request = $request->number_of_ot;
                    $new_ot_request->date_ot = $request->date_of_ot;
                    $new_ot_request->remarks = $request->remarks;
                    $new_ot_request->attendance_id = $attendance->id;
                    $new_ot_request->save();
                    $request->session()->flash('Status','Successfully Updated');
                    return back();
                }
                else
                {
                    $request->session()->flash('error_status','please select other date to continue updating!');
                    return back();
                }
            
        }
        else
        {
            $request->session()->flash('error_status','No Attendance Found (Please check again your request Date)!');
            return back();
        }

    }
    public function delete_ot_request(Request $request,$id)
    {
        $attendance = OtRequest::find($id);    
        $attendance->delete();
        $request->session()->flash('status',' Successfully Deleted!');
        return back();
    }
    public function for_approval_overtime(Request $request)
    {
        $ot_requests = OtRequest::where('status','Pending')
        ->leftJoin('laborers','ot_requests.laborer_id','=','laborers.usruid')
        ->leftJoin('users','ot_requests.request_by','=','users.id')
        ->select('laborers.name as laborer_name','ot_requests.*','users.name as username')
        ->get();

        $max_ot = MaxOt::first(['max_ot']);
      
        return view('for_approval_ot',array
        (
            'ot_requests' => $ot_requests,
            'max_ot' => $max_ot,
        )
        );
    }
    public function approved_ot(Request $request,$id)
    {

        $ot_request = OtRequest::findOrfail($id);
        $ot_request->approved_ot =  $request->approved_ot;
        $ot_request->remarks_ot = $request->remarks;
        $ot_request->action_by = auth()->user()->id;
        $ot_request->status = 'Approved';
        $ot_request->save();

        $new_data = new Approved_ot;
        $new_data->attendance_id = $ot_request->attendance_id;
        $new_data->approve_ot = $request->approved_ot;
        $new_data->remarks = $request->remarks;
        $new_data->approved_by = auth()->user()->id;
        $new_data->save();

        $request->session()->flash('Status','Successfully Approved');
        return back();
    }
    public function cancel_ot(Request $request,$id)
    {
        $ot_request = OtRequest::findOrfail($id);
        $ot_request->remarks_ot = $request->remarks;
        $ot_request->action_by = auth()->user()->id;
        $ot_request->status = 'Cancelled';
        $ot_request->save();
        $request->session()->flash('Status','Successfully Cancelled');
        return back();
        
    } 
    public function can_file_ots(Request $request)
    {
        
        $companies = Company::orderBy('company_name','asc')->get();
        $departments = Department::orderBy('name','asc')->get();
        $positions = Work::orderBy('work_name','asc')->get();
        $can_file_ot = FileOt::with('company_info','department_info','position_info')->get();
        return view('can_approves_ot',array
        (
            'companies' => $companies,
            'departments' => $departments,
            'positions' => $positions,
            'can_file_ots' => $can_file_ot,
        ));
        
    }
    public function new_file_ot(Request $request)
    {
        $can_file = new FileOt;
        $can_file->uploaded_by = auth()->user()->id;
        $can_file->company_id = $request->company;
        $can_file->department_id = $request->department;
        $can_file->work_id = $request->work;
        $can_file->save();
        $request->session()->flash('status','Successfully Posted');
        return back();
    }
}
