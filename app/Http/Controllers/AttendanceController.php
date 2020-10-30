<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laborer;
use App\Agency;
use App\Device;
use App\Schedule;
use App\Attendance;
use App\Attendance_history;
use App\Approved_ot;
use App\For_verification_remark;
use App\Verification;
use App\Company;
use App\Work;
use App\SalaryType;
use App\Holiday;
use App\Department;
use App\Generate;
use Auth;
use PDF;
use Illuminate\Support\Facades\DB;


class AttendanceController extends Controller
{
    //a
    public function view_attendance(Request $request)
    {    
        if (!Auth::user()){
            return view('login');
        }
        else{
            if(auth()->user()->role == 3)
            {
                 return redirect('ap');
            }
            else 
            {
                $dateFrom = $request->from;
                $dateTo = $request->to;
                $from = $request->from;
                $to = $request->to;
                $names = $request->laborer;
                $name_all = [];
                $attendance_all=[];
                $from_date = $request->from;
                $to_date = $request->to;
                
                $laborers=[];
                if($names){
                    $attendances = Attendance::whereDate('time_in', '>=',  $dateFrom)
                    ->whereDate('time_in' ,'<=',  $dateTo)
                    ->whereIn('laborer_id',$names)
                    ->get();
                    $laborers = Laborer::whereIn('id',$names)
                    ->get(['id','name']);
                    $name_all[] =$laborers;
                    $attendances_all[]=$attendances;
                    if ((auth()->user()->role == 1)||(auth()->user()->role == 3))
                    {
                        $laborers = Schedule::whereBetween('date', [$from_date, $to_date])
                        ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
                        ->select('laborers.id','laborers.name')
                        ->orderBy('laborers.name','asc')
                        ->groupBy('laborers.id','laborers.name')
                        ->get(['laborers.id','laborers.name']);
                        // $laborers = Laborer::where('active','AC')->orderBy('name','asc')->get();
                    }
                    elseif (auth()->user()->role == 2)
                    {
                        $laborers = Schedule::whereBetween('date', [$from_date, $to_date])
                        ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
                        ->whereIn('schedules.work_id',json_decode(auth()->user()->work))
                        ->whereIn('schedules.company_id',json_decode(auth()->user()->company))
                        ->whereIn('schedules.location_id',json_decode(auth()->user()->department))
                        ->whereIn('laborers.agency_id',json_decode(auth()->user()->agency))
                        ->select('laborers.id','laborers.name')
                        ->orderBy('laborers.name','asc')
                        ->groupBy('laborers.id','laborers.name')
                        ->get(['laborers.id','laborers.name']);
                    }
                    elseif (auth()->user()->role == 4)
                    {
                        
                        $laborers = Schedule::whereBetween('date', [$from_date, $to_date])
                        ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
                        ->whereIn('laborers.agency_id',json_decode(auth()->user()->agency))
                        ->select('laborers.id','laborers.name')
                        ->orderBy('laborers.name','asc')
                        ->groupBy('laborers.id','laborers.name')
                        ->get(['laborers.id','laborers.name']);
                    }
                    elseif (auth()->user()->role == 5)
                    {
                        $laborers = Schedule::whereBetween('date', [$from_date, $to_date])
                        ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
                        ->whereIn('laborers.agency_id',json_decode(auth()->user()->agency))
                        ->whereIn('schedules.work_id',json_decode(auth()->user()->work))
                        ->select('laborers.id','laborers.name')
                        ->orderBy('laborers.name','asc')
                        ->groupBy('laborers.id','laborers.name')
                        ->get(['laborers.id','laborers.name']);
                    }
        
                }
                else
                {
                    $attendances = [];
                    $attendances_all=$attendances;
                }
                if($dateFrom!=null){
                    while (strtotime($dateFrom) <= strtotime($dateTo)) {
                        $dates[]=$dateFrom;
                        $dateformat[]= date(('M. j, Y'),strtotime($dateFrom));
                        $dateFrom = date ("Y-m-d", strtotime("+1 day", strtotime($dateFrom)));
                    }
                }
                else
                {
                    $dateformat = [];
                    $dates = [];
                }
                // if (auth()->user()->role == 1)
                // {
                //     $laborers = Laborer::where('active','AC')->orderBy('name','asc')->get();
                // }
                // elseif (auth()->user()->role == 2)
                // {
                //     $laborers = Laborer::where('active','AC')->whereIn('work_id',json_decode(auth()->user()->work))->whereIn('company_id',json_decode(auth()->user()->company))->whereIn('department',json_decode(auth()->user()->department))->whereIn('agency_id',json_decode(auth()->user()->agency))->orderBy('name','asc')->get();
                // }
                // elseif (auth()->user()->role == 3)
                // {
                //     $laborers = Laborer::where('active','AC')->orderBy('name','asc')->get();
                // }
                // elseif (auth()->user()->role == 4)
                // {
                //     $laborers = Laborer::where('active','AC')->whereIn('agency_id',json_decode(auth()->user()->agency))->orderBy('name','asc')->get();
                // }
                // elseif (auth()->user()->role == 5)
                // {
                //     $laborers = Laborer::where('active','AC')->whereIn('agency_id',json_decode(auth()->user()->agency))->whereIn('work_id',json_decode(auth()->user()->work))->orderBy('name','asc')->get();
                // }
                $dates = array_reverse($dates);
                $dateformat = array_reverse($dateformat);
                return view('view_attendance',array
                (
                    'laborers' => $laborers,
                    'attendances_all' => $attendances,
                    'dates' => $dates,
                    'dateformats' => $dateformat,
                    'names' => $names,
                    'name_all' => $name_all,
                    'from' => $from,
                    'to' => $to,
                )); 
            }
        }
    }
    public function view_record(Request $request)
    { 
        if (!Auth::user()){
            return view('login');
        }
        else
        {
            $dateFrom = $request->from;
            $dateTo = $request->to;
            $from = $request->from;
            $to = $request->to;
            $names = $request->laborer;
            $name_all = [];
            $attendances_all=[];
            if($names){
                    $attendances = Attendance::whereBetween('time_in', [$dateFrom, $dateTo])
                    ->whereIn('laborer_id',$names)
                    ->get();
                    $laborers = Laborer::whereIn('id',$names)->get(['id','name']);
            }
            else
            {
                $attendances = Attendance::whereBetween('time_in', [$dateFrom, $dateTo])
                ->get();
                $attendances_all[]=$attendances;
            }
            
            if($dateFrom!=null){
                while (strtotime($dateFrom) <= strtotime($dateTo)) {
                    $dates[]=$dateFrom;
                    $dateformat[]= date(('M. j, Y'),strtotime($dateFrom));
                    $dateFrom = date ("Y-m-d", strtotime("+1 day", strtotime($dateFrom)));
                }
            }
            else
            {
                $dateformat = [];
                $dates = [];
            }
            if (auth()->user()->role == 1)
            {
                $laborers = Laborer::where('active','AC')->orderBy('name','asc')->get();
            }
            elseif (auth()->user()->role == 2)
            {
                $laborers = Laborer::where('active','AC')->whereIn('work_id',json_decode(auth()->user()->work))->whereIn('company_id',json_decode(auth()->user()->company))->whereIn('department',json_decode(auth()->user()->department))->whereIn('agency_id',json_decode(auth()->user()->agency))->orderBy('name','asc')->get();
            }
            elseif (auth()->user()->role == 3)
            {
                $laborers = Laborer::where('active','AC')->orderBy('name','asc')->get();
            }
            elseif (auth()->user()->role == 4)
            {
                $laborers = Laborer::where('active','AC')->whereIn('agency_id',json_decode(auth()->user()->agency))->orderBy('name','asc')->get();
            }
            elseif (auth()->user()->role == 5)
            {
                $laborers = Laborer::where('active','AC')->whereIn('agency_id',json_decode(auth()->user()->agency))->whereIn('work_id',json_decode(auth()->user()->work))->orderBy('name','asc')->get();
            }
            
            return view('view_record',array
            (
                'laborers' => $laborers,
                'attendances_all' => $attendances,
                'dates' => $dates,
                'dateformats' => $dateformat,
                'names' => $names,
                'name_all' => $name_all,
                'from' => $from,
                'to' => $to,
            )); 
        }
    }
    public function add_new_attendance(Request $request)
    {
        $this->validate(request(),[
            'start_time' => 'required|max:255',
            'end_time' => 'required|max:255',
            'device_name' => 'required|max:255',
            'name' => 'required|max:255',
            'date' => 'required|max:255',
            ]    
        ); 
        
       if($request->nextday == 1)
       {
        $laborer_id = $request->name;
        $device_id = $request->device_name;
        $time_in = $request->date.' '.$request->start_time.':00';
        $date_tomorrow  = date("Y-m-d", strtotime("+1 day", strtotime($request->date)));
        $time_out = $date_tomorrow.' '.$request->end_time.':00';

       }
       else
       {
        $laborer_id = $request->name;
        $device_id = $request->device_name;
        $time_in = $request->date.' '.$request->start_time.':00';
        $time_out = $request->date.' '.$request->end_time.':00';

       }

       $data = new Attendance;
       $data->laborer_id = $laborer_id;
       $data->time_in = $time_in;
       $data->device_in =  $device_id;
       $data->time_out =  $time_out;
       $data->device_out =  $device_id;
       $data->save();

       $data_attendance = Attendance::orderby('id','desc')->limit(1)->get();

       $data1 = new Attendance_history;
       $data1->attendance_id = $data_attendance[0]->id;
       $data1->action_by = auth()->user()->id;
       $data1->remarks = $request->remarks;
       $data1->event = 'New Attendance';
       $data1->save();
              
       $request->session()->flash('status','Attendance Newly Added!');
       return back();
    }
    public function delete_attendance(Request $request, $id)
    {
        $attendance = Attendance::find($id);    
        $attendance->delete();
        $request->session()->flash('status',' Successfully Deleted!');
        return back();
    }
    public function save_edit_attendance(Request $request, $id)
    {
        $this->validate(request(),[
            'start_time' => 'required|max:255',
            'end_time' => 'required|max:255',
            'device_name' => 'required|max:255',
            'remarks' => 'required|max:255',
            ]    
        ); 
       
        if($request->nextday == 1)
        {
            $device_id = $request->device_name;
            $time_in = $request->date.' '.$request->start_time.':00';
            $date_tomorrow  = date("Y-m-d", strtotime("+1 day", strtotime($request->date)));
            $time_out = $date_tomorrow.' '.$request->end_time.':00';
    
        }
        else
        {
            $this->validate(request(),[
                'end_time' => 'required|max:255|after_or_equal:start_time',
                ]    
                ,[
                    'after_or_equal'  => 'The Time Out must be greater than to Time In!']
            ); 
            $device_id = $request->device_name;
            $time_in = $request->date.' '.$request->start_time.':00';
            $time_out = $request->date.' '.$request->end_time.':00';
        }

        $data =  Attendance::find($id);
        $data->time_in = $time_in;
        $data->device_in =  $device_id;
        $data->time_out =  $time_out;
        $data->device_out =  $device_id;
        $data->save();

        $data1 = new Attendance_history;
        $data1->attendance_id = $id;
        $data1->action_by = auth()->user()->id;
        $data1->remarks = $request->remarks;
        $data1->event = 'Edit Attendance';
        $data1->save();


        $request->session()->flash('status',' Successfully Changed!');
        return back();
    }
    public function approved_ot(Request $request, $id)
    {
        $this->validate(request(),[
            'ot' => 'required|numeric|between:0,99.99',
            'remarks' => 'required|max:255',
            ] 
        );
        $data = new Approved_ot;
        $data->attendance_id = $id;
        $data->approve_ot = $request->ot;
        $data->remarks = $request->remarks;
        $data->approved_by = auth()->user()->id;
        $data->save();
        $request->session()->flash('status','successfully approved');
        return back();


    }
    public function for_verification(Request $request)
    {
            $dateToa = date ("Y-m-d", strtotime("+1 day", strtotime($request->to)));
            $dateTo = $request->to;
            $dateFrom = $request->from;
            $from = $request->from;
            $to = $request->to;
            $laborer_ids = $request->laborer;
            $name_all = [];
            $schedules_all=[];
            $dates= [];
            $dateformat= [];
            $approved_ot_final = [];
            $remarks = [];
            $verification_details = [];
            $devices = Device::orderBy('name','asc')->get();
            if($laborer_ids){
                $schedules = Schedule::whereBetween('date', [$dateFrom, $dateToa])
                ->leftJoin('devices', 'schedules.device_id', '=', 'devices.id')
                ->leftJoin('laborers', 'schedules.laborer_id', '=', 'laborers.id')
                ->whereIn('laborer_id',$laborer_ids)
                ->select('schedules.*', 'devices.name','laborers.name AS laborer_name')
                ->get();
                $attendances = Attendance::whereBetween('time_in', [$dateFrom, $dateToa])
                ->whereIn('laborer_id',$laborer_ids)
                ->get();
                $remarks = For_verification_remark::whereBetween('date_remarks', [$dateFrom, $dateTo])
                ->whereIn('laborer_id',$laborer_ids)
                ->get();
                $verification_details = Verification::whereBetween('date_verified', [$dateFrom, $dateTo])
                ->whereIn('laborer_id',$laborer_ids)
                ->get();
                $laborers = Laborer::whereIn('id',$laborer_ids)
                ->get(['id','name']);
                $name_all =$laborers;
                $schedules_all[]=$schedules;
                $attendances_all[]=$attendances;
            }
            else
            {
                $schedules = Schedule::whereBetween('date', [$dateFrom, $dateToa])
                ->get();
                $schedules_all[]=$schedules;
                $attendances = Attendance::whereBetween('time_in',[$dateFrom, $dateToa])
                ->get();
                $attendances_all[]=$attendances;
            }
            if($dateFrom!=null){
                while (strtotime($dateFrom) <= strtotime($dateTo)) {
                    $dates[]=$dateFrom;
                    $dateformat[]= date(('M. j, Y'),strtotime($dateFrom));
                    $dateFrom = date ("Y-m-d", strtotime("+1 day", strtotime($dateFrom)));
                }
            }
            else
            {
                $dateformat = [];
                $dates = [];
            }
            $schedule_array_collect = collect($schedules); 
            $schedule_array = $schedule_array_collect->toArray();
            $collection = collect($attendances)->pluck('id'); 
            $approved_ot_final = $collection->toArray();
            $approved_ot = Approved_ot::whereIn('attendance_id',$approved_ot_final)
            ->leftJoin('users', 'approved_ots.approved_by', '=', 'users.id')
            ->select('users.name AS name_of_approver', 'approved_ots.*')
            ->get();
            $attendance_history = Attendance_history::whereIn('attendance_id',$approved_ot_final)
            ->leftJoin('users', 'attendance_histories.action_by', '=', 'users.id')
            ->select('users.name AS name_of_action', 'attendance_histories.*')
            ->orderBy('attendance_histories.id','desc')
            ->get();
            $laborers = Laborer::orderBy('name','asc')->get();
            $approved_ot_final1 = collect($approved_ot)->toArray(); 
            $attendance_history1 = collect($attendance_history)->toArray(); 
            $remarks = collect($remarks)->toArray(); 
            $verification_details = collect($verification_details)->toArray(); 
            return view('for_verification',array
            (
                'laborers' => $laborers,
                'schedules_all' => $schedules_all,
                'dates' => $dates,
                'dateformats' => $dateformat,
                'names' => $laborer_ids,
                'name_all' => $name_all,
                'from' => $from,
                'to' => $to,
                'devices' => $devices,
                'attendances_all' => $attendances,
                'approved_ot_final' => $approved_ot_final1,
                'attendance_histories' => $attendance_history1,
                'schedule_array' => $schedule_array,
                'remarks' => $remarks,
                'verification_details' => $verification_details,
            )); 
    }
    public function ap(Request $request)
    {
        $date_range  = $request->date_range;
        $date_range_value = explode(' - ',$date_range);
        $location_id = $request->location;
        $company_id = $request->company;
        $agency_id = $request->agency;
      
        $position_id = $request->position;
        $year_data = $request->year_data;
        $holidays = [];
        $holidays_new = [];
        $date_from1 = $request->date_from;
        $date_to1 = $request->date_to;
        if($date_to1 != null)
        {
            $salary = SalaryType::where('agency_id',$agency_id)
            ->where('work_id','=',$position_id)
            ->whereDate('expiration_date','>=',$date_to1)
            ->orderBy('id','desc')
            ->first()
            ;
            if($salary == null)
            {
                $salary = SalaryType::where('agency_id',$agency_id)
                ->where('work_id','=',$position_id)
                ->where('expiration_date','=',null)
                ->orderBy('id','desc')
                ->first()
                ;
            }
        }   
        else
        {
            $salary = null;
        }
        $companies = Company::whereIn('id',json_decode(auth()->user()->company))->orderBy('company_name','asc')->get();
        $agencies = Agency::whereIn('id',json_decode(auth()->user()->agency))->orderBy('agency_name','asc')->get();
        $positions = Work::whereIn('id',json_decode(auth()->user()->work))->orderBy('work_name','asc')->get();
        $locations = Department::whereIn('id',json_decode(auth()->user()->department))->orderBy('name','asc')->get();
        $years = Attendance::distinct()->get([DB::raw('YEAR(time_in) as year')]);
        $laborers = [];
        $dates = [];
        $attendances = [];
        $schedules = [];
        $approved_ot_final1 = [];
        $daterange = [];
        $daterange_name = [];
        $discount = [];
        $start_date = null;
        $end_date = null;
        $work_name = null;
        $generates = null;
        if($request->company)
        {
            $date_from1 = $date_range_value[0];
            $date_to1 = $date_range_value[1];
            $generates = Generate::with('companyName')
            ->where('agency_id',$agency_id)
            ->where('company_id',$company_id)
            ->where('location_id',$location_id)
            ->where('position_id',$position_id)
            ->whereBetween('date_from',[$date_from1,$date_to1])
            ->get();
            
            $work_name = Work::findOrfail($position_id);
            $dateToa = date ("Y-m-d", strtotime("+1 day", strtotime($date_to1)));
            $start_date = $date_from1;
            $from_date = $start_date;
            $to_date = $date_to1;
            $start_date1 = $date_from1;
            $end_date = $date_to1;
            $year = $request->year_data;
            $startDate = $year.'-01-01';
            if($year == date('Y'))
            {
            $endDate = date('Y-m-d');
            }
            else
            {
            $endDate =  $year.'12-31';
            }
            $endDate = strtotime($endDate);
            if('Monday' != date('l',strtotime($startDate)))
            {
               $startDate = date('Y-m-d',strtotime('-1 week',strtotime($startDate)));
            }
            for($i = strtotime('Monday', strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
            {
            $daterange[] = date('Y-m-d', $i).' - '.date('Y-m-d', strtotime('+6 day',$i));
            $daterange_name[] = date('M d, Y', $i).' - '.date('M d, Y', strtotime('+6 day',$i));
            }
            $discount = Work::leftJoin('discounts','works.status','=','discounts.id')
            ->where('works.id','=',$position_id)
            ->select('discounts.*','works.*')
            ->first();
            $laborers = Schedule::whereBetween('date', [$from_date,$to_date])
            ->where('schedules.work_id',$position_id)
            ->where('schedules.company_id',$company_id)
            ->where('schedules.location_id',$location_id)
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
            ->where('laborers.agency_id',$agency_id)
            ->select('laborers.id','laborers.name')
            ->orderBy('laborers.name','asc')
            ->groupBy('laborers.id','laborers.name')
            ->get(['laborers.id','laborers.name']);
          
            $laborers_id = collect($laborers)->pluck('id'); 
            $schedules = Schedule::whereBetween('date', [$start_date, $dateToa])
            ->where('schedules.work_id',$position_id)
            ->where('schedules.company_id',$company_id)
            ->where('schedules.location_id',$location_id)
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
            ->where('laborers.agency_id',$agency_id)
            ->whereIn('laborer_id',$laborers_id)
            ->select('schedules.*')
            ->get();
            
            $attendances = Attendance::whereBetween('time_in', [$start_date, $dateToa])
            ->whereIn('laborer_id',$laborers_id)
            ->get();
            $collection = collect($attendances)->pluck('id'); 
            $approved_ot_final = $collection->toArray();
            $approved_ot = Approved_ot::whereIn('attendance_id',$approved_ot_final)
            ->get();
            $approved_ot_final1 = collect($approved_ot)->toArray(); 
            $start_month = date('2019-m-d',strtotime($start_date));
            $end_month = date('2019-m-d',strtotime($end_date));
            // dd($start_month);
            $holidays = Holiday::where('status','=','Permanent')->whereBetween('holiday_date',[$start_month, $end_month])->get();
            // dd($holidays);  
            $holidays_new = Holiday::whereBetween('holiday_date',[$start_date, $end_date])->where('status','=',null)->get();
            
            while (strtotime($start_date1) <= strtotime($end_date)) 
            {
                $dates[]=$start_date1;
                $start_date1 = date ("Y-m-d", strtotime("+1 day", strtotime($start_date1)));
            }
        }
        // dd($generates);
        return view('ap_report',array
        (
            'companies' => $companies,
            'agencies' => $agencies,
            'company_id' => $company_id,
            'agency_id' => $agency_id,
            'position_id' => $position_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'laborers' => $laborers,
            'attendances_all' => $attendances,
            'approved_ot_final' => $approved_ot_final1,
            'schedules' => $schedules,
            'dates' => $dates,
            'positions' => $positions,
            'years' => $years,
            'year_data' => $year_data,
            'dateranges' => $daterange,
            'date_range' => $date_range,
            'daterange_name' => $daterange_name,
            'work_name' => $work_name,
            'salary' => $salary,
            'holidays' => $holidays,
            'holidays_new' => $holidays_new,
            'locations' => $locations,
            'location_id' => $location_id,
            'discount' => $discount,
            'date_from' => $date_from1,
            'date_to' => $date_to1,
            'generates' => $generates,
        )); 
    }
    public function ap_pdf_report(Request $request)
    {
        // $date_range  = $request->date_range;
        // $date_range_value = explode(' - ',$date_range);
        $company_id = $request->company;
        $agency_id = $request->agency;
        $location_id = $request->location;
        $position_id = $request->position;
        $year_data = $request->year_data;
        $holidays = [];
        $holidays_new = [];
        $date_from1 = $request->date_from;
        $date_to1 = $request->date_to;
        // dd($date_to1);
        
        if($date_to1 != null)
        {
            // dd($date_to1);
            $salary = SalaryType::where('agency_id',$agency_id)
            ->where('work_id','=',$position_id)
            ->where('expiration_date','>=',$date_to1)
            ->orderBy('expiration_date','asc')
            ->first()
            ;
            if($salary == null)
            {
                $salary = SalaryType::where('agency_id',$agency_id)
                ->where('work_id','=',$position_id)
                ->where('expiration_date','=',null)
                ->orderBy('id','desc')
                ->first()
                ;
            }
        }   
        else
        {
            $salary = null;
        }
        // dd($salary);
        $companies = Company::orderBy('company_name','asc')->get();
        $agencies = Agency::orderBy('agency_name','asc')->get();
        $positions = Work::orderBy('work_name','asc')->get();
        $locations = Department::orderBy('name','asc')->get();
        $years = Attendance::distinct()->get([DB::raw('YEAR(time_in) as year')]);
        $laborers = [];
        $dates = [];
        $attendances = [];
        $schedules = [];
        $approved_ot_final1 = [];
        $daterange = [];
        $daterange_name = [];
        $discount = [];
        $start_date = null;
        $end_date = null;
        $work_name = null;
        $generate = Generate::with('companyName','UserInfo')
        ->where('agency_id',$agency_id)
        ->where('company_id',$company_id)
        ->where('location_id',$location_id)
        ->where('position_id',$position_id)
        ->where('date_from',$date_from1)
        ->where('date_to',$date_to1)
        ->first();
        if($request->company)
        {
            $work_name = Work::findOrfail($position_id);
            $dateToa = date ("Y-m-d", strtotime("+1 day", strtotime($date_to1)));
            $start_date = $date_from1;
            $from_date = $start_date;
            $to_date = $date_to1;
            $start_date1 = $date_from1;
            $end_date = $date_to1;
            $year = $request->year_data;
            $startDate = $year.'-01-01';
            if($year == date('Y'))
            {
            $endDate = date('Y-m-d');
            }
            else
            {
            $endDate =  $year.'12-31';
            }
            $endDate = strtotime($endDate);
            if('Monday' != date('l',strtotime($startDate)))
            {
               $startDate = date('Y-m-d',strtotime('-1 week',strtotime($startDate)));
            }
            for($i = strtotime('Monday', strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
            {
            $daterange[] = date('Y-m-d', $i).' - '.date('Y-m-d', strtotime('+6 day',$i));
            $daterange_name[] = date('M d, Y', $i).' - '.date('M d, Y', strtotime('+6 day',$i));
            }
            $discount = Work::leftJoin('discounts','works.status','=','discounts.id')
            ->where('works.id','=',$position_id)
            ->select('discounts.*','works.*')
            ->first();
            $laborers = Schedule::whereBetween('date', [$from_date,$to_date])
            ->where('schedules.work_id',$position_id)
            ->where('schedules.company_id',$company_id)
            ->where('schedules.location_id',$location_id)
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
            ->where('laborers.agency_id',$agency_id)
            ->select('laborers.id','laborers.name')
            ->orderBy('laborers.name','asc')
            ->groupBy('laborers.id','laborers.name')
            ->get(['laborers.id','laborers.name']);
            // dd($laborers);
            $laborers_id = collect($laborers)->pluck('id'); 
            $schedules = Schedule::whereBetween('date', [$start_date, $dateToa])
            ->where('schedules.work_id',$position_id)
            ->where('schedules.company_id',$company_id)
            ->where('schedules.location_id',$location_id)
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
            ->where('laborers.agency_id',$agency_id)
            ->whereIn('laborer_id',$laborers_id)
            ->select('schedules.*')
            ->get();
            
            $attendances = Attendance::whereBetween('time_in', [$start_date, $dateToa])
            ->whereIn('laborer_id',$laborers_id)
            ->get();
            // dd($attendances);
            $collection = collect($attendances)->pluck('id'); 
            $approved_ot_final = $collection->toArray();
            $approved_ot = Approved_ot::whereIn('attendance_id',$approved_ot_final)
            ->get();
            if(!empty($approved_ot))
            {
            $approved_ot_final1 = collect($approved_ot)->toArray(); 
            }
            $start_month = date('m',strtotime($start_date));
            $end_month = date('m',strtotime($end_date));
            if(date('Y-m-d') >= '2019-11-13')
            {
                $start_month = date('2019-m-d',strtotime($start_date));
                $end_month = date('2019-m-d',strtotime($end_date));
            }
            $holidays = Holiday::where('status','=','Permanent')->whereBetween('holiday_date',[$start_month, $end_month])->get();
            $holidays_new = Holiday::whereBetween('holiday_date',[$start_date, $end_date])->where('status','=',null)->get();
            
            while (strtotime($start_date1) <= strtotime($end_date)) 
            {
                $dates[]=$start_date1;
                $dateformat[]= date(('M. j, Y'),strtotime($start_date1));
                $start_date1 = date ("Y-m-d", strtotime("+1 day", strtotime($start_date1)));
            }
        }
        $company_name = Company::findOrfail($company_id);
        $agency_name = Agency::findOrfail($agency_id);
        // $work_name = Work::findOrfail($location_id);
        $department_name = Department::findOrfail($location_id);
        $customPaper = array(0,0,500,1006.348);
        // dd($laborers);
        if($date_from1 <= '2020-01-12')
        {
            $pdf = PDF::loadView('ap_report_pdf',array(
                'companies' => $companies,
                'company_name' => $company_name,
                'agency_name' => $agency_name,
                'department_name' => $department_name,
                'agencies' => $agencies,
                'company_id' => $company_id,
                'agency_id' => $agency_id,
                'position_id' => $position_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'laborers' => $laborers,
                'attendances_all' => $attendances,
                'approved_ot_final' => $approved_ot_final1,
                'schedules' => $schedules,
                'dates' => $dates,
                'positions' => $positions,
                'years' => $years,
                'year_data' => $year_data,
                // 'dateranges' => $daterange,
                // 'date_range' => $date_range,
                'daterange_name' => $daterange_name,
                'work_name' => $work_name,
                'salary' => $salary,
                'holidays' => $holidays,
                'holidays_new' => $holidays_new,
                'locations' => $locations,
                'location_id' => $location_id,
                'discount' => $discount,
                'date_from' => $date_from1,
                'date_to' => $date_to1,
                'generate' => $generate,
                ))->setPaper('letter', 'landscape');

        }
        else
        {
            $pdf = PDF::loadView('ap_report_pdf_updated',array(
                'companies' => $companies,
                'company_name' => $company_name,
                'agency_name' => $agency_name,
                'department_name' => $department_name,
                'agencies' => $agencies,
                'company_id' => $company_id,
                'agency_id' => $agency_id,
                'position_id' => $position_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'laborers' => $laborers,
                'attendances_all' => $attendances,
                'approved_ot_final' => $approved_ot_final1,
                'schedules' => $schedules,
                'dates' => $dates,
                'positions' => $positions,
                'years' => $years,
                'year_data' => $year_data,
                // 'dateranges' => $daterange,
                // 'date_range' => $date_range,
                'daterange_name' => $daterange_name,
                'work_name' => $work_name,
                'salary' => $salary,
                'holidays' => $holidays,
                'holidays_new' => $holidays_new,
                'locations' => $locations,
                'location_id' => $location_id,
                'discount' => $discount,
                'date_from' => $date_from1,
                'date_to' => $date_to1,
                'generate' => $generate,
                ))->setPaper('letter', 'landscape');
          
        }
        $length = strlen($generate->reference_id);
        if($length == 1)
        {
            $reference_id = "00".$generate->reference_id;
        }
        elseif($length == 2)
        {
            $reference_id = "0".$generate->reference_id;
        }
        else
        {
            $reference_id = $generate->reference_id;
        }
        
            return $pdf->stream($generate['companyName']->company_name.'-'.date('Y',strtotime($generate->date_from)).'-'.$reference_id.'.pdf');
    }
    public function date_range(Request $request)
    {
        $year = $request->year;
        $daterange = [];
        $daterange_name = [];
        $startDate = $year.'-01-06';
        if($year == date('Y'))
        {
        $endDate = date('Y-m-d');
        }
        else
        {
        $endDate =  $year.'12-31';
        }
        $endDate = strtotime($endDate);
        // for($i = strtotime($startDate);$i <= $endDate;$i = strtotime('+1 day', $i))
        // {
        //     if(date('d', $i) == "06")
        //     {
        //         $daterange[] = date('Y-m-d', $i).' - '.date('Y-m-20', strtotime('+1 day',$i));
        //         $daterange_name[] = date('M d, Y', $i).' - '.date('M 20, Y', strtotime('+1 day',$i));
        //         // $i = date('Y-m-20', strtotime('+1 day',$i));
        //     }
        //     elseif(date('d', $i) == "21")
        //     {
        //         $daterange[] = date('Y-m-d', $i).' - '.date('Y-m-05', strtotime('+1 month',$i));
        //         $daterange_name[] = date('M d, Y', $i).' - '.date('M 05, Y', strtotime('+1 month',$i));
        //         // $i = date('Y-m-05', strtotime('+1 month',$i));
        //     }
        // }
       

        if('Monday' != date('l',strtotime($startDate)))
        {
           $startDate = date('Y-m-d',strtotime('-1 week',strtotime($startDate)));
        }
        
        for($i = strtotime('Monday', strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
        {
        $daterange[] = date('Y-m-d', $i).' - '.date('Y-m-d', strtotime('+6 day',$i));
        $daterange_name[] = date('M d, Y', $i).' - '.date('M d, Y', strtotime('+6 day',$i));
        }
        $data1 = [
            'daterange' => $daterange,
            'daterange_name' => $daterange_name,
        ];
        // dd($data1);
        // dd($data1);
        return $data1;
    }
    public function generateAp(Request $request)
    {
        $company_id = $request->company;
        $agency_id = $request->agency;
        $location_id = $request->location;
        $position_id = $request->position;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        
        $generate = Generate::where('agency_id',$agency_id)->where('agency_id',$agency_id)->where('company_id',$company_id)->where('location_id',$location_id)->where('position_id',$position_id)->where('date_from',$date_from)->first();
        $generateCompany = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->orderBy('id','desc')->first();
        if($generateCompany != null)
        {
            $ref_id  = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->where('reference_id','=',$generateCompany->reference_id)->orderBy('id','desc')->first();
     
            if($ref_id != null)
            {
                $generateCompany = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->orderBy('reference_id','desc')->first();
            }
            else
            {
                $generateCompany = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->orderBy('id','desc')->first();
           
            }

        } // dd($ref_id);
        if($ref_id != null)
        {
            $generateCompany = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->orderBy('reference_id','desc')->first();
        }
        else
        {
            $generateCompany = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->orderBy('id','desc')->first();
       
        }
        if(date('m',strtotime($date_from)) == date('m',strtotime($date_to)))
        {
            if($generate == null)
            {
                if($generateCompany == null)
                {
                    $generateData = new Generate;
                    $generateData->agency_id = $agency_id;
                    $generateData->company_id = $company_id;
                    $generateData->location_id = $location_id;
                    $generateData->position_id = $position_id;
                    $generateData->date_from = $date_from;
                    $generateData->date_to = $date_to;
                    $generateData->reference_id = 1;
                    $generateData->created_by = auth()->user()->id;
                    $generateData->save();
                    $request->session()->flash('status','Successfull');
                    return back();
                }
                else
                {
                    $generateData = new Generate;
                    $generateData->agency_id = $agency_id;
                    $generateData->company_id = $company_id;
                    $generateData->location_id = $location_id;
                    $generateData->position_id = $position_id;
                    $generateData->date_from = $date_from;
                    $generateData->date_to = $date_to;
                    $generateData->reference_id = $generateCompany->reference_id+1;
                    $generateData->created_by = auth()->user()->id;
                    $generateData->save();
                    $request->session()->flash('status','Successfull');
                    return back();
                }
            }
            else
            {
                $request->session()->flash('error_submit','This is already generated!');
                return back();

            }
        }
        else
        {
            if($generate == null)
            {
                if($generateCompany == null)
                {
                    $generateData = new Generate;
                    $generateData->agency_id = $agency_id;
                    $generateData->company_id = $company_id;
                    $generateData->location_id = $location_id;
                    $generateData->position_id = $position_id;
                    $generateData->date_from = $date_from;
                    $generateData->date_to = date("Y-m-t",strtotime($date_from));
                    $generateData->reference_id = 1;
                    $generateData->created_by = auth()->user()->id;
                    $generateData->save();

                    $generateDatanew = new Generate;
                    $generateDatanew->agency_id = $agency_id;
                    $generateDatanew->company_id = $company_id;
                    $generateDatanew->location_id = $location_id;
                    $generateDatanew->position_id = $position_id;
                    $generateDatanew->date_from = date("Y-m-01",strtotime($date_to));
                    $generateDatanew->date_to = $date_to;
                    $generateDatanew->reference_id =  $generateData->reference_id+1;
                    $generateDatanew->created_by = auth()->user()->id;
                    $generateDatanew->save();

                    $request->session()->flash('status','Successfull');
                    return back();
                }
                else
                {
                    $generateData = new Generate;
                    $generateData->agency_id = $agency_id;
                    $generateData->company_id = $company_id;
                    $generateData->location_id = $location_id;
                    $generateData->position_id = $position_id;
                    $generateData->date_from = $date_from;
                    $generateData->date_to = date("Y-m-t",strtotime($date_from));
                    $generateData->reference_id = $generateCompany->reference_id+1;
                    $generateData->created_by = auth()->user()->id;
                    $generateData->save();
                    $generateDatanew = new Generate;
                    $generateDatanew->agency_id = $agency_id;
                    $generateDatanew->company_id = $company_id;
                    $generateDatanew->location_id = $location_id;
                    $generateDatanew->position_id = $position_id;
                    $generateDatanew->date_from = date("Y-m-01",strtotime($date_to));
                    $generateDatanew->date_to = $date_to;
                    $generateDatanew->reference_id = $generateData->reference_id+1;
                    $generateDatanew->created_by = auth()->user()->id;
                    $generateDatanew->save();
                    $request->session()->flash('status','Successfull');
                    return back();
                }
            }
            else
            {
                $request->session()->flash('error_submit','This is already generated!');
                return back();

            }
           
        }
       
    }
    public function generates(Request $request)
    {
        $company = $request->company;
        $companies = Company::whereIn('id',json_decode(auth()->user()->company))->orderBy('company_name','asc')->get();
        if(($request->company == null)||($request->company == 'All'))
        {
            $generates = Generate::with('companyName','UserInfo','AgencyInfo','LocationInfo','PositionInfo')
            ->whereIn('agency_id',json_decode(auth()->user()->agency))
            ->whereIn('position_id',json_decode(auth()->user()->work))
            ->whereIn('company_id',json_decode(auth()->user()->company))
            ->whereIn('location_id',json_decode(auth()->user()->department))
            ->orderBy('created_at','desc')
            ->orderBy('company_id','asc')
            ->orderBy('reference_id','asc')
            ->paginate(30);

        }
        else
        {
            $generates = Generate::with('companyName','UserInfo','AgencyInfo','LocationInfo','PositionInfo')
            ->whereIn('agency_id',json_decode(auth()->user()->agency))
            ->whereIn('position_id',json_decode(auth()->user()->work))
            ->where('company_id',$request->company)
            ->whereIn('location_id',json_decode(auth()->user()->department))
            ->orderBy('created_at','desc')
            ->orderBy('company_id','asc')
            ->orderBy('reference_id','desc')
            ->paginate(30);
        }
       
        
        return view('generate_reports',array
        (
            'generates' => $generates,
            'companies' => $companies,
            'comp' => $company,
           
        )); 
        
    }
    public function saveEditGenerate(Request $request,$generateId)
    {
        $generate = Generate::findOrfail($generateId);
        $generate->remarks = $request->remarks;
        $generate->save();
        $request->session()->flash('status','Successfull');
        return back();
    }
    public function payrollReports (Request $request)
    {
        // $date_range  = $request->date_range;
        // $date_range_value = explode(' - ',$date_range);
       
        $company_id = $request->company;
        $agency_id = $request->agency;
        $location_id = $request->location;
        $position_id = $request->position;
        $year_data = $request->year_data;
        $holidays = [];
        $holidays_new = [];
        $date_from1 = $request->date_from;
        $date_to1 = $request->date_to;
        if($date_to1 != null)
        {
        
                $salary = SalaryType::where('agency_id',$agency_id)
                ->where('work_id','=',$position_id)
                ->where('expiration_date','=',null)
                ->orderBy('id','desc')
                ->first()
                ;
            
        }
        else
        {
            $salary = null;
        }
        $companies = Company::whereIn('id',json_decode(auth()->user()->company))->orderBy('company_name','asc')->get();
        $agencies = Agency::whereIn('id',json_decode(auth()->user()->agency))->orderBy('agency_name','asc')->get();
        $positions = Work::whereIn('id',json_decode(auth()->user()->work))->orderBy('work_name','asc')->get();
        $locations = Department::whereIn('id',json_decode(auth()->user()->department))->orderBy('name','asc')->get();
        $years = Attendance::distinct()->get([DB::raw('YEAR(time_in) as year')]);
        $laborers = [];
        $dates = [];
        $attendances = [];
        $schedules = [];
        $approved_ot_final1 = [];
        $daterange = [];
        $daterange_name = [];
        $discount = [];
        $start_date = null;
        $end_date = null;
        $work_name = null;
        $generates = null;
        if($request->company)
        {
            // $date_from1 = $date_range_value[0];
            // $date_to1 = $date_range_value[1];
            $generates = Generate::with('companyName')
            ->where('agency_id',$agency_id)
            ->where('company_id',$company_id)
            ->where('location_id',$location_id)
            ->where('position_id',$position_id)
            ->whereBetween('date_from',[$date_from1,$date_to1])
            ->get();
            
            $work_name = Work::findOrfail($position_id);
            $dateToa = date ("Y-m-d", strtotime("+1 day", strtotime($date_to1)));
            $start_date = $date_from1;
            $from_date = $start_date;
            $to_date = $date_to1;
            $start_date1 = $date_from1;
            $end_date = $date_to1;
            $year = $request->year_data;
            $startDate = $year.'-01-01';
            if($year == date('Y'))
            {
            $endDate = date('Y-m-d');
            }
            else
            {
            $endDate =  $year.'12-31';
            }
            $endDate = strtotime($endDate);
            if('Monday' != date('l',strtotime($startDate)))
            {
               $startDate = date('Y-m-d',strtotime('-1 week',strtotime($startDate)));
            }
            for($i = strtotime('Monday', strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
            {
            $daterange[] = date('Y-m-d', $i).' - '.date('Y-m-d', strtotime('+6 day',$i));
            $daterange_name[] = date('M d, Y', $i).' - '.date('M d, Y', strtotime('+6 day',$i));
            }
            $discount = Work::leftJoin('discounts','works.status','=','discounts.id')
            ->where('works.id','=',$position_id)
            ->select('discounts.*','works.*')
            ->first();
            $laborers = Schedule::whereBetween('date', [$from_date,$to_date])
            ->where('schedules.work_id',$position_id)
            ->where('schedules.company_id',$company_id)
            ->where('schedules.location_id',$location_id)
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
            ->where('laborers.agency_id',$agency_id)
            ->select('laborers.id','laborers.name')
            ->orderBy('laborers.name','asc')
            ->groupBy('laborers.id','laborers.name')
            ->get(['laborers.id','laborers.name']);
          
            $laborers_id = collect($laborers)->pluck('id'); 
            $schedules = Schedule::whereBetween('date', [$start_date, $dateToa])
            ->where('schedules.work_id',$position_id)
            ->where('schedules.company_id',$company_id)
            ->where('schedules.location_id',$location_id)
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
            ->where('laborers.agency_id',$agency_id)
            ->whereIn('laborer_id',$laborers_id)
            ->select('schedules.*')
            ->get();
            
            $attendances = Attendance::whereBetween('time_in', [$start_date, $dateToa])
            ->whereIn('laborer_id',$laborers_id)
            ->get();
            $collection = collect($attendances)->pluck('id'); 
            $approved_ot_final = $collection->toArray();
            $approved_ot = Approved_ot::whereIn('attendance_id',$approved_ot_final)
            ->get();
            $approved_ot_final1 = collect($approved_ot)->toArray(); 
            $start_month = date('2019-m-d',strtotime($start_date));
            $end_month = date('2019-m-d',strtotime($end_date));
            // dd($start_month);
            $holidays = Holiday::where('status','=','Permanent')->whereBetween('holiday_date',[$start_month, $end_month])->get();
            // dd($holidays);  
            $holidays_new = Holiday::whereBetween('holiday_date',[$start_date, $end_date])->where('status','=',null)->get();
            
            while (strtotime($start_date1) <= strtotime($end_date)) 
            {
                $dates[]=$start_date1;
                $start_date1 = date ("Y-m-d", strtotime("+1 day", strtotime($start_date1)));
            }
        }
        return view('payroll_reports',array
        (
            'companies' => $companies,
            'agencies' => $agencies,
            'company_id' => $company_id,
            'agency_id' => $agency_id,
            'position_id' => $position_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'laborers' => $laborers,
            'attendances_all' => $attendances,
            'approved_ot_final' => $approved_ot_final1,
            'schedules' => $schedules,
            'dates' => $dates,
            'positions' => $positions,
            'years' => $years,
            'year_data' => $year_data,
            'dateranges' => $daterange,
            // 'date_range' => $date_range,
            'daterange_name' => $daterange_name,
            'work_name' => $work_name,
            'salary' => $salary,
            'holidays' => $holidays,
            'holidays_new' => $holidays_new,
            'locations' => $locations,
            'location_id' => $location_id,
            'discount' => $discount,
            'date_from' => $date_from1,
            'date_to' => $date_to1,
            'generates' => $generates,
        )); 
        
    }
    public function payroll_report_pdf(Request $request)
    {
        // $date_range  = $request->date_range;
        // $date_range_value = explode(' - ',$date_range);
        $company_id = $request->company;
        $agency_id = $request->agency;
        $location_id = $request->location;
        $position_id = $request->position;
        $year_data = $request->year_data;
        $holidays = [];
        $holidays_new = [];
        $date_from1 = $request->date_from;
        $date_to1 = $request->date_to;
        if($date_to1 != null)
        {
           
                $salary = SalaryType::where('agency_id',$agency_id)
                ->where('work_id','=',$position_id)
                ->where('expiration_date','=',null)
                ->orderBy('id','desc')
                ->first()
                ;
            
        }   
        else
        {
            $salary = null;
        }
        $companies = Company::orderBy('company_name','asc')->get();
        $agencies = Agency::orderBy('agency_name','asc')->get();
        $positions = Work::orderBy('work_name','asc')->get();
        $locations = Department::orderBy('name','asc')->get();
        $years = Attendance::distinct()->get([DB::raw('YEAR(time_in) as year')]);
        $laborers = [];
        $dates = [];
        $attendances = [];
        $schedules = [];
        $approved_ot_final1 = [];
        $daterange = [];
        $daterange_name = [];
        $discount = [];
        $start_date = null;
        $end_date = null;
        $work_name = null;
        if($request->company)
        {
            $work_name = Work::findOrfail($position_id);
            $dateToa = date ("Y-m-d", strtotime("+1 day", strtotime($date_to1)));
            $start_date = $date_from1;
            $from_date = $start_date;
            $to_date = $date_to1;
            $start_date1 = $date_from1;
            $end_date = $date_to1;
            $year = $request->year_data;
            $startDate = $year.'-01-01';
            if($year == date('Y'))
            {
            $endDate = date('Y-m-d');
            }
            else
            {
            $endDate =  $year.'12-31';
            }
            $endDate = strtotime($endDate);
            if('Monday' != date('l',strtotime($startDate)))
            {
               $startDate = date('Y-m-d',strtotime('-1 week',strtotime($startDate)));
            }
            for($i = strtotime('Monday', strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
            {
            $daterange[] = date('Y-m-d', $i).' - '.date('Y-m-d', strtotime('+6 day',$i));
            $daterange_name[] = date('M d, Y', $i).' - '.date('M d, Y', strtotime('+6 day',$i));
            }
            $discount = Work::leftJoin('discounts','works.status','=','discounts.id')
            ->where('works.id','=',$position_id)
            ->select('discounts.*','works.*')
            ->first();
            $laborers = Schedule::whereBetween('date', [$from_date,$to_date])
            ->where('schedules.work_id',$position_id)
            ->where('schedules.company_id',$company_id)
            ->where('schedules.location_id',$location_id)
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
            ->where('laborers.agency_id',$agency_id)
            ->select('laborers.id','laborers.name')
            ->orderBy('laborers.name','asc')
            ->groupBy('laborers.id','laborers.name')
            ->get(['laborers.id','laborers.name']);
            // dd($laborers);
            $laborers_id = collect($laborers)->pluck('id'); 
            $schedules = Schedule::whereBetween('date', [$start_date, $dateToa])
            ->where('schedules.work_id',$position_id)
            ->where('schedules.company_id',$company_id)
            ->where('schedules.location_id',$location_id)
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
            ->where('laborers.agency_id',$agency_id)
            ->whereIn('laborer_id',$laborers_id)
            ->select('schedules.*')
            ->get();
            
            $attendances = Attendance::whereBetween('time_in', [$start_date, $dateToa])
            ->whereIn('laborer_id',$laborers_id)
            ->get();
            $collection = collect($attendances)->pluck('id'); 
            $approved_ot_final = $collection->toArray();
            $approved_ot = Approved_ot::whereIn('attendance_id',$approved_ot_final)
            ->get();
            
            $approved_ot_final1 = collect($approved_ot)->toArray(); 
            $start_month = date('2019-m-d',strtotime($start_date));
            $end_month = date('2019-m-d',strtotime($end_date));
            $holidays = Holiday::where('status','=','Permanent')->whereBetween('holiday_date',[$start_month, $end_month])->get();
            // dd($holidays);  
            $holidays_new = Holiday::whereBetween('holiday_date',[$start_date, $end_date])->where('status','=',null)->get();
            while (strtotime($start_date1) <= strtotime($end_date)) 
            {
                $dates[]=$start_date1;
                $dateformat[]= date(('M. j, Y'),strtotime($start_date1));
                $start_date1 = date ("Y-m-d", strtotime("+1 day", strtotime($start_date1)));
            }
        }
        $company_name = Company::findOrfail($company_id);
        $agency_name = Agency::findOrfail($agency_id);
        // $work_name = Work::findOrfail($location_id);
        $department_name = Department::findOrfail($location_id);
        // dd($schedules);
        $customPaper = array(0,0,500,1006.348);
        $pdf = PDF::loadView('payroll_report_pdf',array(
            'companies' => $companies,
            'company_name' => $company_name,
            'agency_name' => $agency_name,
            'department_name' => $department_name,
            'agencies' => $agencies,
            'company_id' => $company_id,
            'agency_id' => $agency_id,
            'position_id' => $position_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'laborers' => $laborers,
            'attendances_all' => $attendances,
            'approved_ot_final' => $approved_ot_final1,
            'schedules' => $schedules,
            'dates' => $dates,
            'positions' => $positions,
            'years' => $years,
            'year_data' => $year_data,
            // 'dateranges' => $daterange,
            // 'date_range' => $date_range,
            'daterange_name' => $daterange_name,
            'work_name' => $work_name,
            'salary' => $salary,
            'holidays' => $holidays,
            'holidays_new' => $holidays_new,
            'locations' => $locations,
            'location_id' => $location_id,
            'discount' => $discount,
            'date_from' => $date_from1,
            'date_to' => $date_to1,
            ))->setPaper('letter', 'landscape');
        
            return $pdf->stream('payroll_report.pdf');
    }
    public function monitoring (Request $request)
    {
        ini_set('max_execution_time', 0);
        $company_id = $request->company;
        $companies = Company::orderBy('company_name','asc')->whereIn('id',json_decode(auth()->user()->company))->get();
        $locations = Department::orderBy('name','asc')->get();
        $datefrom = $request->datefrom;
        $dateto = $request->dateto;
        $month = $request->month;
        $locations = [];
        $works = [];
        $attendances = [];
        $schedules = [];
        $dates = [];
        $laborers = [];
        $attendanceDate = [];
        $company_name = [];
        $attendanceLaborerId = [];
        if($datefrom != null)
        {   
            $dateFrom = $datefrom;
            $dateLast = $dateto;
            $company_name = Company::findOrfail($request->company);
            $locations = Schedule::
            leftJoin('departments','location_id','=','departments.id')
            ->whereBetween('date',[$dateFrom,$dateLast])
            ->where('company_id',$company_id)
            ->select('schedules.location_id','departments.name as locationName')
            ->groupBy('location_id','locationName')
            ->get(['location_id','locationName']);

            $works = Schedule::
            leftJoin('works','work_id','=','works.id')
            ->whereBetween('date',[$dateFrom,$dateLast])
            ->where('company_id',$company_id)
            ->select('schedules.location_id','schedules.work_id','works.work_name as workName','works.id')
            ->groupBy('location_id','work_id','workName','works.id')
            ->get(['location_id','work_id','workName','works.id']);
            
            $schedules = Schedule::whereBetween('date',[$dateFrom,$dateLast])
            ->where('company_id',$company_id)
            ->get();
          
            $laborers = Schedule::whereBetween('date',[$dateFrom,$dateLast])
            ->where('schedules.company_id',$company_id)
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.usruid')
            ->select('location_id','schedules.work_id','laborer_id','laborers.name as laborer_name')
            ->groupBy('location_id','schedules.work_id','laborer_id','laborer_name')
            ->orderBy('laborer_name','asc')
            ->get(['location_id','work_id','laborer_id','laborer_name']);
            $laborers_id = collect($laborers)->pluck('laborer_id'); 
            
            $attendances = Attendance::with('ApprovedOT')
            ->whereBetween('time_in', [$dateFrom, $dateLast])
            ->whereIn('laborer_id',$laborers_id)
            ->orderBy('id','asc')
            ->get();
            foreach($attendances as $attendance)
            {
                $attendanceDate[] = date('Y-m-d',strtotime($attendance->time_in));
                $attendanceLaborerId[] = $attendance->laborer_id;
            }
            while (strtotime($dateFrom) <= strtotime($dateLast)) 
            {   
                $dates[]=$dateFrom;
                $dateFrom = date ("Y-m-d", strtotime("+1 day", strtotime($dateFrom)));
            }
        }
        return view('monitoring',array
        (
           'locations' => $locations,
           'companies' => $companies,
           'company_id' => $company_id,
           'month' => $month,
           'datefrom' => $datefrom,
           'dateto' => $dateto,
           'works' => $works,
           'attendances' => $attendances,
           'dates' => $dates,
           'schedules' => $schedules,
           'laborers' => $laborers,
           'attendanceDate' => $attendanceDate,
           'attendanceLaborerId' => $attendanceLaborerId,
           'company_name' => $company_name,
        )); 
    }
    public function generate_records(Request $request)
    {
        $date_range  = $request->date_range;
        $date_range_value = explode(' - ',$date_range);
        $year_data = $request->year_data;
        $daterange_name = [];
        $daterange = [];
        $works = [];
  
        $generates = [];
        $agency_id = $request->agency;
        $agencies = Agency::whereIn('id',json_decode(auth()->user()->agency))->orderBy('agency_name','asc')->get();
        if($year_data)
        {
            $date_from1 = $date_range_value[0];
            $date_to1 = $date_range_value[1];
            $dateToa = date ("Y-m-d", strtotime("+1 day", strtotime($date_to1)));
            $start_date = $date_from1;
            $from_date = $start_date;
            $to_date = $date_to1;
            $start_date1 = $date_from1;
            $end_date = $date_to1;
            $year = $request->year_data;
            $startDate = $year.'-01-01';
            if($year == date('Y'))
            {
                $endDate = date('Y-m-d');
            }
            else
            {
                $endDate =  $year.'12-31';
            }
                $endDate = strtotime($endDate);
            if('Monday' != date('l',strtotime($startDate)))
            {
               $startDate = date('Y-m-d',strtotime('-1 week',strtotime($startDate)));
            }
            for($i = strtotime('Monday', strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
            {
                $daterange[] = date('Y-m-d', $i).' - '.date('Y-m-d', strtotime('+6 day',$i));
                $daterange_name[] = date('M d, Y', $i).' - '.date('M d, Y', strtotime('+6 day',$i));
            }
            $works = Schedule::
            with('CompanyInfo','PositionInfo','LocationInfo')
            ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
            ->leftJoin('agencies','laborers.agency_id','agencies.id')
            ->whereBetween('date',[$date_from1,$date_to1])
            ->whereIn('laborers.agency_id',$agency_id)
            ->whereIn('work_id',json_decode(auth()->user()->work))
            ->whereIn('company_id',json_decode(auth()->user()->company))
            ->whereIn('location_id',json_decode(auth()->user()->department))
            ->select('company_id','location_id','work_id','laborers.agency_id as agency_id','agencies.agency_name as agency_name')
            ->groupBy(['company_id','location_id','work_id','agency_id','agencies.agency_name'])
            ->orderBy('agencies.agency_name','asc')
            ->orderBy('company_id','asc')
            ->orderBy('location_id','asc')
            ->get(['company_id','location_id','work_id','agency_id','agencies.agency_name']);
            // dd($works);
            $generates  = Generate::where('date_from',$date_from1)->get();
            // return $works;
        }

        $years = Attendance::distinct()->get([DB::raw('YEAR(time_in) as year')]);

        return view('generate_records',array
        (
            'generates' => $generates,
            'years' => $years,
            'year_data' => $year_data,
            'dateranges' => $daterange,
            'date_range' => $date_range,
            'daterange_name' => $daterange_name,
            'works' => $works,
            'agencies' => $agencies,
            'agency_id' => $agency_id,
           
        )); 
    }
    public function generateAll(Request $request)
    {
        // dd($request->all());
        // foreach($re)
        $date_range_value = explode(' - ',$request->date);
        // dd ($request->generatedwork);
        $date_from = $date_range_value[0];
        $date_to = $date_range_value[1];
        $date_from1 = $date_range_value[0];
        $date_to1 = $date_range_value[1];
        $agency_id = json_decode($request->agency);
        $works = Schedule::
        with('CompanyInfo','PositionInfo','LocationInfo')
        ->leftJoin('laborers','schedules.laborer_id','=','laborers.id')
        ->leftJoin('agencies','laborers.agency_id','agencies.id')
        ->whereBetween('date',[$date_from1,$date_to1])
        ->whereIn('laborers.agency_id',$agency_id)
        ->whereIn('work_id',json_decode(auth()->user()->work))
        ->whereIn('company_id',json_decode(auth()->user()->company))
        ->whereIn('location_id',json_decode(auth()->user()->department))
        ->select('company_id','location_id','work_id','laborers.agency_id as agency_id','agencies.agency_name as agency_name')
        ->groupBy(['company_id','location_id','work_id','agency_id','agencies.agency_name'])
        ->orderBy('agencies.agency_name','asc')
        ->orderBy('company_id','asc')
        ->orderBy('location_id','asc')
        ->get(['company_id','location_id','work_id','agency_id','agencies.agency_name']);
        foreach($works as $generate)
        {
        $company_id = $generate->company_id;
        $agency_id = $generate->agency_id;
        $location_id = $generate->location_id;
        $position_id = $generate->work_id;
       
        
        $generate = Generate::where('agency_id',$agency_id)->where('agency_id',$agency_id)->where('company_id',$company_id)->where('location_id',$location_id)->where('position_id',$position_id)->where('date_from',$date_from)->first();
        $generateCompany = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->orderBy('id','desc')->first();
        if($generateCompany != null)
        {
            $ref_id  = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->where('reference_id','=',$generateCompany->reference_id)->orderBy('id','desc')->first();
     
            if($ref_id != null)
            {
                $generateCompany = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->orderBy('reference_id','desc')->first();
            }
            else
            {
                $generateCompany = Generate::where('company_id',$company_id)->whereYear('date_from',date('Y',strtotime($date_from)))->orderBy('id','desc')->first();
           
            }

        }
        if(date('m',strtotime($date_from)) == date('m',strtotime($date_to)))
        {
            if($generate == null)
            {
                if($generateCompany == null)
                {
                    $generateData = new Generate;
                    $generateData->agency_id = $agency_id;
                    $generateData->company_id = $company_id;
                    $generateData->location_id = $location_id;
                    $generateData->position_id = $position_id;
                    $generateData->date_from = $date_from;
                    $generateData->date_to = $date_to;
                    $generateData->reference_id = 1;
                    $generateData->created_by = auth()->user()->id;
                    $generateData->save();
                    // $request->session()->flash('status','Successfull');
                    // return back();
                }
                else
                {
                    $generateData = new Generate;
                    $generateData->agency_id = $agency_id;
                    $generateData->company_id = $company_id;
                    $generateData->location_id = $location_id;
                    $generateData->position_id = $position_id;
                    $generateData->date_from = $date_from;
                    $generateData->date_to = $date_to;
                    $generateData->reference_id = $generateCompany->reference_id+1;
                    $generateData->created_by = auth()->user()->id;
                    $generateData->save();
                    // $request->session()->flash('status','Successfull');
                    // return back();
                }
            }
            else
            {
                // $request->session()->flash('error_submit','This is already generated!');
                // return back();

            }
        }
        else
        {
            if($generate == null)
            {
                if($generateCompany == null)
                {
                    $generateData = new Generate;
                    $generateData->agency_id = $agency_id;
                    $generateData->company_id = $company_id;
                    $generateData->location_id = $location_id;
                    $generateData->position_id = $position_id;
                    $generateData->date_from = $date_from;
                    $generateData->date_to = date("Y-m-t",strtotime($date_from));
                    $generateData->reference_id = 1;
                    $generateData->created_by = auth()->user()->id;
                    $generateData->save();

                    $generateDatanew = new Generate;
                    $generateDatanew->agency_id = $agency_id;
                    $generateDatanew->company_id = $company_id;
                    $generateDatanew->location_id = $location_id;
                    $generateDatanew->position_id = $position_id;
                    $generateDatanew->date_from = date("Y-m-01",strtotime($date_to));
                    $generateDatanew->date_to = $date_to;
                    $generateDatanew->reference_id =  $generateData->reference_id+1;
                    $generateDatanew->created_by = auth()->user()->id;
                    $generateDatanew->save();

                    // $request->session()->flash('status','Successfull');
                    // return back();
                }
                else
                {
                    $generateData = new Generate;
                    $generateData->agency_id = $agency_id;
                    $generateData->company_id = $company_id;
                    $generateData->location_id = $location_id;
                    $generateData->position_id = $position_id;
                    $generateData->date_from = $date_from;
                    $generateData->date_to = date("Y-m-t",strtotime($date_from));
                    $generateData->reference_id = $generateCompany->reference_id+1;
                    $generateData->created_by = auth()->user()->id;
                    $generateData->save();
                    $generateDatanew = new Generate;
                    $generateDatanew->agency_id = $agency_id;
                    $generateDatanew->company_id = $company_id;
                    $generateDatanew->location_id = $location_id;
                    $generateDatanew->position_id = $position_id;
                    $generateDatanew->date_from = date("Y-m-01",strtotime($date_to));
                    $generateDatanew->date_to = $date_to;
                    $generateDatanew->reference_id = $generateData->reference_id+1;
                    $generateDatanew->created_by = auth()->user()->id;
                    $generateDatanew->save();
                    // $request->session()->flash('status','Successfull');
                    // return back();
                }
            }
            else
            {
                // $request->session()->flash('error_submit','This is already generated!');
                // return back();

            }
           
        }

        }
        $request->session()->flash('status','Successfull');
        return back();
    }
    public function scheduleall ()
    {
        // dd('renz');
        $schedules = Schedule::
        with('user_info')
        // ->whereBetween('date', ['20190101', '20201230'])
        ->leftJoin('devices', 'schedules.device_id', '=', 'devices.id')
        ->leftJoin('laborers', 'schedules.laborer_id', '=', 'laborers.id')
        ->leftJoin('companies', 'schedules.company_id', '=', 'companies.id')
        ->leftJoin('departments', 'schedules.location_id', '=', 'departments.id')
        ->leftJoin('works', 'schedules.work_id', '=', 'works.id')
        ->select('schedules.*', 'devices.name','laborers.name AS laborer_name','laborers.agency_id AS agency_id','companies.company_name as company_name','departments.name as department_name','works.work_name as work_name')
        ->paginate(25000);
        
        return view('get_schedule_report',array
        (
            'schedules' => $schedules,
        )); 
        
    }
}
