<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Laborer;
use App\Attendance;
use App\Schedule;
use App\Approved_ot;
use App\SalaryType;
use Input;
use Redirect;
use App\User;
use App\Role;
use App\Department;
use App\Agency;
use App\Company;
use App\Work;
use App\Holiday;
use Illuminate\Support\Facades\DB;
class AccountController extends Controller
{
    //
    public function login(Request $request)
    { 
        if (!Auth::user()){
            return view('login');
        }
        else{
            if(auth()->user()->role == 3)
            {
                return redirect('ap');
            }
            else if(auth()->user()->role == 6)
            {
                return redirect('monitoring');
            }
            else if(auth()->user()->role == 7)
            {
                return redirect('laborers');
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
    public function try_login(Request $request)
    {  
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
            ->withErrors($validator) // send back all errors to the login form
            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } 
        else {
            
            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );
            
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                if(auth()->user()->role == 3)
            {  
                return redirect('ap');
            }
            else if(auth()->user()->role == 6)
            {
                return redirect('monitoring');
            }
            else if(auth()->user()->role == 7)
            {
                return redirect('laborers');
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
            else {
                // send back all errors to the login form
                // validation not successful, send back to form 
                $request->session()->flash('status', 'Sorry, the email and password you entered do not match.');
                return Redirect::to('login');
            }
        }
        
    }
    public function change_password(Request $request)
    {
        $this->validate(request(),[
            'password' => 'required|min:8|confirmed',
            ]    
        ); 
        $data =  User::find(auth()->user()->id);
        $data->password = bcrypt($request->input('password'));
        $data->save();
        $request->session()->flash('status','Your Password Successfully Changed!');
        return back();
    }
    public function useraccount(Request $request)
    {
        $search = $request->name;
        $accounts = User::leftJoin('roles', 'users.role', '=', 'roles.id')
        ->where('users.id','!=',auth()->user()->id)
        ->where(function($q) use($search) {
            $q->where('name', 'like', '%'.$search.'%');
        })
        ->orderBy('name','asc')
        ->select('users.*', 'roles.role AS role_name')
        ->paginate(10);
        
        $departments = Department::orderBy('name','asc')->get();
        $department_array = collect($departments)->toArray();
        $companies = Company::orderBy('company_name','asc')->get();
        $company_array = collect($companies)->toArray();
        $roles = Role::orderBy('id','asc')->get();
        $positions = Work::orderBy('work_name','asc')->get();
        $position_array = collect($positions)->toArray();
        $agencies = Agency::orderBy('agency_name','asc')->get();
        $agencies_array = collect($agencies)->toArray();
        return view('account_list',array
        (
            'accounts' => $accounts,
            'departments' => $departments,
            'roles' => $roles,
            'agencies' => $agencies,
            'department_array' => $department_array,
            'company_array' => $company_array,
            'agencies_array' => $agencies_array,
            'position_array' => $position_array,
            'companies' => $companies,
            'positions' => $positions,
            
        )); 
    }
    public function edit_user(Request $request, $id)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:255||regex:/^[\pL\s\-]+$/u',
            'email' => 'unique:users,email,'.$id,
            ]    
        ); 
        
        $data =  User::find($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->department = json_encode($request->department);
        $data->agency = json_encode($request->agency);
        $data->company = json_encode($request->company);
        $data->work = json_encode($request->position);
        $data->role = $request->input('role');
        $data->save();
        $request->session()->flash('status',$data->name . ' Successfully Changed!');
        return back();
        
    }
    public function reset_account(Request $request, $id)
    {
        
        $data =  User::find($id);
        $data->password = bcrypt('12345678');
        $data->save();
        $request->session()->flash('status',$data->email . ' new password was 12345678 ');
        return back();
        
    }
    public function new_account(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            ]    
        );
        
        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->role;
        $data->department = json_encode($request->department);
        $data->agency = json_encode($request->agency);
        $data->company = json_encode($request->company);
        $data->work = json_encode($request->position);
        $data->password = bcrypt($request->password);
        $data->save();
     

        $request->session()->flash('status',$data->email . ' successfully registered ');
        return back();
    }
    public function view_users_controller()
    {
        $user = User::get();
        return $user;
    }
    public function deactivate_account(Request $request,$id)
    {
        $account = User::findOrfail($id);
        $account->status_account = 1;
        $account->save();
        $request->session()->flash('status',$account->email . ' successfully deactivated ');
        return back();
    }
    public function activate_account(Request $request,$id)
    {
        $account = User::findOrfail($id);
        $account->status_account = null;
        $account->save();
        $request->session()->flash('status',$account->email . ' successfully activated ');
        return back();
    }
}
