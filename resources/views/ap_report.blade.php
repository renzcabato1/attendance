@extends('layouts.header')
@section('content')
@php
ini_set('memory_limit', '-1');
@endphp
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">AP Report</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <p>{{Auth::user()->name}}
                    <i class='pe-7s-user'></i>
                    <b class="caret"></b>
                </p>
            </a>
            <ul class="dropdown-menu">
                <li><a  data-toggle="modal" data-target="#profile" data-toggle="profle" >Change Password</a></li>
            </ul>
        </li>
    </ul>
</div>
</div>
</nav>
@include('error')
<div class='row col-md-12'>
    @if(session()->has('status'))
    <div class="alert alert-success fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{session()->get('status')}}</strong>
    </div>
    @endif
</div>
<div class='row col-md-12'>
    @if(session()->has('error_submit'))
    <div class="alert alert-danger fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{session()->get('error_submit')}}</strong>
    </div>
    @endif
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <form  method="GET" action="" onsubmit= " return ap_report(); ">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        Agencies
                                        <select data-placeholder="Choose Agency" class="chosen-select form-control" name='agency' id='agency' >
                                            <option ></option>
                                            @foreach($agencies as $agency)
                                            <option value="{{$agency->id}}" {{ ($agency->id == $agency_id) ? 'selected="selected"' : '' }}>{{$agency->agency_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='error' id='agency_error'></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        Companies
                                        <select data-placeholder="Choose Company" class="chosen-select form-control" name='company' id='company' >
                                            <option ></option>
                                            @foreach($companies as $company)
                                            <option value="{{$company->id}}"   {{ ($company->id == $company_id) ? 'selected="selected"' : '' }}  >{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='error' id='company_error'></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        Location
                                        <select data-placeholder="Choose Position" class="chosen-select form-control" name='location' id='location' >
                                            <option ></option>
                                            @foreach($locations as $location)
                                            <option value="{{$location->id}}"   {{ ($location->id == $location_id) ? 'selected="selected"' : '' }}  >{{$location->name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='error' id='location_error'></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        Position
                                        <select data-placeholder="Choose Position" class="chosen-select form-control" name='position' id='position' >
                                            <option ></option>
                                            @foreach($positions as $position)
                                            <option value="{{$position->id}}"   {{ ($position->id == $position_id) ? 'selected="selected"' : '' }}  >{{$position->work_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='error' id='position_error'></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-1">
                                    <div class="form-group">
                                        Year
                                        <select data-placeholder="Choose Position" class="form-control" name='year_data' id='year' onchange='view_date_range()' required >
                                            <option ></option>
                                            @foreach($years as $year)
                                            <option value="{{$year->year}}"   {{ ($year->year == $year_data) ? 'selected="selected"' : '' }}    >{{$year->year}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <p class='error' id='company_error'></p> --}}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        Date
                                        <select data-placeholder="Choose date" class="form-control" name='date_range' id='date_range' required>
                                            <option ></option>
                                            @foreach($dateranges as $key => $daterange)
                                            <option value="{{$daterange}}"  {{ ($date_range == $daterange) ? 'selected="selected"' : '' }}  >{{$daterange_name[$key]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-1">
                                    <div class="form-group">
                                        From
                                    <input name='date_from' class='form-control' value='{{$date_from}}' type='date' required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        To
                                        <input name='date_to' class='form-control' value='{{$date_to}}' type='date' required>
                                    </div>
                                </div> --}}
                                
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <br>
                                        <button type="submit" class="btn btn-info btn-fill">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        @if($laborers != Null) 
        <div class="row">
            <div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        @foreach($holidays as $holiday_new)
                        {{$holiday_new->holiday_name}} - {{date("M. d",strtotime($holiday_new->holiday_date))}} - {{$holiday_new->holiday_type}} <br>
                        @endforeach
                        @foreach($holidays_new as $holiday_new)
                        {{$holiday_new->holiday_name}} - {{date("M. d",strtotime($holiday_new->holiday_date))}} - {{$holiday_new->holiday_type}} <br>
                        @endforeach
                        @if(!$laborers->isEmpty())
                        @if($generates->isEmpty())
                        @if(auth()->user()->generate_role == 1)
                        <a href='{{ url('/generate-ap?date_from='.$date_from.'&date_to='.$date_to.'&agency='.$agency_id.'&company='.$company_id.'&location='.$location_id.'&position='.$position_id) }}' onclick='show()' style='margin:5px;' class="btn btn-success">&#9851; GENERATE</a>
                        @endif
                        
                        @else
                        @foreach($generates as $generate)
                        <a href='{{ url('/print-ap?date_from='.$generate->date_from.'&date_to='.$generate->date_to.'&agency='.$agency_id.'&company='.$company_id.'&location='.$location_id.'&position='.$position_id) }}' target='_' style='margin:5px;' class="btn btn-info">&#128438; PRINT</a> <br>
                        @php
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
                        @endphp
                        Reference Number : {{$generate['companyName']->company_name.'-'.date('Y',strtotime($generate->date_from)).'-'.$reference_id}}<br>
                        @endforeach
                        @endif
                        @endif
                        <table id="example"  class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    {{-- <th>Seq. No.</th> --}}
                                    <th>Employee Name</th>
                                    <th>Days Worked(days)</th>
                                    <th>Over Time(Hour)</th>
                                    <th>ND(Hour)</th>
                                    <th>ND OT(Hour)</th>
                                    <th>RST(days)</th>
                                    <th>RST OT(Hour)</th>
                                    <th>RST ND(Hour)</th>
                                    <th>RST ND OT(Hour)</th>
                                    <th>SH(days)</th>
                                    <th>SH OT(Hour)</th>
                                    <th>SH ND(Hour)</th>
                                    <th>SH ND OT(Hour)</th>
                                    <th>LH(days)</th>
                                    <th>LH OT(Hour)</th>
                                    <th>LH ND(Hour)</th>
                                    <th>LH ND OT(Hour)</th>
                                    <th>RST SH(days)</th>
                                    <th>RST SH OT(Hour)</th>
                                    <th>RST SH ND(Hour)</th>
                                    <th>RST SH ND OT(Hour)</th>
                                    <th>RST LH(days)</th>
                                    <th>RST LH OT(Hour)</th>
                                    <th>RST LH ND(Hour)</th>
                                    <th>RST LH ND OT(Hour)</th>
                                    <th>SH LH(days)</th>
                                    <th>SH LH OT (Hour)</th>
                                    <th>SH LH ND(Hour)</th>
                                    <th>SH LH ND OT(Hour)</th>
                                    <th>LATES(Minutes)</th>
                                    <th>UNDERTIME(Minutes)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $t_work_days = 0;
                                $t_total_approved_ot = 0;
                                $t_total_nd = 0;
                                $t_total_nd_ot = 0;
                                $t_total_rest_day = 0;
                                $t_total_rest_day_ot = 0;
                                $t_total_rest_day_nd = 0;
                                $t_total_rest_day_nd_ot = 0;
                                $t_total_sh_day = 0;
                                $t_total_sh_ot = 0;
                                $t_total_sh_nd = 0;
                                $t_total_sh_nd_ot = 0;
                                $t_total_lh_days = 0;
                                $t_total_lh_ot = 0; 
                                $t_total_lh_nd = 0;
                                $t_total_lh_nd_ot = 0;
                                $t_total_rest_day_sh = 0;
                                $t_total_rest_day_sh_ot = 0;
                                $t_total_rest_day_sh_nd = 0;
                                $t_total_rest_day_sh_nd_ot = 0;
                                $t_total_rest_day_lh = 0;
                                $t_total_rest_day_lh_ot = 0;
                                $t_total_rest_day_lh_nd = 0;
                                $t_total_rest_day_lh_nd_ot = 0;
                                $t_total_sh_lh = 0;
                                $t_total_sh_lh_ot = 0;
                                $t_total_sh_lh_nd = 0;
                                $t_total_sh_lh_nd_ot = 0;
                                $t_total_late = 0;
                                $t_total_under_time = 0;
                                @endphp
                                @foreach($laborers as $sq => $laborer)
                                @php
                                $work_days = 0;
                                $total_approved_ot = 0;
                                $total_nd = 0;
                                $total_nd_ot = 0;
                                $total_rest_day = 0;
                                $total_rest_day_ot = 0;
                                $total_rest_day_nd = 0;
                                $total_rest_day_nd_ot = 0;
                                $total_sh_day = 0;
                                $total_sh_ot = 0;
                                $total_sh_nd = 0;
                                $total_sh_nd_ot = 0;
                                $total_lh_days = 0;
                                $total_lh_ot = 0; 
                                $total_lh_nd = 0;
                                $total_lh_nd_ot = 0;
                                $total_rest_day_sh = 0;
                                $total_rest_day_sh_ot = 0;
                                $total_rest_day_sh_nd = 0;
                                $total_rest_day_sh_nd_ot = 0;
                                $total_rest_day_lh = 0;
                                $total_rest_day_lh_ot = 0;
                                $total_rest_day_lh_nd = 0;
                                $total_rest_day_lh_nd_ot = 0;
                                $total_sh_lh = 0;
                                $total_sh_lh_ot = 0;
                                $total_sh_lh_nd = 0;
                                $total_sh_lh_nd_ot = 0;
                                $total_late = 0;
                                $total_under_time = 0;
                                @endphp
                                <tr>
                                    {{-- <td >{{$sq+1}}</td> --}}
                                    <td>{{$laborer->name}}</td>
                                    @foreach($dates as $date)
                                    @php
                                    $a = 0;
                                    $b = 0;
                                    $schedule_details = 0;
                                    $attendance_details = 0;
                                    $late=0;
                                    $ot = 0;
                                    $undertime=0;
                                    $rd=0;
                                    $rest_day_ot = 0;
                                    $lh=0;
                                    $sh = 0;
                                    $rd_a_ot =0;
                                    $night_diff_hour_ot = 0;
                                    $night_diff_hour = 0;
                                    $night_diff_hour_lh = 0;
                                    $night_diff_hour_lh_ot = 0;
                                    $night_diff_hour_sh = 0;
                                    $night_diff_hour_sh_ot = 0;
                                    @endphp
                                    @foreach($schedules as $schedule)
                                        @php
                                        $ab = 0;
                                        $rd = 0;
                                        $breaktime = 0;
                                        @endphp
                                        @if(($schedule->laborer_id == $laborer->id) && (date('Y-m-d', strtotime($schedule->date)) == $date))
                                        @php
                                        $a = 1 ;
                                        @endphp
                                                @if($schedule->rest_day == 1)
                                                    @php
                                                    $rd = 1;
                                                    @endphp
                                                @endif
                                                @if($schedule->with_breaktime == 1)
                                                    @php
                                                    $breaktime = 1;
                                                    @endphp
                                                @endif
                                                    @php
                                                    $schedule_details = 1;
                                                    ${'first_time' . $laborer->id . $date} = $schedule->date.' '. date("H:i", strtotime($schedule->start_time));
                                                    ${'end_time' . $laborer->id .$date} = $schedule->end_date.' '. date("H:i", strtotime($schedule->end_time));
                                                    break;
                                                @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        $rd_a = 0;
                                        $approved_ot = 0;
                                    @endphp
                                    @foreach($attendances_all as $attendance)
                                     @php
                                         $rd_a = 0;
                                         $approved_ot = 0;
                                     @endphp
                                        @if(($attendance->laborer_id == $laborer->id) && (date('Y-m-d', strtotime($attendance->time_in)) == $date) && ($attendance->time_out != null))
                                            @php
                                            if($a == 1)
                                            {
                                            $b = 1 ;
                                            $rd_a = 1;
                                            $attendance_details = 1;
                                            $approved_ot = array_search($attendance->id, array_column($approved_ot_final, 'attendance_id'));
                                            if ($approved_ot !== false)
                                            {
                                                $rd_a_ot = 1;
                                                $rest_day_ot  = $approved_ot_final[$approved_ot]['approve_ot'];
                                                $total_approved_ot =  $total_approved_ot + $approved_ot_final[$approved_ot]['approve_ot'];
                                                // echo $attendance->laborer_id.' - '.$approved_ot_final[$approved_ot]['approve_ot'].' - '. $attendance->id.' - '.$attendance->time_in.'<br>';
                                            }
                                            else
                                            {
                                                $rest_day_ot  = 0 ;
                                                $total_approved_ot =  $total_approved_ot;
                                            }
                                            ${'time_in' .  $laborer->id . $date} = date('Y-m-d H:i', strtotime($attendance->time_in));
                                            ${'time_out' . $laborer->id. $date} = date('Y-m-d H:i', strtotime($attendance->time_out));

                                            break;
                                            }
                                            @endphp
                                        @endif
                                    @endforeach
                                    
                                    @if(($a == 1 )&&($b == 1))
                                        @php
                                            if($date >= '2019-09-09')
                                            {
                                                $working_hours = ((strtotime(${'end_time' . $laborer->id .$date}) - strtotime(${'first_time' . $laborer->id . $date}))/3600)/8 - $breaktime/8;
                                            }
                                            else {
                                                $working_hours = 1;
                                            }
                                                
                                            $work_days = $work_days + $working_hours;
                                        @endphp
                                    @else
                                        @php
                                            $work_days = $work_days;
                                        @endphp
                                    @endif
                                    @if(($schedule_details == 1) &&($attendance_details == 1))
                                    @php
                                    $late = strtotime(${'time_in' . $laborer->id . $date})-strtotime(${'first_time' . $laborer->id . $date});
                                    $undertime = strtotime(${'time_out' . $laborer->id . $date})-strtotime(${'end_time' . $laborer->id . $date});
                                    
                                    ${'time_in_night_diff' . $laborer->id. $date} = date('H:i', strtotime(${'time_in' .  $laborer->id . $date}));
                                    ${'time_out_night_diff' . $laborer->id. $date} = date('H:i', strtotime( ${'time_out' . $laborer->id. $date}));
                                    ${'time_in_night_diff_date' . $laborer->id. $date} = date('Y-m-d', strtotime(${'time_in' .  $laborer->id . $date}));
                                    ${'night_diff_default_in' . $laborer->id. $date} = ${'time_in_night_diff_date' . $laborer->id. $date}.' 23:00';
                                    ${'night_diff_default_out' . $laborer->id. $date} =  date('Y-m-d H:i:s', strtotime(${'night_diff_default_in' . $laborer->id. $date} . ' + 7 hours'));

                                    if((strtotime(${'night_diff_default_in' . $laborer->id. $date}) >  (strtotime( ${'time_in' .  $laborer->id . $date}))) && (strtotime(${'night_diff_default_in' . $laborer->id. $date}) <  (strtotime( ${'time_out' .  $laborer->id . $date})) ))
                                    {
                                        $night_diff = strtotime(${'night_diff_default_out' . $laborer->id. $date}) - strtotime( ${'time_out' .  $laborer->id . $date});
                                        
                                        if($night_diff < 0)
                                        {
                                            $night_diff_hour = 8;
                                        }
                                        else 
                                        {
                                        $night_diff_hour = 8 - ($night_diff/3600);
                                        }
                                        if((strtotime(${'night_diff_default_in' . $laborer->id. $date}) >  (strtotime( ${'first_time' .  $laborer->id . $date}))) && (strtotime(${'night_diff_default_in' . $laborer->id. $date}) <  (strtotime( ${'end_time' .  $laborer->id . $date})) ))
                                        {
                                            $night_diff_schedule = strtotime(${'night_diff_default_out' . $laborer->id. $date}) - strtotime( ${'end_time' .  $laborer->id . $date});
                                            if($night_diff_schedule < 0)
                                            {
                                                $night_diff_hour = $night_diff_hour;
                                                $night_diff_hour_ot = 0;
                                            }
                                            else {
                                                $night_diff_hour = $night_diff_hour - ($night_diff_schedule/3600);
                                                $night_diff_hour_ot = ($night_diff_schedule/3600);
                                            }
                                           
                                        }
                                        else 
                                        {
                                            if($rd_a_ot == 1)
                                            {
                                              
                                                if($total_approved_ot > $night_diff_hour)
                                                {
                                                $night_diff_hour_ot = $night_diff_hour;
                                                }
                                                else {
                                                    $night_diff_hour_ot = $total_approved_ot;
                                                }
                                                
                                            }
                                            else 
                                            {
                                                $night_diff_hour_ot = 0;
                                            }
                                            $night_diff_hour = 0;
                                        }
                                        // echo $laborer->id." - ".$night_diff_hour_ot."<br>";
                                    }
                                    if($late <= 0)
                                    {
                                        $late = 0 ;
                                    } 
                                    else
                                    {
                                        $late = round(($late/60),0) ;
                                    }
                                    if(($undertime < 3600)&&($undertime >= 0))
                                    {  
                                        $undertime = 0;
                                    }
                                    else if($undertime < 0)
                                    {  
                                        $undertime = round(($undertime/60),0) * -1 ; 
                                    }
                                    else if ($undertime >= 3600)
                                    {  
                                        $undertime = 0; 
                                    }
                                    
                                    if(count($holidays_new))
                                    {
                                        foreach($holidays_new as $holiday_new)
                                        {
                                            if($holiday_new->holiday_date == $date)
                                            {
                                                if($holiday_new->holiday_type == 'Legal Holiday')
                                                {
                                                    $lh = $lh + ($working_hours  - ($late/60/8) - ($undertime/60/8)); 
                                                    $sh = $sh; 
                                                    $work_days =  $work_days - 1;
                                                    $night_diff_hour_lh = $night_diff_hour;
                                                    $night_diff_hour_lh_ot = $night_diff_hour_ot;
                                                    $night_diff_hour = 0;
                                                    $night_diff_hour_ot = 0;
                                                }
                                                else 
                                                {
                                                    $sh = $sh + ($working_hours  - ($late/60/8) - ($undertime/60/8));
                                                    $work_days =  $work_days - $working_hours;
                                                    $lh = $lh ;
                                                    $night_diff_hour_sh = $night_diff_hour;
                                                    $night_diff_hour_sh_ot = $night_diff_hour_ot;
                                                    $night_diff_hour = 0;
                                                    $night_diff_hour_ot = 0;
                                                }
                                                $late = 0;
                                                $undertime = 0;

                                            }
                                            else 
                                            {
                                                $lh = $lh;
                                                $sh = $sh;
                                                $late = $late;
                                                $undertime = $undertime;
                                            }
                                        }
                                    }
                                    if(count($holidays))
                                    {
                                        foreach($holidays as $holiday_new)
                                        {
                                            if(date('m-d',strtotime($holiday_new->holiday_date)) == date('m-d',strtotime($date)))
                                            {
                                                if($holiday_new->holiday_type == 'Legal Holiday')
                                                {
                                                    $lh = $lh + $working_hours  - (($late/60/8)) - (($undertime/60/8));    
                                                    $work_days =  $work_days - $working_hours;
                                                    $sh = $sh; 
                                                    $night_diff_hour_lh = $night_diff_hour;
                                                    $night_diff_hour_lh_ot = $night_diff_hour_ot;
                                                    $night_diff_hour = 0;
                                                    $night_diff_hour_ot = 0;
                                                }
                                                else 
                                                {
                                                    $sh = $sh + $working_hours - (($late/60/8)) - (($undertime/60/8));
                                                    $work_days =  $work_days - $working_hours;
                                                    $lh = $lh ;
                                                    $night_diff_hour_sh = $night_diff_hour;
                                                    $night_diff_hour_sh_ot = $night_diff_hour_ot;
                                                    $night_diff_hour = 0;
                                                    $night_diff_hour_ot = 0;
                                                }
                                                $late = 0;
                                                $undertime = 0;
                                            }
                                            else 
                                            {
                                                $lh = $lh;
                                                $sh = $sh;
                                                $late = $late;
                                                $undertime = $undertime;
                                            }
                                        }
                                    }
                                    @endphp
                                    @else
                                        @php
                                            $late = 0;
                                            $ot = 0;
                                        @endphp
                                    @endif
                                        @if(($rd == 1)&&($rd_a == 1))
                                            @php
                                                $total_rest_day = $total_rest_day + ($working_hours - (($late/60/8)) - (($undertime/60/8)));
                                                // echo $total_rest_day ;
                                                $work_days =  $work_days - $working_hours;
                                                $late = 0;
                                                $undertime = 0;
                                            @endphp
                                        @else
                                            @php
                                                $total_rest_day = $total_rest_day;
                                            @endphp
                                        @endif
                                        @if(($rd == 1)&&($rd_a_ot == 1))
                                            @php
                                                $total_rest_day_ot = $total_rest_day_ot + $rest_day_ot;
                                                $total_approved_ot = $total_approved_ot - $rest_day_ot;
                                            @endphp
                                        @else
                                            @php
                                                $total_rest_day_ot = $total_rest_day_ot ;
                                            @endphp
                                        @endif
                                        @php
                                            $total_nd = $total_nd + $night_diff_hour;
                                            $total_nd_ot = $total_nd_ot + $night_diff_hour_ot;
                                            $total_late = $total_late + $late;
                                            $total_under_time = $total_under_time + $undertime;
                                            $total_sh_day = $total_sh_day + $sh;
                                            $total_lh_days = $total_lh_days + $lh;
                                            $total_sh_nd = $total_sh_nd + $night_diff_hour_sh;
                                            $total_sh_nd_ot = $total_sh_nd_ot + $night_diff_hour_sh_ot;
                                            $total_lh_nd = $total_lh_nd + $night_diff_hour_lh;
                                            $total_lh_nd_ot = $total_lh_nd_ot + $night_diff_hour_lh_ot;
                                        @endphp
                                    @endforeach
                                    <td>{{number_format($work_days,2)}}</td>
                                    <td>{{number_format($total_approved_ot,2)}}</td>
                                    <td>{{number_format($total_nd,2)}}</td>
                                    <td>{{number_format($total_nd_ot,2)}}</td>
                                    <td>{{number_format($total_rest_day,2)}}</td>
                                    <td>{{number_format($total_rest_day_ot,2)}}</td>
                                    <td>{{number_format($total_rest_day_nd,2)}}</td>
                                    <td>{{number_format($total_rest_day_nd_ot,2)}}</td>
                                    <td>{{number_format($total_sh_day,2)}}</td>
                                    <td>{{number_format($total_sh_ot,2)}}</td>
                                    <td>{{number_format($total_sh_nd,2)}}</td>
                                    <td>{{number_format($total_sh_nd_ot,2)}}</td>
                                    <td>{{number_format($total_lh_days,2)}}</td>
                                    <td>{{number_format($total_lh_ot,2)}}</td>
                                    <td>{{number_format($total_lh_nd,2)}}</td>
                                    <td>{{number_format($total_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($total_rest_day_sh,2)}}</td>
                                    <td>{{number_format($total_rest_day_sh_ot,2)}}</td>
                                    <td>{{number_format($total_rest_day_sh_nd,2)}}</td>
                                    <td>{{number_format($total_rest_day_sh_nd_ot,2)}}</td>
                                    <td>{{number_format($total_rest_day_lh,2)}}</td>
                                    <td>{{number_format($total_rest_day_lh_ot,2)}}</td>
                                    <td>{{number_format($total_rest_day_lh_nd,2)}}</td>
                                    <td>{{number_format($total_rest_day_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($total_sh_lh,2)}}</td>
                                    <td>{{number_format($total_sh_lh_ot,2)}}</td>
                                    <td>{{number_format($total_sh_lh_nd,2)}}</td>
                                    <td>{{number_format($total_sh_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($total_late,2)}}</td>
                                    <td>{{number_format($total_under_time,2)}}</td>
                                    @php
                                    $t_work_days = $t_work_days + $work_days;
                                    $t_total_approved_ot = $t_total_approved_ot + $total_approved_ot;
                                    $t_total_nd = $t_total_nd + $total_nd;
                                    $t_total_nd_ot = $t_total_nd_ot + $total_nd_ot;
                                    $t_total_rest_day =  $t_total_rest_day + $total_rest_day;
                                    $t_total_rest_day_ot = $t_total_rest_day_ot + $total_rest_day_ot;
                                    $t_total_rest_day_nd = $t_total_rest_day_nd + $total_rest_day_nd;
                                    $t_total_rest_day_nd_ot = $t_total_rest_day_nd_ot + $total_rest_day_nd_ot;
                                    $t_total_sh_day = $t_total_sh_day + $total_sh_day;
                                    $t_total_sh_ot = $t_total_sh_ot + $total_sh_ot;
                                    $t_total_sh_nd = $t_total_sh_nd + $total_sh_nd;
                                    $t_total_sh_nd_ot =  $t_total_sh_nd_ot + $total_sh_nd_ot;
                                    $t_total_lh_days = $t_total_lh_days + $total_lh_days;
                                    $t_total_lh_ot =  $t_total_lh_ot + $total_lh_ot; 
                                    $t_total_lh_nd = $t_total_lh_nd + $total_lh_nd;
                                    $t_total_lh_nd_ot = $t_total_lh_nd_ot + $total_lh_nd_ot;
                                    $t_total_rest_day_sh = $t_total_rest_day_sh + $total_rest_day_sh;
                                    $t_total_rest_day_sh_ot = $t_total_rest_day_sh_ot + $total_rest_day_sh_ot;
                                    $t_total_rest_day_sh_nd =  $t_total_rest_day_sh_nd + $total_rest_day_sh_nd;
                                    $t_total_rest_day_sh_nd_ot =  $t_total_rest_day_sh_nd_ot + $total_rest_day_sh_nd_ot;
                                    $t_total_rest_day_lh = $t_total_rest_day_lh + $total_rest_day_lh;
                                    $t_total_rest_day_lh_ot = $t_total_rest_day_lh_ot + $total_rest_day_lh_ot;
                                    $t_total_rest_day_lh_nd = $t_total_rest_day_lh_nd + $total_rest_day_lh_nd;
                                    $t_total_rest_day_lh_nd_ot = $t_total_rest_day_lh_nd_ot + $total_rest_day_lh_nd_ot;
                                    $t_total_sh_lh = $t_total_sh_lh + $total_sh_lh;
                                    $t_total_sh_lh_ot =  $t_total_sh_lh_ot + $total_sh_lh_ot;
                                    $t_total_sh_lh_nd =  $t_total_sh_lh_nd + $total_sh_lh_nd;
                                    $t_total_sh_lh_nd_ot = $t_total_sh_lh_nd_ot + $total_sh_lh_nd_ot;
                                    $t_total_late = $t_total_late + $total_late;
                                    $t_total_under_time = $t_total_under_time + $total_under_time;
                                    @endphp
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td>{{number_format($t_work_days,2)}}</td>
                                    <td>{{number_format($t_total_approved_ot,2)}}</td>
                                    <td>{{number_format($t_total_nd,2)}}</td>
                                    <td>{{number_format($t_total_nd_ot,2)}}</td>
                                    <td>{{number_format($t_total_rest_day,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_ot,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_nd,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_nd_ot,2)}}</td>
                                    <td>{{number_format($t_total_sh_day,2)}}</td>
                                    <td>{{number_format($t_total_sh_ot,2)}}</td>
                                    <td>{{number_format($t_total_sh_nd,2)}}</td>
                                    <td>{{number_format($t_total_sh_nd_ot,2)}}</td>
                                    <td>{{number_format($t_total_lh_days,2)}}</td>
                                    <td>{{number_format($t_total_lh_ot,2)}}</td>
                                    <td>{{number_format($t_total_lh_nd,2)}}</td>
                                    <td>{{number_format($t_total_lh_nd_ot,2) }}</td>
                                    <td>{{number_format($t_total_rest_day_sh,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_sh_ot,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_sh_nd,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_sh_nd_ot,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_lh,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_lh_ot,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_lh_nd,2)}}</td>
                                    <td>{{number_format($t_total_rest_day_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($t_total_sh_lh,2)}}</td>
                                    <td>{{number_format($t_total_sh_lh_ot,2)}}</td>
                                    <td>{{number_format($t_total_sh_lh_nd,2)}}</td>
                                    <td>{{number_format($t_total_sh_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($t_total_late,2)}}</td>
                                    <td>{{number_format($t_total_under_time,2)}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($salary)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width" style="overflow-x:auto;">
                        <table  class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    {{-- <th>Seq. No.</th> --}}
                                    <th>{{$work_name->work_name}}</th>
                                    <th>Basic Salary</th>
                                    <th>13 Month Pay</th>
                                    <th>SIL</th>
                                    <th>Hazard Pay</th>
                                    <th>ECOLA</th>
                                    <th>Due to EE</th>
                                    <th>SSS</th>
                                    <th>PH</th>
                                    <th>HDMF</th>
                                    <th>EC</th>
                                    <th>PPE</th>
                                    <th>EE Welfare Benefits</th>
                                    <th>Daily Rate</th>
                                    <th>10% service fee</th>
                                    <th>Total</th>
                                    <th>Rendered Time</th>
                                    <th>Computation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>REGULAR DAILY RATE </td>
                                    <td>{{$salary->basic_salary}}</td>
                                    <td>{{$salary->thirteen_month_salary}}</td>
                                    <td>{{$salary->sil}}</td>
                                    <td>{{$salary->hazard_pay}}</td>
                                    <td>{{$salary->ecola}}</td>
                                    <td>{{$salary->basic_salary+$salary->thirteen_month_salary+$salary->sil+$salary->hazard_pay+$salary->ecola}}</td>
                                    <td>{{$salary->sss}}</td>
                                    <td>{{$salary->ph}}</td>
                                    <td>{{$salary->hdmf}}</td>
                                    <td>{{$salary->ec}}</td>
                                    <td>{{$salary->ppe}}</td>
                                    <td>{{$salary->sss+$salary->ph+$salary->hdmf+$salary->ec+$salary->ppe}}</td>
                                    @php
                                    $daily_rate = $salary->basic_salary+$salary->thirteen_month_salary+$salary->sil+$salary->hazard_pay+$salary->ecola+$salary->sss+$salary->ph+$salary->hdmf+$salary->ec+$salary->ppe;
                                    $service_fee = $daily_rate*.1;
                                    $total = $daily_rate + $service_fee;
                                    $computation = $t_work_days * $total;
                                    
                                    $daily_rate_nd = round((($salary->basic_salary + $salary->sss)/8 * .1),2);
                                    $total_basic_pay_nd = round(($daily_rate_nd+round((($daily_rate_nd*.1)),2)),2);
                                    $computation_nd = $total_basic_pay_nd * $t_total_nd;
                                    $daily_rate_ot = round((($salary->basic_salary + $salary->sss)/8 * 1.25),2);
                                    $computation_ot = round(($t_total_approved_ot*round(($daily_rate_ot+round((($daily_rate_ot*.1)),2)),2)),2);
                                    $daily_rate_ot = round((($salary->basic_salary + $salary->sss)/8 * 1.25),2);
                                    $daily_rate_nd_ot = round((($salary->basic_salary + $salary->sss)/8 * 1.25)*.1,2);
                                    $computation_nd_ot = round((round($daily_rate_nd_ot + round($daily_rate_nd_ot*.1,2),2) *  $t_total_nd_ot),2);
                                    
                                    $daily_rate_rest_day =round( ($salary->basic_salary + $salary->sss + $salary->ecola) * 1.3,2);
                                    $computation_rest_day = round((round(($daily_rate_rest_day+round($daily_rate_rest_day*.1,2)),2) *  $t_total_rest_day),2);
                                    $daily_rate_rest_day_nd = round((((($salary->basic_salary + $salary->sss)*1.3))/8)*.1,2);
                                    $computation_rest_day_nd = round((round(($daily_rate_rest_day_nd+round($daily_rate_rest_day_nd*.1,2)),2) *  $t_total_rest_day_nd),2);
                                    $daily_rate_rest_day_ot = round((((($salary->basic_salary + $salary->sss)*1.69))/8),2);
                                    $computation_rest_day_ot = round((round(($daily_rate_rest_day_ot+round($daily_rate_rest_day_ot*.1,2)),2) *  $t_total_rest_day_ot),2);
                                    $daily_rate_rest_day_nd_ot = round((((($salary->basic_salary + $salary->sss)*1.69))/8)*.1,2);
                                    $computation_rest_day_nd_ot = round((round(($daily_rate_rest_day_nd_ot+round($daily_rate_rest_day_nd_ot*.1,2)),2) *  $t_total_rest_day_nd_ot),2);
                                    
                                    $daily_rate_sh = round(((($salary->basic_salary + $salary->sss + $salary->ecola)*1.3)),2);
                                    $computation_sh = round((round(($daily_rate_sh+round($daily_rate_sh*.1,2)),2) *  $t_total_sh_day),2);
                                    $daily_rate_sh_nd = round((((($salary->basic_salary + $salary->sss)*1.3)/8)*.1),2);
                                    $computation_sh_nd = round((round(($daily_rate_sh_nd+round($daily_rate_sh_nd*.1,2)),2) *  $t_total_sh_nd),2);
                                    $daily_rate_sh_ot = round((((($salary->basic_salary + $salary->sss)*1.69)/8)),2);
                                    $computation_sh_ot = round((round(($daily_rate_sh_ot+round($daily_rate_sh_ot*.1,2)),2) *  $t_total_sh_ot),2);
                                    $daily_rate_sh_nd_ot = round((((($salary->basic_salary + $salary->sss)*1.69)/8)*.1),2);
                                    $computation_sh_nd_ot = round((round(($daily_rate_sh_nd_ot+round($daily_rate_sh_nd_ot*.1,2)),2) *  $t_total_sh_nd_ot),2);
                                    
                                    $daily_rate_lh = ((($salary->basic_salary + $salary->sss + $salary->ecola) * 2.0 ));
                                    $computation_lh = round((round(($daily_rate_lh+round($daily_rate_lh*.1,2)),2) *  $t_total_lh_days),2);
                                    $daily_rate_lh_nd = round((((($salary->basic_salary + $salary->sss)*2)/8)*.1),2);
                                    $computation_lh_nd = round((round(($daily_rate_lh_nd+round($daily_rate_lh_nd*.1,2)),2) *  $t_total_lh_nd),2);
                                    $daily_rate_lh_ot = round((((($salary->basic_salary + $salary->sss)*2.6)/8)),2);
                                    $computation_lh_ot = round((round(($daily_rate_lh_ot+round($daily_rate_lh_ot*.1,2)),2) *  $t_total_lh_ot),2);
                                    $daily_rate_lh_nd_ot = round((((($salary->basic_salary + $salary->sss)*2.6)/8)*.1),2);
                                    $computation_lh_nd_ot = round((round(($daily_rate_lh_nd_ot+round($daily_rate_lh_nd_ot*.1,2)),2) *  $t_total_lh_nd_ot),2);
                                    
                                    
                                    $daily_rate_rest_day_sh = ((($salary->basic_salary + $salary->sss + $salary->ecola) * 1.5 ));
                                    $computation_rest_day_sh = round((round(($daily_rate_rest_day_sh+round($daily_rate_rest_day_sh*.1,2)),2) *  $t_total_rest_day_sh),2);
                                    $daily_rate_rest_day_sh_nd = round((((($salary->basic_salary + $salary->sss)*1.5)/8)*.1),2);
                                    $computation_rest_day_sh_nd = round((round(($daily_rate_rest_day_sh_nd+round($daily_rate_rest_day_sh_nd*.1,2)),2) *  $t_total_rest_day_sh_nd),2);
                                    $daily_rate_rest_day_sh_ot = round((((($salary->basic_salary + $salary->sss)*1.95)/8)),2);
                                    $computation_rest_day_sh_ot = round((round(($daily_rate_rest_day_sh_ot+round($daily_rate_rest_day_sh_ot*.1,2)),2) *  $t_total_rest_day_sh_ot),2);
                                    $daily_rate_rest_day_sh_nd_ot = round((((($salary->basic_salary + $salary->sss)*1.95)/8)*.1),2);
                                    $computation_rest_day_sh_nd_ot = round((round(($daily_rate_rest_day_sh_nd_ot+round($daily_rate_rest_day_sh_nd_ot*.1,2)),2) *  $t_total_rest_day_sh_nd_ot),2);
                                    
                                    $daily_rate_rest_day_lh = ((($salary->basic_salary + $salary->sss + $salary->ecola) * 2.6 ));
                                    $computation_rest_day_lh = round((round(($daily_rate_rest_day_lh+round($daily_rate_rest_day_lh*.1,2)),2) *  $t_total_rest_day_lh),2);
                                    $daily_rate_rest_day_lh_nd = round((((($salary->basic_salary + $salary->sss)*2.6)/8)*.1),2);
                                    $computation_rest_day_lh_nd = round((round(($daily_rate_rest_day_lh_nd+round($daily_rate_rest_day_lh_nd*.1,2)),2) *  $t_total_rest_day_lh_nd),2);
                                    $daily_rate_rest_day_lh_ot = round((((($salary->basic_salary + $salary->sss)*3.38)/8)),2);
                                    $computation_rest_day_lh_ot = round((round(($daily_rate_rest_day_lh_ot+round($daily_rate_rest_day_lh_ot*.1,2)),2) *  $t_total_rest_day_lh_ot),2);
                                    $daily_rate_rest_day_lh_nd_ot = round((((($salary->basic_salary + $salary->sss)*3.38)/8)*.1),2);
                                    $computation_rest_day_lh_nd_ot = round((round(($daily_rate_rest_day_lh_nd_ot+round($daily_rate_rest_day_lh_nd_ot*.1,2)),2) *  $t_total_rest_day_lh_nd_ot),2);
                                    
                                    $daily_rate_sh_lh = ((($salary->basic_salary + $salary->sss + $salary->ecola) * 2.6 ));
                                    $computation_sh_lh = round((round(($daily_rate_sh_lh+round($daily_rate_sh_lh*.1,2)),2) *  $t_total_sh_lh),2);
                                    $daily_rate_sh_lh_nd = round((((($salary->basic_salary + $salary->sss)* 2.6)/8)*.1),2);
                                    $computation_sh_lh_nd = round((round(($daily_rate_sh_lh_nd+round($daily_rate_sh_lh_nd*.1,2)),2) *  $t_total_sh_lh_nd),2);
                                    $daily_rate_sh_lh_ot = round((((($salary->basic_salary + $salary->sss)*3.38)/8)),2);
                                    $computation_sh_lh_ot = round((round(($daily_rate_sh_lh_ot+round($daily_rate_sh_lh_ot*.1,2)),2) *  $t_total_sh_lh_ot),2);
                                    $daily_rate_sh_lh_nd_ot = round((((($salary->basic_salary + $salary->sss)*3.38)/8)*.1),2);
                                    $computation_sh_lh_nd_ot = round((round(($daily_rate_sh_lh_nd_ot+round($daily_rate_sh_lh_nd_ot*.1,2)),2) *  $t_total_sh_lh_nd_ot),2);
                                    
                                    $late_rate = ((($daily_rate/8)/60));
                                    $computation_late = (((($late_rate+($late_rate*.1))) *  $t_total_late));
                                    $undertime_rate =  ((($daily_rate/8)/60));
                                    $computation_undertime= (((($undertime_rate+($undertime_rate*.1))) *  $t_total_under_time));
                                    $total_gross_amount = $computation + $computation_nd + $computation_ot + $computation_nd_ot + $computation_rest_day + $computation_rest_day_nd + $computation_rest_day_ot + $computation_rest_day_nd_ot 
                                    + $computation_sh + $computation_sh_nd + $computation_sh_ot + $computation_sh_nd_ot + $computation_lh + $computation_lh_nd + $computation_lh_ot + $computation_lh_nd_ot + $computation_rest_day_sh + $computation_rest_day_sh_nd
                                    + $computation_rest_day_sh_ot + $computation_rest_day_sh_nd_ot + $computation_rest_day_lh + $computation_rest_day_lh_nd + $computation_rest_day_lh_nd + $computation_rest_day_lh_ot + $computation_rest_day_lh_nd_ot 
                                    + $computation_sh_lh + $computation_sh_lh_nd + $computation_sh_nd_ot + $computation_sh_lh_nd_ot - $computation_late -  $computation_undertime;
                                    $discount_value = ($discount->discount_percent)/100;
                                    $total_less_discount = (($total_gross_amount/1.1)*$discount_value);
                                    $discounted_amount = ($total_gross_amount - $total_less_discount);
                                    $total_vat = (($discounted_amount*.12));
                                    $billable_amount = ($total_vat + $discounted_amount);
                                    $less_ewt_discounted_amount =  ($discounted_amount *.02);
                                    $total_net_amount_due = ($billable_amount - $less_ewt_discounted_amount);
                                    @endphp
                                    <td>{{number_format($daily_rate,2)}}</td>
                                    <td>{{number_format($service_fee,2)}}</td>
                                    <td>{{number_format($total,2)}}</td>
                                    <td>{{number_format($t_work_days,2)}}</td>
                                    <td>{{number_format($computation,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Regular Night Diff (Basic Pay + SSS)/8*.1 </td>
                                    <td colspan=12></td>
                                    
                                    <td>{{number_format($daily_rate_nd,2)}}</td>
                                    <td>{{number_format((($daily_rate_nd*.1)),2)}}</td>
                                    <td>{{number_format($total_basic_pay_nd,2)}}</td>
                                    <td>{{number_format($t_total_nd,2)}}</td>
                                    <td>{{number_format($computation_nd,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Regular OT (Basic Pay + SSS)*1.25 /8</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_ot,2)}}</td>
                                    <td>{{number_format((($daily_rate_ot*.1)),2)}}</td>
                                    <td>{{number_format(($daily_rate_ot+number_format((($daily_rate_ot*.1)),2)),2)}}</td>
                                    <td>{{number_format($t_total_approved_ot,2)}}</td>
                                    <td>{{number_format($computation_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Regular OT Night Diff (Basic Pay + SSS)*1.25/8*.1</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_nd_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_nd_ot*.1,2)}}</td>
                                    <td>{{number_format($daily_rate_nd_ot + number_format($daily_rate_nd_ot*.1,2),2)}}</td>
                                    <td>{{number_format($t_total_nd_ot,2)}}</td>
                                    <td>{{number_format($computation_nd_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday (Basic Pay + SSS + ECOLA)*1.3 - First 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day+number_format($daily_rate_rest_day*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day,2)}}</td>
                                    <td>{{number_format($computation_rest_day,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday ND (Basic Pay + SSS)*1.3/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_nd,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_nd*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_nd+number_format($daily_rate_rest_day_nd*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_nd,2)}}</td>
                                    <td>{{number_format($computation_rest_day_nd,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday OT (Basic Pay + SSS)*1.69/8 - in excess of 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_ot+number_format($daily_rate_rest_day_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_ot,2)}}</td>
                                    <td>{{number_format($computation_rest_day_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday OT ND (Basic Pay + SSS)*1.69/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_nd_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_nd_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_nd_ot+number_format($daily_rate_rest_day_nd_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_nd_ot,2)}}</td>
                                    <td>{{number_format($computation_rest_day_nd_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Special Holiday (Basic Pay + SSS + ECOLA)*1.3 - First 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_sh,2)}}</td>
                                    <td>{{number_format($daily_rate_sh*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_sh+number_format($daily_rate_sh*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_sh_day,2)}}</td>
                                    <td>{{number_format($computation_sh,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Special Holiday ND (Basic Pay + SSS)*1.3/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_sh_nd,2)}}</td>
                                    <td>{{number_format($daily_rate_sh_nd*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_sh_nd+number_format($daily_rate_sh_nd*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_sh_nd,2)}}</td>
                                    <td>{{number_format($computation_sh_nd,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Special Holiday OT (Basic Pay + SSS)*1.69/8 - in excess of 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_sh_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_sh_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_sh_ot+number_format($daily_rate_sh_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_sh_ot,2)}}</td>
                                    <td>{{number_format($computation_sh_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Special Holiday OT ND (Basic Pay + SSS)*1.69/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_sh_nd_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_sh_nd_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_sh_nd_ot+number_format($daily_rate_sh_nd_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_sh_nd_ot,2)}}</td>
                                    <td>{{number_format($computation_sh_nd_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Legal Holiday (Basic Pay + SSS + ECOLA)*2 - First 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_lh,2)}}</td>
                                    <td>{{number_format($daily_rate_lh*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_lh+number_format($daily_rate_lh*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_lh_days,2)}}</td>
                                    <td>{{number_format($computation_lh,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Legal Holiday ND (Basic Pay + SSS)*2/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_lh_nd,2)}}</td>
                                    <td>{{number_format($daily_rate_lh_nd*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_lh_nd+number_format($daily_rate_lh_nd*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_lh_nd,2)}}</td>
                                    <td>{{number_format($computation_lh_nd,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Legal Holiday OT (Basic Pay + SSS)*2.6/8 - in excess of 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_lh_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_lh_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_lh_ot+number_format($daily_rate_lh_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_lh_ot,2)}}</td>
                                    <td>{{number_format($computation_lh_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Legal Holiday OT ND (Basic Pay + SSS)*2.6/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_lh_nd_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_lh_nd_ot+number_format($daily_rate_lh_nd_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($computation_lh_nd_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday and Special Holiday (Basic Pay + SSS + ECOLA)*1.5 - First 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_sh,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_sh*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_sh+number_format($daily_rate_rest_day_sh*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_sh,2)}}</td>
                                    <td>{{number_format($computation_rest_day_sh,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday and Special Holiday ND (Basic Pay + SSS)*1.5/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_sh_nd,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_sh_nd*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_sh_nd+number_format($daily_rate_rest_day_sh_nd*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_sh_nd,2)}}</td>
                                    <td>{{number_format($computation_rest_day_sh_nd,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday and Special Holiday OT (Basic Pay + SSS)*1.95/8 - in excess of 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_sh_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_sh_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_sh_ot+number_format($daily_rate_rest_day_sh_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_sh_ot,2)}}</td>
                                    <td>{{number_format($computation_rest_day_sh_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday and Special Holiday OT ND (Basic Pay + SSS)*1.95/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_sh_nd_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_sh_nd_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_sh_nd_ot+number_format($daily_rate_rest_day_sh_nd_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_sh_nd_ot,2)}}</td>
                                    <td>{{number_format($computation_rest_day_sh_nd_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday and Legal Holiday (Basic Pay + SSS + ECOLA)*2.6 - First 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_lh,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_lh*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_lh+number_format($daily_rate_rest_day_lh*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_lh,2)}}</td>
                                    <td>{{number_format($computation_rest_day_lh,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday and Legal Holiday ND (Basic Pay + SSS)*2.6/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_lh_nd,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_lh_nd*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_lh_nd+number_format($daily_rate_rest_day_lh_nd*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_lh_nd,2)}}</td>
                                    <td>{{number_format($computation_rest_day_lh_nd,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday and Legal Holiday OT (Basic Pay + SSS)*3.38/8 - in excess of 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_lh_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_lh_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_lh_ot+number_format($daily_rate_rest_day_lh_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_lh_ot,2)}}</td>
                                    <td>{{number_format($computation_rest_day_lh_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Restday and Legal Holiday OT ND (Basic Pay + SSS)*3.38/8*.1- 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_rest_day_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_rest_day_lh_nd_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_rest_day_lh_nd_ot+number_format($daily_rate_rest_day_lh_nd_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_rest_day_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($computation_rest_day_lh_nd_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Special Holiday and Legal Holiday (Basic Pay + SSS + ECOLA)*2.6 - First 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_sh_lh,2)}}</td>
                                    <td>{{number_format($daily_rate_sh_lh*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_sh_lh+number_format($daily_rate_sh_lh*.1,2)),2)}}</td>
                                    
                                    <td>{{number_format($t_total_sh_lh,2)}}</td>
                                    <td>{{number_format($computation_sh_lh,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Special Holiday and Legal Holiday ND (Basic Pay + SSS)*2.6/8*.1 - 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_sh_lh_nd,2)}}</td>
                                    <td>{{number_format($daily_rate_sh_lh_nd*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_sh_lh_nd+number_format($daily_rate_sh_lh_nd*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_sh_lh_nd,2)}}</td>
                                    <td>{{number_format($computation_sh_lh_nd,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Special Holiday and Legal Holiday OT (Basic Pay + SSS)*3.38/8 - in excess of 8 Hours</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_sh_lh_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_sh_lh_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_sh_lh_ot+number_format($daily_rate_sh_lh_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_sh_lh_ot,2)}}</td>
                                    <td>{{number_format($computation_sh_lh_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Special Holiday and Legal Holiday OT ND (Basic Pay + SSS)*3.38/8*.1- 10PM to 6AM</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($daily_rate_sh_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($daily_rate_sh_lh_nd_ot*.1,2)}}</td>
                                    <td>{{number_format(($daily_rate_sh_lh_nd_ot+number_format($daily_rate_sh_lh_nd_ot*.1,2)),2)}}</td>
                                    <td>{{number_format($t_total_sh_lh_nd_ot,2)}}</td>
                                    <td>{{number_format($computation_sh_lh_nd_ot,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Late</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($late_rate,2)}}</td>
                                    <td>{{number_format($late_rate*.1,2)}}</td>
                                    <td>{{number_format(($late_rate+($late_rate*.1)),2)}}</td>
                                    <td>{{number_format($t_total_late,2)}}</td>
                                    <td>{{number_format($computation_late,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Undertime</td>
                                    <td colspan=12></td>
                                    <td>{{number_format($undertime_rate,2)}}</td>
                                    <td>{{number_format($undertime_rate*.1,2)}}</td>
                                    <td>{{number_format(($undertime_rate+($undertime_rate*.1)),2)}}</td>
                                    <td>{{number_format($t_total_under_time,2)}}</td>
                                    <td>{{number_format($computation_undertime,2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan=18></td>
                                </tr>
                                <tr>
                                    <td>Gross Amount</td>
                                    <td colspan=12></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{number_format($total_gross_amount,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Less: {{$discount->discount_percent}}% Discount (Gross Amount / 1.10  x {{$discount_value}})</td>
                                    <td colspan=12></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{number_format($total_less_discount,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Discounted Amount</td>
                                    <td colspan=12></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{number_format($discounted_amount,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Add: 12% VAT</td>
                                    <td colspan=12></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{number_format($total_vat,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Billable Amount</td>
                                    <td colspan=12></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{number_format($billable_amount,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Less: 2% EWT (Discounted Amount X .02)</td>
                                    <td colspan=12></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{number_format($less_ewt_discounted_amount,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Net Amount Due</td>
                                    <td colspan=12></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{number_format($total_net_amount_due,2)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @else
        NO RATES FOUND
        @endif
        @endif
    </div>
</div>
<script>
    function ap_report() 
    {
        
        if(document.getElementById('company').value.length==0)
        { 
            document.getElementById('company_error').innerHTML = "This Field is Required";
            return false;
        }
        else 
        {
            document.getElementById('company_error').innerHTML = "";
        }
        if(document.getElementById('agency').value.length==0)
        { 
            document.getElementById('agency_error').innerHTML = "This Field is Required";
            return false;
        }
        else 
        {
            document.getElementById('agency_error').innerHTML = "";
        }
        if(document.getElementById('agency').value.length==0)
        { 
            document.getElementById('agency_error').innerHTML = "This Field is Required";
            return false;
        }
        else 
        {
            document.getElementById('agency_error').innerHTML = "";
        }
        if(document.getElementById('position').value.length==0)
        { 
            document.getElementById('position_error').innerHTML = "This Field is Required";
            return false;
        }
        else 
        {
            document.getElementById('position_error').innerHTML = "";
        }
        if(document.getElementById('location').value.length==0)
        { 
            document.getElementById('location_error').innerHTML = "This Field is Required";
            return false;
        }
        else 
        {
            document.getElementById('location_error').innerHTML = "";
        }
        if((document.getElementById('company').value.length==0)||(document.getElementById('agency').value.length==0)||(document.getElementById('position').value.length==0)||(document.getElementById('location').value.length==0))
        {
            return false;
        }
        else
        {
            document.getElementById("myDiv").style.display="block";
        }
    }
    function view_date_range()
    {
        var year = document.getElementById("year").value;
        $('#date_range').empty();
        
        document.getElementById("myDiv").style.display="block";
        $.ajax({    //create an ajax request to load_page.php
            
            type: "GET",
            url: "{{ url('/get-date-range/') }}",            
            data: {
                "year" : year,
            }     ,
            dataType: "json",   //expect html to be returned
            success: function(data){    
                document.getElementById("myDiv").style.display="none";
                $('#date_range').append('<option ></option>');
                // console.log(data);
                jQuery.each(data.daterange, function(daterange) {
                    $('#date_range').append('<option value="'+  data.daterange[daterange] +'">'+  data.daterange_name[daterange] +'</option>');
                });
            },
            error: function(e)
            {
                alert(e);
            }
            
        });
    }
</script>
@endsection


