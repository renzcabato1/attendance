<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laborer;
use App\Device;
use App\Schedule;
use App\Attendance;
use App\Attendance_history;
use App\Verification;
use Auth;
use App\Approved_ot;
use App\Work;
use App\Company;
use App\Department;
use App\Agency;
use App\Generate;
use App\For_verification_remark;


class ScheduleController extends Controller
{
    public function view_schedule(Request $request)
    {
        if (!Auth::user()){
            return view('login');
        }
        else{
            $dateToa = date ("Y-m-d", strtotime("+1 day", strtotime($request->to)));
            $dateTo = $request->to;
            $dateFrom = $request->from;
            $from_date = $request->from;
            $to_date = $request->to;
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
            $laborers = [];
            if($laborer_ids){
                $schedules = Schedule::whereBetween('date', [$dateFrom, $dateToa])
                ->leftJoin('devices', 'schedules.device_id', '=', 'devices.id')
                ->leftJoin('laborers', 'schedules.laborer_id', '=', 'laborers.id')
                ->leftJoin('companies', 'schedules.company_id', '=', 'companies.id')
                ->leftJoin('departments', 'schedules.location_id', '=', 'departments.id')
                ->leftJoin('works', 'schedules.work_id', '=', 'works.id')
                ->whereIn('laborer_id',$laborer_ids)
                ->select('schedules.*', 'devices.name','laborers.name AS laborer_name','laborers.agency_id AS agency_id','companies.company_name as company_name','departments.name as department_name','works.work_name as work_name')
                ->get();
                $remarks = For_verification_remark::whereBetween('date_remarks', [$dateFrom, $dateTo])
                ->whereIn('laborer_id',$laborer_ids)
                ->get();
                $verification_details = Verification::whereBetween('date_verified', [$dateFrom, $dateTo])
                ->whereIn('laborer_id',$laborer_ids)
                ->get();
                $attendances = Attendance::whereBetween('time_in', [$dateFrom, $dateToa])
                ->whereIn('laborer_id',$laborer_ids)
                ->get();
                $laborers = Laborer::whereIn('id',$laborer_ids)
                ->get(['id','name']);
                $name_all = $laborers;
                $schedules_all[] = $schedules;
                $attendances_all[] = $attendances;
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
           
            $approved_ot_final1 = collect($approved_ot)->toArray(); 
            $attendance_history1 = collect($attendance_history)->toArray(); 
            $remarks = collect($remarks)->toArray(); 
            $verification_details = collect($verification_details)->toArray(); 
            $generate = Generate::orderBy('date_to','desc')->first();
         
            return view('view_schedule',array
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
                'generate' => $generate,
                )
            ); 
        }
    }
    public function new_schedule()
    {
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
            $laborers = Laborer::where('active','AC')->whereIn('agency_id',json_decode(auth()->user()->agency))->orderBy('name','asc')->get();
        }
        $error = null;
        $devices = Device::where('name','like','%entrance%')->orderBy('name','asc')->get();
        $locations = Work::orderBy('work_name','asc')->get();
        $agencies = Agency::orderBy('agency_name','asc')->get();
        $companies = Company::orderBy('company_name','asc')->whereIn('id',json_decode(auth()->user()->company))->get();
        $departments = Department::orderBy('name','asc')->whereIn('id',json_decode(auth()->user()->department))->get();
        $positions = Work::orderBy('work_name','asc')->whereIn('id',json_decode(auth()->user()->work))->get();
        // dd($positions);
        $generate = Generate::orderBy('date_to','desc')->first();
        return view('new_schedule',array
        (
            'laborers' => $laborers,
            'devices' => $devices,
            'error' => $error,
            'locations' => $locations,
            'agencies' => $agencies,
            'companies' => $companies,
            'departments' => $departments,
            'positions' => $positions,
            'generate' => $generate,
            )
        ); 
    }
    public function save_new_schedule(Request $request)
    {
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
            $laborers = Laborer::where('active','AC')->whereIn('agency_id',json_decode(auth()->user()->agency))->orderBy('name','asc')->get();
        }
        $locations = Work::orderBy('work_name','asc')->get();
        $devicess = Device::orderBy('name','asc')->get();
        $months = explode(', ',$request->month);
        $laborers = $request->laborer;
        $week = $request->week;
        $day = $request->day;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $devices = $request->devices;
        $nextday = $request->nextday;
        $restday = $request->restday;
        $validation = 0;
        if($nextday == 1)
        {
            foreach($months as $month)
            {
                foreach($devices as $device)
                {
                    foreach($laborers as $laborer)
                    {
                        $schedule = Schedule::where('date','=',date("Y-m-d", strtotime($month)))
                        ->where('laborer_id','=',$laborer)
                        ->get();
                        if(!$schedule->isEmpty())
                        {
                            $validation  = 1;
                            
                        }
                    }
                }
            }    
            $laborers = $request->laborer;
            $week = $request->week;
            $day = $request->day;
            $start_time = $request->start_time;
            $end_time = $request->end_time;
            $device = $request->devices;
            $nextday = $request->nextday;
            $restday = $request->restday;
            $department_id = $request->department;
            $break = $request->break;
            $work_id = $request->position;
            $company_id = $request->company;
            if($validation == 1)
            {
                $request->session()->flash('status','Some of schedule exist already! Please Verify');
                return view('new_schedule',array
                (
                    'laborers' => $laborerss,
                    'devices' => $devicess,
                    'restday' => $restday,
                    'nextday' => $nextday,
                    'devicesss' => $device,
                    'end_time' => $end_time,
                    'start_time' => $start_time,
                    'labs' => $laborers,
                    'month' => $months,
                    'locations' => $locations,
                    'department_id' =>$department_id,
                    'work_id' => $work_id,
                    'company_id' => $company_id,
                    'break' => $break,
                    'error' => 'a',
                )); 
            }
            else
            {
                foreach($months as $month)
                {
                    foreach($devices as $device)
                    {
                        foreach($laborers as $laborer)
                        {
                            $data = new Schedule;
                            $data->date = date("Y-m-d", strtotime($month));
                            $data->end_date = date("Y-m-d", strtotime("+1 day", strtotime(date("Y-m-d", strtotime($month)))));
                            $data->laborer_id = $laborer;
                            $data->start_time = $start_time;
                            $data->end_time = $end_time;
                            $data->device_id = $device;
                            $data->rest_day = $restday;
                            $data->created_by = auth()->user()->id;
                            $data->work_id = $request->position;
                            $data->location_id = $request->department;
                            $data->company_id = $request->company;
                            $data->with_breaktime = $request->break;
                            $data->created_by = auth()->user()->id;
                            $data->save();
                            $request->session()->flash('status','All Schedule Posted');
                        }
                    }
                }
                return redirect('/new-schedule');
            }
        }
        else
        {
            foreach($months as $month)
            {
                foreach($devices as $device)
                {
                    foreach($laborers as $laborer)
                    {
                        $schedule = Schedule::where('date','=',date("Y-m-d", strtotime($month)))
                        ->where('laborer_id','=',$laborer)
                        ->get();
                        if(!$schedule->isEmpty())
                        {
                            $validation  = 1;
                        }
                    }
                }
                $laborers = $request->laborer;
                $week = $request->week;
                $day = $request->day;
                $start_time = $request->start_time;
                $end_time = $request->end_time;
                $device = $request->devices;
                $nextday = $request->nextday;
                $restday = $request->restday;
                if($validation == 1)
                {
                    $request->session()->flash('status','Some of schedule exist already! Please Verify');
                    return view('new_schedule',array
                    (
                        'laborers' => $laborerss,
                        'devices' => $devicess,
                        'restday' => $restday,
                        'nextday' => $nextday,
                        'devicesss' => $device,
                        'end_time' => $end_time,
                        'start_time' => $start_time,
                        'labs' => $laborers,
                        'month' => $months,
                        'locations' => $locations,
                        'department_id' =>$department_id,
                        'work_id' => $work_id,
                        'company_id' => $company_id,
                        'error' => 'a',
                    )); 
                }
                else
                {
                    foreach($months as $month)
                    {
                        foreach($devices as $device)
                        {
                            foreach($laborers as $laborer)
                            {
                                $data = new Schedule;
                                $data->date =  date("Y-m-d", strtotime($month));
                                $data->end_date =  date("Y-m-d", strtotime($month));
                                $data->laborer_id = $laborer;
                                $data->start_time = $start_time;
                                $data->end_time = $end_time;
                                $data->device_id = $device;
                                $data->rest_day = $restday;     
                                $data->created_by = auth()->user()->id;
                                $data->work_id = $request->position;
                                $data->location_id = $request->department;
                                $data->company_id = $request->company;
                                $data->with_breaktime = $request->break;
                                $data->save();
                                $request->session()->flash('status','All Schedule Posted');
                            }
                        }
                    }
                    return redirect('/new-schedule');
                }
                
            }
        }
    }
    public function save_edit_schedule(Request $request, $id)
    {
        // dd($request->all());
        $this->validate(request(),[
            'start_time' => 'required|max:255',
            'end_time' => 'required|max:255',
            'device_name' => 'required|max:255',
            ]    
        ); 
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $device_name = $request->device_name;
        $date = $request->date;
        $nextday = $request->nextday;
        $restday = $request->restday;
        if($nextday == 1)
        {
            $data =  Schedule::find($id);
            $data->start_time =  $start_time;
            $data->end_time =  $end_time;
            $data->device_id =  $device_name;
            $data->rest_day =  $restday;
            $data->with_breaktime =  $request->breaktime;
            $data->end_date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            $data->save();
            $request->session()->flash('status',' Successfully Changed!');
            return back();
        }
        else
        {
            $this->validate(request(),[
                'end_time' => 'required|max:255|after_or_equal:start_time',
                ]    
                ,[
                    'after_or_equal'    => 'The End time must be greater than to Start time!']
                ); 
                $data =  Schedule::find($id);
                $data->start_time =  $start_time;
                $data->end_time =  $end_time;
                $data->device_id =  $device_name;
                $data->end_date =  $date;
                $data->rest_day =  $restday;
                $data->with_breaktime =  $request->breaktime;
                $data->save();
                $request->session()->flash('status',' Successfully Changed!');
                return back();
                
            }
            
    }
    public function delete_schedule(Request $request,$id)
    {
        $schedule = Schedule::find($id);    
        $schedule->delete();
        $request->session()->flash('status',' Successfully Deleted!');
        return back();
    }
    public function add_schedule(Request $request)
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
            $data = new Schedule;
            $data->date = $request->date;
            $data->end_date = date("Y-m-d", strtotime("+1 day", strtotime($request->date)));
            $data->laborer_id = $request->name;
            $data->start_time = $request->start_time;
            $data->end_time = $request->end_time;
            $data->device_id = $request->device_name;
            $data->rest_day = $request->rest_day;
            $data->save();
            $request->session()->flash('status',' Schedule Newly Added!');
            return back();
        }
        else
        {
            $data = new Schedule;
            $data->date = $request->date;
            $data->end_date = $request->date;
            $data->laborer_id = $request->name;
            $data->start_time = $request->start_time;
            $data->end_time = $request->end_time;
            $data->device_id = $request->device_name;
            $data->rest_day = $request->rest_day;
            $data->save();
            $request->session()->flash('status',' Schedule Newly Added!');
            return back();
        }
    }
}
    