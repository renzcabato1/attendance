<?php

namespace App\Http\Controllers;
use App\For_verification_remark;
use App\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //
    public function add_remarks_verification(Request $request)
    {
        
        $this->validate(request(),[
            'date' => 'required|date',
            'laborer_id' => 'required|max:255',
            'remarks' => 'required|max:255',
            ]    
        ); 
        
        $data = new For_verification_remark;
        $data->date_remarks  = $request->date;
        $data->laborer_id = $request->laborer_id;
        $data->remarks = $request->remarks;
        $data->remarks_by = auth()->user()->id;
        $data->save();
        
        $request->session()->flash('status',' Successfully Add Remarks!');
        return back();
        
        
    }
    public function delete_remarks(Request $request, $id)
    {
        
        $verification_remarks = For_verification_remark::find($id);    
        $verification_remarks->delete();
        $request->session()->flash('status',' Successfully Deleted!');
        return back();
        
    }
    public function save_edit_remarks(Request $request, $id)
    {
        $data =  For_verification_remark::find($id);
        $data->remarks =  $request->remarks;
        $data->save();
        $request->session()->flash('status',' Successfully Changed!');
        return back();
    }
    public function verification(Request $request)
    {
        foreach($request->names as $name)
        {
            $dateFrom = $request->from;
            $dateTo = $request->to;
            while (strtotime( $dateFrom) <= strtotime($dateTo)) {

                $verification = Verification::where('date_verified','=',$dateFrom)
                ->where('laborer_id','=',$name)
                ->get();
                if($verification->isEmpty())
                {
                    $data = new Verification;
                    $data->date_verified  = $dateFrom;
                    $data->laborer_id = $name;
                    $data->verified_by = auth()->user()->id;
                    $data->save();
                   
                }
                $dateFrom = date ("Y-m-d", strtotime("+1 day", strtotime($dateFrom)));
               
            }
        }   
        $request->session()->flash('status',' Successfully Verified all!');
        return back();
    }
}
