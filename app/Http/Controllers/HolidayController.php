<?php

namespace App\Http\Controllers;
use App\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    //
    public function view_holidays()
    {


        $holidays = Holiday::where('status','Permanent')->orderBy('holiday_date','asc')->get();
        $year = date('Y');
        $holidays_a = Holiday::where('status',null)->whereYear('holiday_date', '=', $year)->get();
        return view('view_holiday', array(
            'holidays' => $holidays,
            'year' => $year,
            'holidays_a' => $holidays_a,
        )); 
    }
    public function new_holiday(Request $request)
    {
        
        $new_holiday = new Holiday;
        $new_holiday->holiday_name = $request->holiday_name;
        $new_holiday->holiday_type = $request->holiday_type;
        $new_holiday->holiday_date = $request->holiday_date;
        $new_holiday->save();
        $request->session()->flash('status','New Holiday Store');
        return back();
        
    }
    public function edit_holiday(Request $request,$id)
    {
        $holiday = Holiday::findOrfail($id);
        $holiday->holiday_name = $request->holiday_name;
        $holiday->holiday_type = $request->holiday_type;
        $holiday->holiday_date = $request->holiday_date;
        $holiday->save();
        $request->session()->flash('status','Successfully Updated');
        return back();
    }
    public function delete_holiday(Request $request,$id)
    {
       $holiday = Holiday::findOrfail($id);
       $holiday->delete();
       $request->session()->flash('status','Succesfully Deleted');
       return back();
    }
}
 