
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="{{ asset('/images/icon.png')}}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        .page_break { page-break-before: always; }
        body { margin-top: 65px; }
        #first 
        {
            display:none;
        }
        table { 
            border-spacing: 0;
            border-collapse: collapse;
        }
        body{
            font-family: Calibri;
            font-size: 10px;
        }
        .page-break {
            page-break-after: always;
        }
        header {
            position: fixed;
            top: -35px;
            left: 0px;
            right: 0px;
            
            /** Extra personal styles **/
            /* background-color: #03a9f4; */
            color: black;
            text-align: left;
            font
        }
        .footer
        {
            position: fixed;
            top: 750px;
            left: 500px;
            right: 0px;
            height: 50px;
        }
        .fixed
        {
            position: fixed;
            top: -35px;
            left: 800px;
            right: 0px;
            height: 50px;
        }
        .page-number:after { content: counter(page); }
    </style>
</head>
<body> 
        @php
        ini_set('memory_limit', '-1');
    @endphp
        <table border='1' id ='first' >
                <tr>
                    {{-- <th>Seq. No.</th> --}}
                    <th width='100px'>Employee Name</th>
                    <th>Days Worked (days)</th>
                    <th>Over Time (Hour)</th>
                    <th>ND (Hour)</th>
                    <th>ND OT (Hour)</th>
                    <th>RST (days)</th>
                    <th>RST OT (Hour)</th>
                    <th>RST ND (Hour)</th>
                    <th>RST ND OT (Hour)</th>
                    <th>SH (days)</th>
                    <th>SH OT (Hour)</th>
                    <th>SH ND (Hour)</th>
                    <th>SH ND OT (Hour)</th>
                    <th>LH (days)</th>
                    <th>LH OT (Hour)</th>
                    <th>LH ND (Hour)</th>
                    <th>LH ND OT (Hour)</th>
                    <th>RST SH (days)</th>
                    <th>RST SH OT (Hour)</th>
                    <th>RST SH ND (Hour)</th>
                    <th>RST SH ND OT (Hour)</th>
                    <th>RST LH (days)</th>
                    <th>RST LH OT (Hour)</th>
                    <th>RST LH ND (Hour)</th>
                    <th>RST LH ND OT (Hour)</th>
                    <th>SH LH (days)</th>
                    <th>SH LH OT (Hour)</th>
                    <th>SH LH ND (Hour)</th>
                    <th>SH LH ND OT (Hour)</th>
                    <th>LATES (Minutes)</th>
                    <th>UNDERTIME (Minutes)</th>
                </tr>
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
                            if($approved_ot_final[$approved_ot]['created_at'] <= $generate->created_at)
                            {
                                $total_approved_ot =  $total_approved_ot + $approved_ot_final[$approved_ot]['approve_ot'];
                            }
                            else {
                                $total_approved_ot =  $total_approved_ot;
                            }

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
                        $working_hours = ((strtotime(${'end_time' . $laborer->id .$date}) - strtotime(${'first_time' . $laborer->id . $date}))/3600)/8;
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
                                    $work_days =  $work_days - $working_hours;
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
                        //   dd(date('m-d',strtotime($holiday_new->holiday_date)));
                        //   dd(date('m-d',strtotime($date)));
                            if(date('m-d',strtotime($holiday_new->holiday_date)) == date('m-d',strtotime($date)))
                            {
                                if($holiday_new->holiday_type == 'Legal Holiday')
                                {
                                    $lh = $lh + ($working_hours  - (($late/60/8)) - (($undertime/60/8))); 
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
                    $total_rest_day = $total_rest_day + $working_hours - (($late/60/8)) - (($undertime/60/8));;
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
                     if($date_from > '2019-09-23')
                    {
                     if($total_approved_ot == 0)
                    {
                        $night_diff_hour_ot = 0;
                    }
                    }
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
                <tr>
                    <td> <b> Total </b></td>
                    <td><b>{{number_format($t_work_days,2)}}</b></td>
                    <td><b>{{number_format($t_total_approved_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_nd,2)}}</b></td>
                    <td><b>{{number_format($t_total_nd_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_nd,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_nd_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_sh_day,2)}}</b></td>
                    <td><b>{{number_format($t_total_sh_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_sh_nd,2)}}</b></td>
                    <td><b>{{number_format($t_total_sh_nd_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_lh_days,2)}}</b></td>
                    <td><b>{{number_format($t_total_lh_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_lh_nd,2)}}</b></td>
                    <td><b>{{number_format($t_total_lh_nd_ot,2) }}</b></td>
                    <td><b>{{number_format($t_total_rest_day_sh,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_sh_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_sh_nd,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_sh_nd_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_lh,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_lh_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_lh_nd,2)}}</b></td>
                    <td><b>{{number_format($t_total_rest_day_lh_nd_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_sh_lh,2)}}</b></td>
                    <td><b>{{number_format($t_total_sh_lh_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_sh_lh_nd,2)}}</b></td>
                    <td><b>{{number_format($t_total_sh_lh_nd_ot,2)}}</b></td>
                    <td><b>{{number_format($t_total_late,2)}}</b></td>
                    <td><b>{{number_format($t_total_under_time,2)}}</b></td>
                </tr>
            
            </table>
              
   


@if($t_total_approved_ot <= 0)
<style>
    .second tr th:nth-child(3)
    {
        display: none;
    }
    .second tr td:nth-child(3)
    {
        display: none;
    }
  
</style>
@endif

@if($t_total_nd <= 0)
<style>
    .second tr th:nth-child(4)
    {
        display: none;
    }
    .second tr td:nth-child(4)
    {
        display: none;
    }
</style>
@endif

@if($t_total_nd_ot <= 0)
<style>
    .second tr th:nth-child(5)
    {
        display: none;
    }
    .second tr td:nth-child(5)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day <= 0)
<style>
    .second tr th:nth-child(6)
    {
        display: none;
    }
    .second tr td:nth-child(6)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_ot <= 0)
<style>
    .second tr th:nth-child(7)
    {
        display: none;
    }
    .second tr td:nth-child(7)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_nd <= 0)
<style>
    .second tr th:nth-child(8)
    {
        display: none;
    }
    .second tr td:nth-child(8)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_nd_ot <= 0)
<style>
    .second tr th:nth-child(9)
    {
        display: none;
    }
    .second tr td:nth-child(9)
    {
        display: none;
    }
</style>
@endif

@if($t_total_sh_day <= 0)
<style>
    .second tr th:nth-child(10)
    {
        display: none;
    }
    .second tr td:nth-child(10)
    {
        display: none;
    }
</style>
@endif

@if($t_total_sh_ot <= 0)
<style>
    .second tr th:nth-child(11)
    {
        display: none;
    }
    .second tr td:nth-child(11)
    {
        display: none;
    }
</style>
@endif

@if($t_total_sh_nd <= 0)
<style>
    .second tr th:nth-child(12)
    {
        display: none;
    }
    .second tr td:nth-child(12)
    {
        display: none;
    }
</style>
@endif

@if($t_total_sh_nd_ot <= 0)
<style>
    .second tr th:nth-child(13)
    {
        display: none;
    }
    .second tr td:nth-child(13)
    {
        display: none;
    }
</style>
@endif

@if($t_total_lh_days <= 0)
<style>
    .second tr th:nth-child(14)
    {
        display: none;
    }
    .second tr td:nth-child(14)
    {
        display: none;
    }
</style>
@endif

@if($t_total_lh_ot <= 0)
<style>
    .second tr th:nth-child(15)
    {
        display: none;
    }
    .second tr td:nth-child(15)
    {
        display: none;
    }
</style>
@endif

@if($t_total_lh_nd <= 0)
<style>
    .second tr th:nth-child(16)
    {
        display: none;
    }
    .second tr td:nth-child(16)
    {
        display: none;
    }
</style>
@endif

@if($t_total_lh_nd_ot <= 0)
<style>
    .second tr th:nth-child(17)
    {
        display: none;
    }
    .second tr td:nth-child(17)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_sh <= 0)
<style>
    .second tr th:nth-child(18)
    {
        display: none;
    }
    .second tr td:nth-child(18)
    {
        display: none;
    }
</style>
@endif


@if($t_total_rest_day_sh_ot <= 0)
<style>
    .second tr th:nth-child(19)
    {
        display: none;
    }
    .second tr td:nth-child(19)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_sh_nd <= 0)
<style>
    .second tr th:nth-child(20)
    {
        display: none;
    }
    .second tr td:nth-child(20)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_sh_nd_ot <= 0)
<style>
    .second tr th:nth-child(21)
    {
        display: none;
    }
    .second tr td:nth-child(21)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_lh <= 0)
<style>
    .second tr th:nth-child(22)
    {
        display: none;
    }
    .second tr td:nth-child(22)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_lh_ot <= 0)
<style>
    .second tr th:nth-child(23)
    {
        display: none;
    }
    .second tr td:nth-child(23)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_lh_nd <= 0)
<style>
    .second tr th:nth-child(24)
    {
        display: none;
    }
    .second tr td:nth-child(24)
    {
        display: none;
    }
</style>
@endif

@if($t_total_rest_day_lh_nd_ot <= 0)
<style>
    .second tr th:nth-child(25)
    {
        display: none;
    }
    .second tr td:nth-child(25)
    {
        display: none;
    }
</style>
@endif

@if($t_total_sh_lh <= 0)
<style>
    .second tr th:nth-child(26)
    {
        display: none;
    }
    .second tr td:nth-child(26)
    {
        display: none;
    }
</style>
@endif

@if($t_total_sh_lh_ot <= 0)
<style>
    .second tr th:nth-child(27)
    {
        display: none;
    }
    .second tr td:nth-child(27)
    {
        display: none;
    }
</style>
@endif

@if($t_total_sh_lh_nd <= 0)
<style>
    .second tr th:nth-child(28)
    {
        display: none;
    }
    .second tr td:nth-child(28)
    {
        display: none;
    }
</style>
@endif

@if($t_total_sh_lh_nd_ot <= 0)
<style>
    .second tr th:nth-child(29)
    {
        display: none;
    }
    .second tr td:nth-child(29)
    {
        display: none;
    }
</style>

@endif
<style>
    tr th.noBorder {
  border: 0;
}
  tr th
  {
      border:1px black solid;
  }
  tr td
  {
      border:1px black solid;
  }
</style>
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
    <header>
        <b style='font-size:14px;'> Reference Number : {{$generate['companyName']->company_name.'-'.date('Y',strtotime($generate->date_from)).'-'.$reference_id}}</b><br>
        <div class='noBorder'  style='vertical-align:top;padding-right:30px;'>
                Agency : {{$agency_name->agency_name}}<br>
                Company : {{$company_name->company_name}}<br>
                Department : {{$department_name->name}}<br>
                Position : {{$work_name->work_name}}<br>
                Period : {{date('M. d, Y',strtotime($date_from)).' - '.date('M. d, Y',strtotime($date_to))}}<br>
                Printed By : {{auth()->user()->name}}<br>
                Date and time Printed : {{date('M. d, Y h:i a')}}
            </div>
    </header>
    <div class="footer fixed-section">
        <div class="center">
            <span class="page-number">Page <script type="text/php">echo $PAGE_NUM</script></span>
        </div>
    </div>
    @if(auth()->user()->generate_role == 1)
    @if(date('Y-m-d H:i',strtotime('+1 day',strtotime($generate->created_at))) <= date('Y-m-d H:i'))
    <div class="fixed">
        <div class="center">
            <span style='font-size:18px;'><b>REPRINTED</b></span>
        </div>
    </div>
    @else
    <div class="fixed">
        <div class="center">
            <span style='font-size:18px;'><b>ORIGINAL COPY</b></span>
        </div>
    </div>
    @endif
    @endif
    <div style='display:inline;'>
  
        <div>
    
            <table style='border:0px;'>

                <tr >
                    <td valign="top" style='border:0px;' >
                    
                        <table  class='second' >   
                            <tr>
                                <th style='border:1px black solid;' width='100px'>Employee Name</th>
                                <th>Days Worked (days)</th>
                                <th>Over Time (Hour)</th>
                                <th>ND (Hour)</th>
                                <th>ND OT (Hour)</th>
                                <th>RST (days)</th>
                                <th>RST OT (Hour)</th>
                                <th>RST ND (Hour)</th>
                                <th>RST ND OT (Hour)</th>
                                <th>SH (days)</th>
                                <th>SH OT (Hour)</th>
                                <th>SH ND (Hour)</th>
                                <th>SH ND OT (Hour)</th>
                                <th>LH (days)</th>
                                <th>LH OT (Hour)</th>
                                <th>LH ND (Hour)</th>
                                <th>LH ND OT (Hour)</th>
                                <th>RST SH (days)</th>
                                <th>RST SH OT (Hour)</th>
                                <th>RST SH ND (Hour)</th>
                                <th>RST SH ND OT (Hour)</th>
                                <th>RST LH (days)</th>
                                <th>RST LH OT (Hour)</th>
                                <th>RST LH ND (Hour)</th>
                                <th>RST LH ND OT (Hour)</th>
                                <th>SH LH (days)</th>
                                <th>SH LH OT (Hour)</th>
                                <th>SH LH ND (Hour)</th>
                                <th>SH LH ND OT (Hour)</th>
                                <th>LATES (Minutes)</th>
                                <th>UNDERTIME (Minutes)</th>
                            </tr>
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
                            @if($sq == 40)
                                @php
                                    break;
                                @endphp
                            @endif
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
                                        if($approved_ot_final[$approved_ot]['created_at'] <= $generate->created_at)
                                        {
                                            $total_approved_ot =  $total_approved_ot + $approved_ot_final[$approved_ot]['approve_ot'];
                                        }
                                        else {
                                            $total_approved_ot =  $total_approved_ot;
                                        }
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
                                    $working_hours = ((strtotime(${'end_time' . $laborer->id .$date}) - strtotime(${'first_time' . $laborer->id . $date}))/3600)/8 - ($breaktime/8);
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
                                                $work_days =  $work_days - $working_hours;
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
                                $total_rest_day = $total_rest_day + $working_hours - (($late/60/8)) - (($undertime/60/8));;
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
                                if($date_from > '2019-09-23')
                                {
                                if($total_approved_ot == 0)
                                {
                                    $night_diff_hour_ot = 0;
                                }
                                }
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
                            @if(count($laborers) < 40)
                            <tr >
                                    <td> <b> Total </b></td>
                                    
                                    <td><b>{{number_format($t_work_days,2)}}</b></td>
                                    <td><b>{{number_format($t_total_approved_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_nd,2)}}</b></td>
                                    <td><b>{{number_format($t_total_nd_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_nd,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_nd_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_sh_day,2)}}</b></td>
                                    <td><b>{{number_format($t_total_sh_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_sh_nd,2)}}</b></td>
                                    <td><b>{{number_format($t_total_sh_nd_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_lh_days,2)}}</b></td>
                                    <td><b>{{number_format($t_total_lh_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_lh_nd,2)}}</b></td>
                                    <td><b>{{number_format($t_total_lh_nd_ot,2) }}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_sh,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_sh_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_sh_nd,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_sh_nd_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_lh,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_lh_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_lh_nd,2)}}</b></td>
                                    <td><b>{{number_format($t_total_rest_day_lh_nd_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_sh_lh,2)}}</b></td>
                                    <td><b>{{number_format($t_total_sh_lh_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_sh_lh_nd,2)}}</b></td>
                                    <td><b>{{number_format($t_total_sh_lh_nd_ot,2)}}</b></td>
                                    <td><b>{{number_format($t_total_late,2)}}</b></td>
                                    <td><b>{{number_format($t_total_under_time,2)}}</b></td>
                                    
                                </tr>
                            @endif
                        </table>
                    </td>
                    @if(count($laborers) > 40)
                    <td valign="top" style='border:0px;'> 
                            <table  class='second'  >   
                                    <tr>
                                        <th style='border:1px black solid;' width='100px'>Employee Name</th>
                                        <th>Days Worked (days)</th>
                                        <th>Over Time (Hour)</th>
                                        <th>ND (Hour)</th>
                                        <th>ND OT (Hour)</th>
                                        <th>RST (days)</th>
                                        <th>RST OT (Hour)</th>
                                        <th>RST ND (Hour)</th>
                                        <th>RST ND OT (Hour)</th>
                                        <th>SH (days)</th>
                                        <th>SH OT (Hour)</th>
                                        <th>SH ND (Hour)</th>
                                        <th>SH ND OT (Hour)</th>
                                        <th>LH (days)</th>
                                        <th>LH OT (Hour)</th>
                                        <th>LH ND (Hour)</th>
                                        <th>LH ND OT (Hour)</th>
                                        <th>RST SH (days)</th>
                                        <th>RST SH OT (Hour)</th>
                                        <th>RST SH ND (Hour)</th>
                                        <th>RST SH ND OT (Hour)</th>
                                        <th>RST LH (days)</th>
                                        <th>RST LH OT (Hour)</th>
                                        <th>RST LH ND (Hour)</th>
                                        <th>RST LH ND OT (Hour)</th>
                                        <th>SH LH (days)</th>
                                        <th>SH LH OT (Hour)</th>
                                        <th>SH LH ND (Hour)</th>
                                        <th>SH LH ND OT (Hour)</th>
                                        <th>LATES (Minutes)</th>
                                        <th>UNDERTIME (Minutes)</th>
                                    </tr>
                                    @if($generate->created_at <= '2019-10-19')
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
                                    @endif
                                    @foreach($laborers as $sq => $laborer)

                                    @if(strtotime($generate->date_created) <= strtotime('2020-06-15'))
                                    @php
                                        $d = 37;
                                    @endphp
                                    @else
                                    @php
                                        $d = 39;
                                    @endphp
                                    @endif
                                    @if($sq > $d)
                                    @if($sq == 74)
                                    @break
                                    @endif
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
                                            $working_hours = ((strtotime(${'end_time' . $laborer->id .$date}) - strtotime(${'first_time' . $laborer->id . $date}))/3600)/8;
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
                                                        $work_days =  $work_days - $working_hours;
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
                                                if($holiday_new->holiday_date == $date)
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
                                        $total_rest_day = $total_rest_day + $working_hours - (($late/60/8)) - (($undertime/60/8));;
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
                                        if($total_approved_ot <= 0)
                                        {
                                            $night_diff_hour_ot = 0;
                                        }
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
                                    @endif
                                    @endforeach
                                    @if(count($laborers) < 74)
                                    <tr >
                                        <td> <b> Total </b></td>
                                        
                                        <td><b>{{number_format($t_work_days,2)}}</b></td>
                                        <td><b>{{number_format($t_total_approved_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_day,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_lh_days,2)}}</b></td>
                                        <td><b>{{number_format($t_total_lh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_lh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_lh_nd_ot,2) }}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_sh,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_sh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_sh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_sh_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_lh,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_lh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_lh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_lh_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_lh,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_lh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_lh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_lh_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_late,2)}}</b></td>
                                        <td><b>{{number_format($t_total_under_time,2)}}</b></td>
                                        
                                    </tr>
                                    @endif
                                </table>
                    </td>
                    @endif
                </tr>
            </table>
            @if(count($laborers) >= 74)
            <div class="page_break"></div>
            <table style='border:0px;'>

                    <tr >
                        <td valign="top" style='border:0px;' >
                        
                            <table  class='second' >   
                                <tr>
                                    <th style='border:1px black solid;' width='100px'>Employee Name</th>
                                    <th>Days Worked (days)</th>
                                    <th>Over Time (Hour)</th>
                                    <th>ND (Hour)</th>
                                    <th>ND OT (Hour)</th>
                                    <th>RST (days)</th>
                                    <th>RST OT (Hour)</th>
                                    <th>RST ND (Hour)</th>
                                    <th>RST ND OT (Hour)</th>
                                    <th>SH (days)</th>
                                    <th>SH OT (Hour)</th>
                                    <th>SH ND (Hour)</th>
                                    <th>SH ND OT (Hour)</th>
                                    <th>LH (days)</th>
                                    <th>LH OT (Hour)</th>
                                    <th>LH ND (Hour)</th>
                                    <th>LH ND OT (Hour)</th>
                                    <th>RST SH (days)</th>
                                    <th>RST SH OT (Hour)</th>
                                    <th>RST SH ND (Hour)</th>
                                    <th>RST SH ND OT (Hour)</th>
                                    <th>RST LH (days)</th>
                                    <th>RST LH OT (Hour)</th>
                                    <th>RST LH ND (Hour)</th>
                                    <th>RST LH ND OT (Hour)</th>
                                    <th>SH LH (days)</th>
                                    <th>SH LH OT (Hour)</th>
                                    <th>SH LH ND (Hour)</th>
                                    <th>SH LH ND OT (Hour)</th>
                                    <th>LATES (Minutes)</th>
                                    <th>UNDERTIME (Minutes)</th>
                                </tr>
                               
                                @foreach($laborers as $sq => $laborer)
                                @if($sq > 73)
                                  
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
                                    @php
                                    $schedule_details = 1;
                                    ${'first_time' . $laborer->id . $date} = $schedule->date.' '. date("H:i", strtotime($schedule->start_time));
                                    ${'end_time' . $laborer->id .$date} = $schedule->end_date.' '. date("H:i", strtotime($schedule->end_time));
                                    break;
                                    @endphp
                                    @endif
                                    @endforeach
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
                                            if($approved_ot_final[$approved_ot]['created_at'] <= $generate->created_at)
                                            {
                                                $total_approved_ot =  $total_approved_ot + $approved_ot_final[$approved_ot]['approve_ot'];
                                            }
                                            else {
                                                $total_approved_ot =  $total_approved_ot;
                                            }
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
                                        $working_hours = ((strtotime(${'end_time' . $laborer->id .$date}) - strtotime(${'first_time' . $laborer->id . $date}))/3600)/8;
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
                                                    $work_days =  $work_days - $working_hours;
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
                                            if($holiday_new->holiday_date == $date)
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
                                    $total_rest_day = $total_rest_day + $working_hours - (($late/60/8)) - (($undertime/60/8));;
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
                                    if($date_from > '2019-09-23')
                                    {
                                    if($total_approved_ot == 0)
                                    {
                                        $night_diff_hour_ot = 0;
                                    }
                                    }
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
                                @endif
                                @endforeach
                                @if(count($laborers) > 80)
                                <tr >
                                        <td> <b> Total </b></td>
                                        
                                        <td><b>{{number_format($t_work_days,2)}}</b></td>
                                        <td><b>{{number_format($t_total_approved_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_day,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_lh_days,2)}}</b></td>
                                        <td><b>{{number_format($t_total_lh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_lh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_lh_nd_ot,2) }}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_sh,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_sh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_sh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_sh_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_lh,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_lh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_lh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_rest_day_lh_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_lh,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_lh_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_lh_nd,2)}}</b></td>
                                        <td><b>{{number_format($t_total_sh_lh_nd_ot,2)}}</b></td>
                                        <td><b>{{number_format($t_total_late,2)}}</b></td>
                                        <td><b>{{number_format($t_total_under_time,2)}}</b></td>
                                        
                                    </tr>
                                @endif
                            </table>
                        </td>
                       
                    </tr>
                </table>
            @endif
            @if(count($laborers) > 40)
            <div class="page_break"></div>
            @endif
        </div>
</div>
@if($salary)

<table border='1' class="table table-striped table-bordered third" style="width:100%;" >
    <thead>
        <tr>
            {{-- <th>Seq. No.</th> --}}
            <th>{{$work_name->work_name}} </th>
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
            
            $daily_rate_nd = round((($salary->basic_salary  )/8 * .1),2);
            $total_basic_pay_nd = round(($daily_rate_nd+round((($daily_rate_nd*.1)),2)),2);
            $computation_nd = $total_basic_pay_nd * $t_total_nd;
            $daily_rate_ot = round((($salary->basic_salary)/8 * 1.25),2);
            $computation_ot = round(($t_total_approved_ot*round(($daily_rate_ot+round((($daily_rate_ot*.1)),2)),2)),2);
            $daily_rate_ot = round((($salary->basic_salary  )/8 * 1.25),2);
            $daily_rate_nd_ot = round((($salary->basic_salary  )/8 * 1.25)*.1,2);
            $computation_nd_ot = round((round($daily_rate_nd_ot + round($daily_rate_nd_ot*.1,2),2) *  $t_total_nd_ot),2);
            
            $daily_rate_rest_day =round( ($salary->basic_salary) * 1.3,2);
            $computation_rest_day = round((round(($daily_rate_rest_day+round($daily_rate_rest_day*.1,2)),2) *  $t_total_rest_day),2);
            $daily_rate_rest_day_nd = round((((($salary->basic_salary  )*1.3))/8)*.1,2);
            $computation_rest_day_nd = round((round(($daily_rate_rest_day_nd+round($daily_rate_rest_day_nd*.1,2)),2) *  $t_total_rest_day_nd),2);
            $daily_rate_rest_day_ot = round((((($salary->basic_salary  )*1.69))/8),2);
            $computation_rest_day_ot = round((round(($daily_rate_rest_day_ot+round($daily_rate_rest_day_ot*.1,2)),2) *  $t_total_rest_day_ot),2);
            $daily_rate_rest_day_nd_ot = round((((($salary->basic_salary  )*1.69))/8)*.1,2);
            $computation_rest_day_nd_ot = round((round(($daily_rate_rest_day_nd_ot+round($daily_rate_rest_day_nd_ot*.1,2)),2) *  $t_total_rest_day_nd_ot),2);
            
            $daily_rate_sh = round(((($salary->basic_salary)*.3)),2);
            $computation_sh = round((round(($daily_rate_sh+round($daily_rate_sh*.1,2)),2) *  $t_total_sh_day),2);
            $daily_rate_sh_nd = round((((($salary->basic_salary  )*1.3)/8)*.1),2);
            $computation_sh_nd = round((round(($daily_rate_sh_nd+round($daily_rate_sh_nd*.1,2)),2) *  $t_total_sh_nd),2);
            $daily_rate_sh_ot = round((((($salary->basic_salary  )*1.69)/8)),2);
            $computation_sh_ot = round((round(($daily_rate_sh_ot+round($daily_rate_sh_ot*.1,2)),2) *  $t_total_sh_ot),2);
            $daily_rate_sh_nd_ot = round((((($salary->basic_salary  )*1.69)/8)*.1),2);
            $computation_sh_nd_ot = round((round(($daily_rate_sh_nd_ot+round($daily_rate_sh_nd_ot*.1,2)),2) *  $t_total_sh_nd_ot),2);
            
            $daily_rate_lh = ((($salary->basic_salary    ) * 1.0 ));
            $computation_lh = round((round(($daily_rate_lh+round($daily_rate_lh*.1,2)),2) *  $t_total_lh_days),2);
            $daily_rate_lh_nd = round((((($salary->basic_salary  )*2)/8)*.1),2);
            $computation_lh_nd = round((round(($daily_rate_lh_nd+round($daily_rate_lh_nd*.1,2)),2) *  $t_total_lh_nd),2);
            $daily_rate_lh_ot = round((((($salary->basic_salary  )*2.6)/8)),2);
            $computation_lh_ot = round((round(($daily_rate_lh_ot+round($daily_rate_lh_ot*.1,2)),2) *  $t_total_lh_ot),2);
            $daily_rate_lh_nd_ot = round((((($salary->basic_salary  )*2.6)/8)*.1),2);
            $computation_lh_nd_ot = round((round(($daily_rate_lh_nd_ot+round($daily_rate_lh_nd_ot*.1,2)),2) *  $t_total_lh_nd_ot),2);
            
            
            $daily_rate_rest_day_sh = ((($salary->basic_salary    ) * 0.5 ));
            $computation_rest_day_sh = round((round(($daily_rate_rest_day_sh+round($daily_rate_rest_day_sh*.1,2)),2) *  $t_total_rest_day_sh),2);
            $daily_rate_rest_day_sh_nd = round((((($salary->basic_salary  )*1.5)/8)*.1),2);
            $computation_rest_day_sh_nd = round((round(($daily_rate_rest_day_sh_nd+round($daily_rate_rest_day_sh_nd*.1,2)),2) *  $t_total_rest_day_sh_nd),2);
            $daily_rate_rest_day_sh_ot = round((((($salary->basic_salary  )*1.95)/8)),2);
            $computation_rest_day_sh_ot = round((round(($daily_rate_rest_day_sh_ot+round($daily_rate_rest_day_sh_ot*.1,2)),2) *  $t_total_rest_day_sh_ot),2);
            $daily_rate_rest_day_sh_nd_ot = round((((($salary->basic_salary  )*1.95)/8)*.1),2);
            $computation_rest_day_sh_nd_ot = round((round(($daily_rate_rest_day_sh_nd_ot+round($daily_rate_rest_day_sh_nd_ot*.1,2)),2) *  $t_total_rest_day_sh_nd_ot),2);
            
            $daily_rate_rest_day_lh = ((($salary->basic_salary    ) * 1.6 ));
            $computation_rest_day_lh = round((round(($daily_rate_rest_day_lh+round($daily_rate_rest_day_lh*.1,2)),2) *  $t_total_rest_day_lh),2);
            $daily_rate_rest_day_lh_nd = round((((($salary->basic_salary  )*2.6)/8)*.1),2);
            $computation_rest_day_lh_nd = round((round(($daily_rate_rest_day_lh_nd+round($daily_rate_rest_day_lh_nd*.1,2)),2) *  $t_total_rest_day_lh_nd),2);
            $daily_rate_rest_day_lh_ot = round((((($salary->basic_salary  )*3.38)/8)),2);
            $computation_rest_day_lh_ot = round((round(($daily_rate_rest_day_lh_ot+round($daily_rate_rest_day_lh_ot*.1,2)),2) *  $t_total_rest_day_lh_ot),2);
            $daily_rate_rest_day_lh_nd_ot = round((((($salary->basic_salary  )*3.38)/8)*.1),2);
            $computation_rest_day_lh_nd_ot = round((round(($daily_rate_rest_day_lh_nd_ot+round($daily_rate_rest_day_lh_nd_ot*.1,2)),2) *  $t_total_rest_day_lh_nd_ot),2);
            
            $daily_rate_sh_lh = ((($salary->basic_salary    ) * 1.6 ));
            $computation_sh_lh = round((round(($daily_rate_sh_lh+round($daily_rate_sh_lh*.1,2)),2) *  $t_total_sh_lh),2);
            $daily_rate_sh_lh_nd = round((((($salary->basic_salary  )* 2.6)/8)*.1),2);
            $computation_sh_lh_nd = round((round(($daily_rate_sh_lh_nd+round($daily_rate_sh_lh_nd*.1,2)),2) *  $t_total_sh_lh_nd),2);
            $daily_rate_sh_lh_ot = round((((($salary->basic_salary  )*3.38)/8)),2);
            $computation_sh_lh_ot = round((round(($daily_rate_sh_lh_ot+round($daily_rate_sh_lh_ot*.1,2)),2) *  $t_total_sh_lh_ot),2);
            $daily_rate_sh_lh_nd_ot = round((((($salary->basic_salary  )*3.38)/8)*.1),2);
            $computation_sh_lh_nd_ot = round((round(($daily_rate_sh_lh_nd_ot+round($daily_rate_sh_lh_nd_ot*.1,2)),2) *  $t_total_sh_lh_nd_ot),2);

            $computation_lh_daily_rate = round((round(($total+round($total*.1,2)),2) *  $t_total_lh_days),2);
            $computation_sh_daily_rate = round((round(($total+round($total*.1,2)),2) *  $t_total_sh_day),2);
            $computation_sh_lh_daily_rate  = round((round(($total+round($total*.1,2)),2) *  $t_total_sh_lh),2);
            if($generate->created_at >= "2020-02-07" )
            {
                
                $computation_lh_daily_rate = round((round(($daily_rate+round($daily_rate*.1,2)),2) *  $t_total_lh_days),2);
                $computation_sh_daily_rate = round((round(($daily_rate+round($daily_rate*.1,2)),2) *  $t_total_sh_day),2);
                $computation_sh_lh_daily_rate  = round((round(($daily_rate+round($daily_rate*.1,2)),2) *  $t_total_sh_lh),2);

            }

            $late_rate = ((($daily_rate/8)/60));
            $computation_late = (((($late_rate+($late_rate*.1))) *  $t_total_late));
            $undertime_rate =  ((($daily_rate/8)/60));
            $computation_undertime= (((($undertime_rate+($undertime_rate*.1))) *  $t_total_under_time));
          
            $total_gross_amount = $computation + $computation_nd + $computation_ot + $computation_nd_ot + $computation_rest_day  + $computation_rest_day_ot + $computation_rest_day_nd_ot 
            + $computation_sh + $computation_sh_nd + $computation_sh_ot + $computation_sh_nd_ot + $computation_lh + $computation_lh_nd + $computation_lh_ot + $computation_lh_nd_ot + $computation_rest_day_sh + $computation_rest_day_sh_nd
            + $computation_rest_day_sh_ot + $computation_rest_day_sh_nd_ot + $computation_rest_day_lh + $computation_rest_day_lh_nd + $computation_rest_day_lh_nd + $computation_rest_day_lh_ot + $computation_rest_day_lh_nd_ot 
            + $computation_sh_lh + $computation_sh_lh_nd + $computation_sh_nd_ot + $computation_lh_daily_rate +  $computation_sh_lh_daily_rate  +  $computation_sh_daily_rate + $computation_sh_lh_nd_ot - $computation_late -  $computation_undertime;
            if($generate->created_at >= "2020-02-07" )
            {

                $total_gross_amount = $computation + $computation_nd + $computation_ot + $computation_nd_ot + $computation_rest_day  + $computation_rest_day_ot + $computation_rest_day_nd_ot 
            + $computation_sh + $computation_sh_nd + $computation_sh_ot + $computation_sh_nd_ot + $computation_lh + $computation_lh_nd + $computation_lh_ot + $computation_lh_nd_ot + $computation_rest_day_sh + $computation_rest_day_sh_nd
            + $computation_rest_day_sh_ot + $computation_rest_day_sh_nd_ot + $computation_rest_day_lh + $computation_rest_day_lh_nd + $computation_rest_day_lh_nd + $computation_rest_day_lh_ot + $computation_rest_day_lh_nd_ot 
            + $computation_sh_lh + $computation_sh_lh_nd + $computation_lh_daily_rate +  $computation_sh_lh_daily_rate  +  $computation_sh_daily_rate + $computation_sh_lh_nd_ot - $computation_late -  $computation_undertime;
            
            }

            $total_gross_amount_original = $computation + $computation_nd + $computation_sh  + $computation_lh_daily_rate +  $computation_sh_daily_rate + $computation_sh_nd + $computation_lh + $computation_lh_nd + $computation_sh_lh + $computation_sh_lh_nd - $computation_late -  $computation_undertime  ;
            $total_gross_amount_for_approval = $total_gross_amount - $total_gross_amount_original ;
            $discount_value = ($discount->discount_percent)/100;
            $total_less_discount = (($total_gross_amount_original/1.1)*$discount_value);
            $discounted_amount = ($total_gross_amount_original - $total_less_discount);
            $total_vat = (($discounted_amount*.12));
            $billable_amount = ($total_vat + $discounted_amount);
            $less_ewt_discounted_amount =  ($discounted_amount *.02);
            $total_net_amount_due = ($billable_amount - $less_ewt_discounted_amount);

          
            
            //original
            $discount_value = ($discount->discount_percent)/100;
            $total_less_discount = (($total_gross_amount_original/1.1)*$discount_value);
            $discounted_amount = ($total_gross_amount_original - $total_less_discount);
            $total_vat = (($discounted_amount*.12));
            $billable_amount = ($total_vat + $discounted_amount);
            $less_ewt_discounted_amount =  ($discounted_amount *.02);
            $total_net_amount_due = ($billable_amount - $less_ewt_discounted_amount);
            //for approval
            $discount_value_for_approval = ($discount->discount_percent)/100;
            $total_less_discount_for_approval = (($total_gross_amount_for_approval/1.1)*$discount_value_for_approval);
            $discounted_amount_for_approval = ($total_gross_amount_for_approval - $total_less_discount_for_approval);
            $total_vat_for_approval = (($discounted_amount_for_approval*.12));
            $billable_amount_for_approval = ($total_vat_for_approval + $discounted_amount_for_approval);
            $less_ewt_discounted_amount_for_approval =  ($discounted_amount_for_approval *.02);
            $total_net_amount_due_for_approval = ($billable_amount_for_approval - $less_ewt_discounted_amount_for_approval);
            @endphp
            <td>{{number_format($daily_rate,2)}}</td>
            <td>{{number_format($service_fee,2)}}</td>
            <td>{{number_format($total,2)}}</td>
            <td>{{number_format($t_work_days,2)}}</td>
            <td>{{number_format($computation,2)}}</td>
        </tr>
        @if($t_total_nd > 0)
        <tr>
            <td>Regular Night Diff (Basic Pay)/8*.1  </td>
            <td colspan=12></td>
            <td>{{number_format($daily_rate_nd,2)}}</td>
            <td>{{number_format((($daily_rate_nd*.1)),2)}}</td>
            <td>{{number_format($total_basic_pay_nd,2)}}</td>
            <td>{{number_format($t_total_nd,2)}}</td>
            <td>{{number_format($computation_nd,2)}}</td>
        </tr>
        @endif
        @if($t_total_sh_day > 0)
        <tr>
            <td>Special Holiday Regular Daily Rate</td>
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
            <td>{{number_format($daily_rate,2)}}</td>
            <td>{{number_format($service_fee,2)}}</td>
            <td>{{number_format($total,2)}}</td>
            <td>{{number_format($t_total_sh_day,2)}}</td>
            <td>{{number_format($computation_sh_daily_rate,2)}}</td>
        </tr>
        <tr>
            <td>Special Holiday (Basic Pay)*.3 - First 8 Hours</td>
            <td colspan=12></td>
            <td>{{number_format($daily_rate_sh,2)}}</td>
            <td>{{number_format($daily_rate_sh*.1,2)}}</td>
            <td>{{number_format(($daily_rate_sh+number_format($daily_rate_sh*.1,2)),2)}}</td>
            <td>{{number_format($t_total_sh_day,2)}}</td>
            <td>{{number_format($computation_sh,2)}}</td>
        </tr>
        @endif
        @if($t_total_sh_nd > 0)
        <tr>
            <td>Special Holiday ND (Basic Pay)*1.3/8*.1 - 10PM to 6AM</td>
            <td colspan=12></td>
            <td>{{number_format($daily_rate_sh_nd,2)}}</td>
            <td>{{number_format($daily_rate_sh_nd*.1,2)}}</td>
            <td>{{number_format(($daily_rate_sh_nd+number_format($daily_rate_sh_nd*.1,2)),2)}}</td>
            <td>{{number_format($t_total_sh_nd,2)}}</td>
            <td>{{number_format($computation_sh_nd,2)}}</td>
        </tr>
        @endif

        @if($t_total_lh_days > 0)
        <tr>
            <td>Legal Holiday  Regular Daily Rate</td>
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
            <td>{{number_format($daily_rate,2)}}</td>
            <td>{{number_format($service_fee,2)}}</td>
            <td>{{number_format($total,2)}}</td>
            <td>{{number_format($t_total_lh_days,2)}}</td>
            <td>{{number_format($computation_lh_daily_rate,2)}}</td>
        </tr>
        <tr>
            <td>Legal Holiday (Basic Pay)*1 - First 8 Hours</td>
            <td colspan=12></td>
            <td>{{number_format($daily_rate_lh,2)}}</td>
            <td>{{number_format($daily_rate_lh*.1,2)}}</td>
            <td>{{number_format(($daily_rate_lh+number_format($daily_rate_lh*.1,2)),2)}}</td>
            <td>{{number_format($t_total_lh_days,2)}}</td>
            <td>{{number_format($computation_lh,2)}}</td>
        </tr>
        @endif
        @if($t_total_lh_nd > 0)
        <tr>
            <td>Legal Holiday ND (Basic Pay)*2/8*.1 - 10PM to 6AM</td>
            <td colspan=12></td>
            <td>{{number_format($daily_rate_lh_nd,2)}}</td>
            <td>{{number_format($daily_rate_lh_nd*.1,2)}}</td>
            <td>{{number_format(($daily_rate_lh_nd+number_format($daily_rate_lh_nd*.1,2)),2)}}</td>
            <td>{{number_format($t_total_lh_nd,2)}}</td>
            <td>{{number_format($computation_lh_nd,2)}}</td>
        </tr>
        @endif
        @if($t_total_sh_lh > 0)
        <tr>
            <td>Special Holiday and Legal Holiday Daily Rate</td>
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
            <td>{{number_format($daily_rate,2)}}</td>
            <td>{{number_format($service_fee,2)}}</td>
            <td>{{number_format($total,2)}}</td>
            <td>{{number_format($t_total_sh_lh,2)}}</td>
            <td>{{number_format($computation_sh_lh_daily_rate,2)}}</td>
        </tr>
        <tr>
            <td>Special Holiday and Legal Holiday (Basic Pay)*1.6 - First 8 Hours</td>
            <td colspan=12></td>
            <td>{{number_format($daily_rate_sh_lh,2)}}</td>
            <td>{{number_format($daily_rate_sh_lh*.1,2)}}</td>
            <td>{{number_format(($daily_rate_sh_lh+number_format($daily_rate_sh_lh*.1,2)),2)}}</td>
            
            <td>{{number_format($t_total_sh_lh,2)}}</td>
            <td>{{number_format($computation_sh_lh,2)}}</td>
        </tr>
        @endif
        @if($t_total_sh_lh_nd > 0)
        <tr>
            <td>Special Holiday and Legal Holiday ND (Basic Pay )*2.6/8*.1 - 10PM to 6AM</td>
            <td colspan=12></td>
            <td>{{number_format($daily_rate_sh_lh_nd,2)}}</td>
            <td>{{number_format($daily_rate_sh_lh_nd*.1,2)}}</td>
            <td>{{number_format(($daily_rate_sh_lh_nd+number_format($daily_rate_sh_lh_nd*.1,2)),2)}}</td>
            <td>{{number_format($t_total_sh_lh_nd,2)}}</td>
            <td>{{number_format($computation_sh_lh_nd,2)}}</td>
        </tr>
        @endif
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
            <td>{{number_format($total_gross_amount_original,2)}}</td>
           
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
@if(auth()->user()->generate_role == 1)
<br>
<table  width='100%' style='font-size:13px;'>
    <tr class='noBorder' align='center'>
    <th class='noBorder'>
        @php
            $length = strlen(auth()->user()->name);
            $approved_by = str_repeat('_',$length+8);
        @endphp
        <span><u>____{{auth()->user()->name}}____</u></span><br>
        <span>Processed by</span>
    </th>
    <th class='noBorder'>
            <span><u>{{$approved_by}}</u></span><br>
            <span>Approved by</span>
    </th>
</tr>
</table>
@endif

@if($total_gross_amount_for_approval > 0)
<div class="page_break"></div>

    <br><b style='font-size:14px;'> Reference Number : {{$generate['companyName']->company_name.'-'.date('Y',strtotime($generate->date_from)).'-'.$reference_id}}-OT</b>
<table border='1' class="table table-striped table-bordered third" style="width:100%;" >
        <thead>
            <tr>
                {{-- <th>Seq. No.</th> --}}
                <th>{{$work_name->work_name}} </th>
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
         
         
            @if($t_total_approved_ot > 0)
            <tr >
                <td>Regular OT (Basic Pay)*1.25 /8 </td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_ot,2)}}</td>
                <td>{{number_format((($daily_rate_ot*.1)),2)}}</td>
                <td>{{number_format(($daily_rate_ot+number_format((($daily_rate_ot*.1)),2)),2)}}</td>
                <td>{{number_format($t_total_approved_ot,2)}}</td>
                <td>{{number_format($computation_ot,2)}}</td>
            </tr>
            @endif
            @if($t_total_nd_ot > 0)
            <tr >
                <td>Regular OT Night Diff (Basic Pay)*1.25/8*.1 </td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_nd_ot,2)}}</td>
                <td>{{number_format($daily_rate_nd_ot*.1,2)}}</td>
                <td>{{number_format($daily_rate_nd_ot + number_format($daily_rate_nd_ot*.1,2),2)}}</td>
                <td>{{number_format($t_total_nd_ot,2)}}</td>
                <td>{{number_format($computation_nd_ot,2)}}</td>
            </tr>
            @endif
            @if($t_total_rest_day > 0)
            <tr>
                <td>Restday (Basic Pay)*1.3 - First 8 Hours</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day,2)}}</td>
                <td>{{number_format($daily_rate_rest_day*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day+number_format($daily_rate_rest_day*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day,2)}}</td>
                <td>{{number_format($computation_rest_day,2)}}</td>
            </tr>
            @endif
            @if($t_total_rest_day_nd > 0)
            <tr>
                <td>Restday ND (Basic Pay)*1.3/8*.1 - 10PM to 6AM</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day_nd,2)}}</td>
                <td>{{number_format($daily_rate_rest_day_nd*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day_nd+number_format($daily_rate_rest_day_nd*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day_nd,2)}}</td>
                <td>{{number_format($computation_rest_day_nd,2)}}</td>
            </tr>
            @endif
            @if($t_total_rest_day_ot > 0)
            <tr>
                <td>Restday OT (Basic Pay)*1.69/8 - in excess of 8 Hours</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day_ot,2)}}</td>
                <td>{{number_format($daily_rate_rest_day_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day_ot+number_format($daily_rate_rest_day_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day_ot,2)}}</td>
                <td>{{number_format($computation_rest_day_ot,2)}}</td>
            </tr>
            @endif
            @if($t_total_rest_day_nd_ot > 0)
            <tr>
                <td>Restday OT ND (Basic Pay)*1.69/8*.1 - 10PM to 6AM</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day_nd_ot,2)}}</td>
                <td>{{number_format($daily_rate_rest_day_nd_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day_nd_ot+number_format($daily_rate_rest_day_nd_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day_nd_ot,2)}}</td>
                <td>{{number_format($computation_rest_day_nd_ot,2)}}</td>
            </tr>
            @endif
         
            @if($t_total_sh_ot > 0)
            <tr>
                <td>Special Holiday OT (Basic Pay)*1.69/8 - in excess of 8 Hours</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_sh_ot,2)}}</td>
                <td>{{number_format($daily_rate_sh_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_sh_ot+number_format($daily_rate_sh_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_sh_ot,2)}}</td>
                <td>{{number_format($computation_sh_ot,2)}}</td>
            </tr>
            @endif
            @if($t_total_sh_nd_ot > 0)
            <tr>
                <td>Special Holiday OT ND (Basic Pay)*1.69/8*.1 - 10PM to 6AM</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_sh_nd_ot,2)}}</td>
                <td>{{number_format($daily_rate_sh_nd_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_sh_nd_ot+number_format($daily_rate_sh_nd_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_sh_nd_ot,2)}}</td>
                <td>{{number_format($computation_sh_nd_ot,2)}}</td>
            </tr>
            @endif
           
            @if($t_total_lh_ot > 0)
            <tr>
                <td>Legal Holiday OT (Basic Pay)*2.6/8 - in excess of 8 Hours</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_lh_ot,2)}}</td>
                <td>{{number_format($daily_rate_lh_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_lh_ot+number_format($daily_rate_lh_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_lh_ot,2)}}</td>
                <td>{{number_format($computation_lh_ot,2)}}</td>
            </tr>
            @endif
            @if($t_total_lh_nd_ot > 0)
            <tr>
                <td>Legal Holiday OT ND (Basic Pay)*2.6/8*.1 - 10PM to 6AM</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_lh_nd_ot,2)}}</td>
                <td>{{number_format($daily_rate_lh_nd_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_lh_nd_ot+number_format($daily_rate_lh_nd_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_lh_nd_ot,2)}}</td>
                <td>{{number_format($computation_lh_nd_ot,2)}}</td>
            </tr>
            @endif
           
            @if($t_total_rest_day_sh_ot > 0)
            <tr>
                <td>Restday and Special Holiday OT (Basic Pay)*1.95/8 - in excess of 8 Hours</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day_sh_ot,2)}}</td>
                <td>{{number_format($daily_rate_rest_day_sh_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day_sh_ot+number_format($daily_rate_rest_day_sh_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day_sh_ot,2)}}</td>
                <td>{{number_format($computation_rest_day_sh_ot,2)}}</td>
            </tr>
            @endif
            @if($t_total_rest_day_sh_nd_ot > 0)
            <tr>
                <td>Restday and Special Holiday OT ND (Basic Pay)*1.95/8*.1 - 10PM to 6AM</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day_sh_nd_ot,2)}}</td>
                <td>{{number_format($daily_rate_rest_day_sh_nd_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day_sh_nd_ot+number_format($daily_rate_rest_day_sh_nd_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day_sh_nd_ot,2)}}</td>
                <td>{{number_format($computation_rest_day_sh_nd_ot,2)}}</td>
            </tr>
            @endif
            @if($t_total_rest_day_lh > 0)
            <tr>
                <td>Restday and Legal Holiday Regular Daily Rate</td>
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
                <td>{{number_format($daily_rate,2)}}</td>
                <td>{{number_format($service_fee,2)}}</td>
                <td>{{number_format($total,2)}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Restday and Legal Holiday (Basic Pay)*1.6 - First 8 Hours</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day_lh,2)}}</td>
                <td>{{number_format($daily_rate_rest_day_lh*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day_lh+number_format($daily_rate_rest_day_lh*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day_lh,2)}}</td>
                <td>{{number_format($computation_rest_day_lh,2)}}</td>
            </tr>
            @endif
            @if($t_total_rest_day_lh_nd > 0)
            <tr>
                <td>Restday and Legal Holiday ND (Basic Pay)*2.6/8*.1 - 10PM to 6AM</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day_lh_nd,2)}}</td>
                <td>{{number_format($daily_rate_rest_day_lh_nd*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day_lh_nd+number_format($daily_rate_rest_day_lh_nd*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day_lh_nd,2)}}</td>
                <td>{{number_format($computation_rest_day_lh_nd,2)}}</td>
            </tr>
            @endif
            @if($t_total_rest_day_lh_ot > 0)
            <tr>
                <td>Restday and Legal Holiday OT (Basic Pay)*3.38/8 - in excess of 8 Hours</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day_lh_ot,2)}}</td>
                <td>{{number_format($daily_rate_rest_day_lh_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day_lh_ot+number_format($daily_rate_rest_day_lh_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day_lh_ot,2)}}</td>
                <td>{{number_format($computation_rest_day_lh_ot,2)}}</td>
            </tr>
            @endif
            @if($t_total_rest_day_lh_nd_ot > 0)
            <tr>
                <td>Restday and Legal Holiday OT ND (Basic Pay)*3.38/8*.1- 10PM to 6AM</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_rest_day_lh_nd_ot,2)}}</td>
                <td>{{number_format($daily_rate_rest_day_lh_nd_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_rest_day_lh_nd_ot+number_format($daily_rate_rest_day_lh_nd_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_rest_day_lh_nd_ot,2)}}</td>
                <td>{{number_format($computation_rest_day_lh_nd_ot,2)}}</td>
            </tr>
            @endif
            
            @if($t_total_sh_lh_ot > 0)
            <tr>
                <td>Special Holiday and Legal Holiday OT (Basic Pay)*3.38/8 - in excess of 8 Hours</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_sh_lh_ot,2)}}</td>
                <td>{{number_format($daily_rate_sh_lh_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_sh_lh_ot+number_format($daily_rate_sh_lh_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_sh_lh_ot,2)}}</td>
                <td>{{number_format($computation_sh_lh_ot,2)}}</td>
            </tr>
            @endif
            @if($t_total_sh_lh_nd_ot > 0)
            <tr>
                <td>Special Holiday and Legal Holiday OT ND (Basic Pay)*3.38/8*.1- 10PM to 6AM</td>
                <td colspan=12></td>
                <td>{{number_format($daily_rate_sh_lh_nd_ot,2)}}</td>
                <td>{{number_format($daily_rate_sh_lh_nd_ot*.1,2)}}</td>
                <td>{{number_format(($daily_rate_sh_lh_nd_ot+number_format($daily_rate_sh_lh_nd_ot*.1,2)),2)}}</td>
                <td>{{number_format($t_total_sh_lh_nd_ot,2)}}</td>
                <td>{{number_format($computation_sh_lh_nd_ot,2)}}</td>
            </tr>
            @endif
        
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
                <td>{{number_format($total_gross_amount_for_approval,2)}}</td>
            </tr>
            <tr>
                <td>Less: {{$discount->discount_percent_for_approval}}% Discount (Gross Amount / 1.10  x {{$discount_value}})</td>
                <td colspan=12></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{number_format($total_less_discount_for_approval,2)}}</td>
            </tr>
            <tr>
                <td>Discounted Amount</td>
                <td colspan=12></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{number_format($discounted_amount_for_approval,2)}}</td>
            </tr>
            <tr>
                <td>Add: 12% VAT</td>
                <td colspan=12></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{number_format($total_vat_for_approval,2)}}</td>
            </tr>
            <tr>
                <td>Billable Amount</td>
                <td colspan=12></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{number_format($billable_amount_for_approval,2)}}</td>
            </tr>
            <tr>
                <td>Less: 2% EWT (Discounted Amount X .02)</td>
                <td colspan=12></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{number_format($less_ewt_discounted_amount_for_approval,2)}}</td>
            </tr>
            <tr>
                <td>Net Amount Due</td>
                <td colspan=12></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{number_format($total_net_amount_due_for_approval,2)}}</td>
            </tr>
        </tbody>
    </table>
    @if(auth()->user()->generate_role == 1)
    <br>
    <table  width='100%' style='font-size:13px;'>
        <tr class='noBorder' align='center'>
        <th class='noBorder'>
            @php
                $length = strlen(auth()->user()->name);
                $approved_by = str_repeat('_',$length+8);
            @endphp
            <span><u>____{{auth()->user()->name}}____</u></span><br>
            <span>Processed by</span>
        </th>
        <th class='noBorder'>
                <span><u>{{$approved_by}}</u></span><br>
                <span>Approved by</span>
        </th>
    </tr>
    </table>
    @endif

@endif
@else
NO RATES FOUND
@endif


</body>
</html>


