@extends('layouts.header')
@section('content')
@php
 ini_set('max_execution_time', 0);
@endphp
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Monitoring</a></li>
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

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <form  method="GET" action="" onsubmit= "show()">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Companies
                                        <select data-placeholder="Choose Company" class="chosen-select form-control" name='company' id='company' >
                                            @foreach($companies as $company)
                                            <option value="{{$company->id}}"   {{ ($company->id == $company_id) ? 'selected="selected"' : '' }}  >{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='error' id='company_error'></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        From
                                        <input name='datefrom' class='form-control' value='{{$datefrom}}' type='date' required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        To
                                        <input name='dateto' class='form-control' value='{{$dateto}}' type='date' required>
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
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
      @if($dateto != null)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <a id="btnExport" onclick="exportF(this)" class="btn btn-success btn-fill" style='margin-bottom:5px;'>Export to Excel</a><br>
                        
                        <table style="width:100%;" id='renz' >
                            <tr>
                                <td> Company Name: <span id='company_name'>{{$company_name->company_name}}</span></td>
                            </tr>
                            <tr>
                                <td> Period: <span id='period'> {{date('M d, Y',strtotime($datefrom)).' - '.date('M d, Y',strtotime($dateto)) }} </span></td>
                            </tr>
                            
                            <tr>
                                <td style="width:45%;" valign="top">
                                    <table   class="table table-striped table-bordered" style="width:100%;" border='1'>
                                        <thead>
                                            <tr>
                                                <th colspan='6'>ALC</th>
                                            </tr>
                                            <tr>
                                                <th width='30%'>Locations</th>
                                                <th width='30%'>Positions</th>
                                                <th width='30%'>Laborer Name (User ID)</th>
                                                <th>Manhours</th>
                                                <th>Overtime</th>
                                                <th>Breaktime (HRS)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach($locations as $location)
                                            
                                            @php
                                            $works_id = ($works->pluck('location_id'))->toArray();
                                            $keys_location_work = array_keys($works_id, $location->location_id);
                                            
                                            
                                            @endphp 
                                            
                                            @php
                                            $totalManpower = 0;
                                            $totalOTManpower = 0;
                                            $totalBreaktimeManpower = 0;
                                            @endphp
                                            @foreach($keys_location_work as $a => $key_location_work )
                                            @php
                                            $laborer_id = ($laborers->pluck('location_id'))->toArray();
                                            $laborer_id_work = ($laborers->pluck('work_id'))->toArray();
                                            $keys_laborer_location = array_keys($laborer_id, $location->location_id);
                                            $keys_laborer_work_id = array_keys($laborer_id_work, $works[$key_location_work]->work_id);
                                            $results=array_intersect($keys_laborer_work_id,$keys_laborer_location);
                                            @endphp
                                            
                                            
                                            @php
                                            $total_total_manpower = 0;
                                            $total_ot = 0;
                                            $total_breaktime_perposition = 0;
                                            @endphp
                                            @foreach($results as $result)
                                            @php
                                            $schedules_location_id = ($schedules->pluck('location_id'))->toArray();
                                            $schedules_work_id = ($schedules->pluck('work_id'))->toArray();
                                            $schedules_laborer_id = ($schedules->pluck('laborer_id'))->toArray();
                                            $keys_schedules_location_id = array_keys($schedules_location_id, $location->location_id);
                                            $keys_schedules_work_id = array_keys($schedules_work_id, $works[$key_location_work]->work_id);
                                            $keys_schedules_laborer_id = array_keys($schedules_laborer_id, $laborers[$result]->laborer_id);
                                            $result_schedules=array_intersect($keys_schedules_location_id,$keys_schedules_work_id,$keys_schedules_laborer_id);
                                            @endphp
                                            
                                            @php
                                            $workingTotal = 0;
                                            $totalbreaktime = 0;
                                            $totalOT = 0;
                                            $working_hours = 0;
                                            $late = 0;
                                            $undertime = 0;
                                            $ot = 0;
                                            @endphp
                                            @foreach($result_schedules as $result_schedule)
                                            {{-- {{$schedules[$result_schedule]->date}} --}}
                                            @php
                                            // $attendance_laborer_id = ($attendances->pluck('laborer_id'))->toArray();
                                            // dd($attendanceLaborerId);
                                            $keys_attendance_laborer_id = array_keys($attendanceLaborerId,$laborers[$result]->laborer_id);
                                            $keys_attendance_date = array_keys($attendanceDate,$schedules[$result_schedule]->date);
                                            $result_attendances = array_intersect($keys_attendance_laborer_id,$keys_attendance_date);
                                            @endphp
                                            
                                                @foreach($result_attendances as $result_attendance)
                                                    @if($attendances[$result_attendance]->time_out != null)
                                                    
                                                            @php
                                                            
                                                            $attendanceTimein = $attendances[$result_attendance]->time_in;
                                                            $attendanceTimeout = $attendances[$result_attendance]->time_out;
                                                            $breaktime = $schedules[$result_schedule]->with_breaktime;
                                                            if($breaktime == null)
                                                            {
                                                                $breaktime = 0 ;
                                                            }
                                                            // dump($schedule_breaktime);
                                                            $scheduleIn = $schedules[$result_schedule]->date.' '.$schedules[$result_schedule]->start_time;
                                                            $scheduleOut = $schedules[$result_schedule]->end_date.' '.$schedules[$result_schedule]->end_time;
                                                            $working_hours = ((strtotime($scheduleOut) - strtotime($scheduleIn))/3600);
                                                            $late = (strtotime($attendanceTimein)-strtotime($scheduleIn))/3600;
                                                            $undertime = (strtotime($attendanceTimeout)-strtotime($scheduleOut))/3600;
                                                            if($late >= 0)
                                                            {
                                                                $late = 0;
                                                            }
                                                            if($undertime >= 0)
                                                            {
                                                                $undertime = 0;
                                                            }
                                                            if($attendances[$result_attendance]['ApprovedOT'] != null)
                                                            {
                                                                $ot = $attendances[$result_attendance]['ApprovedOT']->approve_ot;
                                                            }
                                                            else {
                                                                $ot = 0;
                                                            }
                                                            
                                                            @endphp
                                                    @else
                                                        @php
                                                        $late = 0;
                                                        $undertime = 0;
                                                        $working_hours = 0;
                                                        $ot = 0;
                                                        $breaktime = 0;
                                                        @endphp 
                                                    @endif
                                                        @php
                                                        $workingTotal = $workingTotal + $working_hours + $late + $undertime;
                                                        $totalOT = $ot + $totalOT;
                                                        $totalbreaktime = $breaktime + $totalbreaktime;
                                                        @endphp
                                                    
                                                        @php
                                                        break;
                                                        @endphp
                                                @endforeach
                                            @endforeach
                                            <tr>
                                                <td >{{$location->locationName}}</td>
                                                <td >
                                                    {{$works[$key_location_work]->workName}}
                                                    
                                                </td>
                                                <td>
                                                    {{$laborers[$result]->laborer_name.'( '.$laborers[$result]->laborer_id.' )'}} 
                                                </td>
                                                <td>
                                                    {{round($workingTotal,2)}} 
                                                </td>
                                                <td>
                                                    {{round($totalOT,2)}} 
                                                </td>
                                                <td>
                                                    {{round($totalbreaktime,2)}} 
                                                </td>
                                            </tr>
                                            @php
                                            $total_total_manpower = $total_total_manpower + $workingTotal;
                                            $total_ot = $total_ot + $totalOT;
                                            $total_breaktime_perposition = $total_breaktime_perposition + $totalbreaktime;
                                            @endphp
                                            
                                            @endforeach
                                            <tr>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    Total {{$works[$key_location_work]->workName}}
                                                </td>
                                                
                                                <td>
                                                </td>
                                                <td>
                                                    {{round($total_total_manpower,2)}}
                                                </td>
                                                
                                                <td>
                                                    {{round($total_ot,2)}}
                                                </td>
                                                <td>
                                                    {{round($total_breaktime_perposition,2)}}
                                                </td>
                                            </tr>
                                            @php
                                            $totalManpower = $totalManpower + $total_total_manpower;
                                            $totalOTManpower = $totalOTManpower + $total_ot;
                                            $totalBreaktimeManpower = $totalBreaktimeManpower + $total_breaktime_perposition;
                                            @endphp
                                            @endforeach
                                            <tr>
                                                <td>
                                                    Total    {{$location->locationName}}
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                
                                                <td>
                                                </td>
                                                <td>
                                                    {{round($totalManpower,2)}}
                                                </td>
                                                
                                                <td>
                                                    {{round($totalOTManpower,2)}}
                                                </td>
                                                <td>
                                                    {{round($totalBreaktimeManpower,2)}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td style="width:5%;">
                                </td>
                                <td style="width:45%;" valign="top">
                                    <table class="table table-striped table-bordered" style="width:100%;" border='1'>
                                        <thead>
                                            <tr>
                                                <th colspan='5'>ALC Finance</th>
                                            </tr>
                                            <tr>
                                                <th width='30%'>Locations</th>
                                                <th width='30%'>Positions</th>
                                                <th>Manhours</th>
                                                <th>Overtime</th>
                                                <th>Breaktime(HRS)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach($locations as $location)
                                            
                                            @php
                                            $works_id = ($works->pluck('location_id'))->toArray();
                                            $keys_location_work = array_keys($works_id, $location->location_id);
                                            @endphp 
                                            
                                            @php
                                            $totalManpower = 0;
                                            $totalOTManpower = 0;
                                            $totalBreaktimeManpower = 0;
                                            @endphp
                                            @foreach($keys_location_work as $a => $key_location_work )
                                            @php
                                            $laborer_id = ($laborers->pluck('location_id'))->toArray();
                                            $laborer_id_work = ($laborers->pluck('work_id'))->toArray();
                                            $keys_laborer_location = array_keys($laborer_id, $location->location_id);
                                            $keys_laborer_work_id = array_keys($laborer_id_work, $works[$key_location_work]->work_id);
                                            $results=array_intersect($keys_laborer_work_id,$keys_laborer_location);
                                            @endphp

                                            @php
                                            $total_total_manpower = 0;
                                            $total_ot = 0;
                                            $total_breaktime_perposition = 0;
                                            @endphp
                                            @foreach($results as $result)
                                            @php
                                            $schedules_location_id = ($schedules->pluck('location_id'))->toArray();
                                            $schedules_work_id = ($schedules->pluck('work_id'))->toArray();
                                            $schedules_laborer_id = ($schedules->pluck('laborer_id'))->toArray();
                                            $keys_schedules_location_id = array_keys($schedules_location_id, $location->location_id);
                                            $keys_schedules_work_id = array_keys($schedules_work_id, $works[$key_location_work]->work_id);
                                            $keys_schedules_laborer_id = array_keys($schedules_laborer_id, $laborers[$result]->laborer_id);
                                            $result_schedules=array_intersect($keys_schedules_location_id,$keys_schedules_work_id,$keys_schedules_laborer_id);
                                            @endphp
                                            
                                            @php
                                            $workingTotal = 0;
                                            $totalbreaktime = 0;
                                            $totalOT = 0;
                                            $working_hours = 0;
                                            $late = 0;
                                            $undertime = 0;
                                            $ot = 0;
                                            @endphp
                                            @foreach($result_schedules as $result_schedule)
                                            {{-- {{$schedules[$result_schedule]->date}} --}}
                                            @php
                                            // $attendance_laborer_id = ($attendances->pluck('laborer_id'))->toArray();
                                            // dd($attendanceLaborerId);
                                            $keys_attendance_laborer_id = array_keys($attendanceLaborerId,$laborers[$result]->laborer_id);
                                            $keys_attendance_date = array_keys($attendanceDate,$schedules[$result_schedule]->date);
                                            $result_attendances = array_intersect($keys_attendance_laborer_id,$keys_attendance_date);
                                            @endphp
                                            
                                            @foreach($result_attendances as $result_attendance)
                                            @if($attendances[$result_attendance]->time_out != null)
                                            
                                            @php
                                            
                                            $attendanceTimein = $attendances[$result_attendance]->time_in;
                                            $attendanceTimeout = $attendances[$result_attendance]->time_out;
                                            $breaktime = $schedules[$result_schedule]->with_breaktime;
                                            if($breaktime == null)
                                            {
                                                $breaktime = 0 ;
                                            }
                                            $scheduleIn = $schedules[$result_schedule]->date.' '.$schedules[$result_schedule]->start_time;
                                            $scheduleOut = $schedules[$result_schedule]->end_date.' '.$schedules[$result_schedule]->end_time;
                                            $working_hours = ((strtotime($scheduleOut) - strtotime($scheduleIn))/3600);
                                            $late = (strtotime($attendanceTimein)-strtotime($scheduleIn))/3600;
                                            $undertime = (strtotime($attendanceTimeout)-strtotime($scheduleOut))/3600;
                                            if($late >= 0)
                                            {
                                                $late = 0;
                                            }
                                            
                                            if($undertime >= 0)
                                            {
                                                $undertime = 0;
                                            }
                                            if($attendances[$result_attendance]['ApprovedOT'] != null)
                                            {
                                                $ot = $attendances[$result_attendance]['ApprovedOT']->approve_ot;
                                            }
                                            else 
                                            {
                                                $ot = 0;
                                            }
                                            
                                            @endphp
                                            @else
                                            @php
                                            $late = 0;
                                            $undertime = 0;
                                            $working_hours = 0;
                                            $ot = 0;
                                            $breaktime = 0;
                                            @endphp 
                                            @endif
                                            @php
                                            $workingTotal = $workingTotal + $working_hours + $late + $undertime;
                                            $totalOT = $ot + $totalOT;
                                            $totalbreaktime = $breaktime + $totalbreaktime;
                                            @endphp
                                            
                                            @php
                                            break;
                                            @endphp
                                            @endforeach
                                            @endforeach
                                            
                                            @php
                                            $total_total_manpower = $total_total_manpower + $workingTotal;
                                            $total_ot = $total_ot + $totalOT;
                                            $total_breaktime_perposition = $total_breaktime_perposition + $totalbreaktime;
                                            @endphp
                                            @endforeach
                                            <tr>
                                                <td >{{$location->locationName}}</td>
                                                <td>{{$works[$key_location_work]->workName}}</td>
                                                
                                                <td>
                                                    {{round($total_total_manpower,2)}}
                                                </td>
                                                
                                                <td>
                                                    {{round($total_ot,2)}}
                                                </td>
                                                
                                                <td>
                                                    {{round($total_breaktime_perposition,2)}}
                                                </td>
                                            </tr>
                                            @php
                                            $totalManpower = $totalManpower + $total_total_manpower;
                                            $totalOTManpower = $totalOTManpower + $total_ot;
                                            $totalBreaktimeManpower = $totalBreaktimeManpower + $total_breaktime_perposition;
                                            @endphp
                                            @endforeach
                                            <tr>
                                                <td>
                                                    Total    {{$location->locationName}}
                                                </td>
                                                
                                                <td>
                                                </td>
                                                <td>
                                                    {{round($totalManpower,2)}}
                                                </td>
                                                
                                                <td>
                                                    {{round($totalOTManpower,2)}}
                                                </td>
                                                <td>
                                                    {{round($totalBreaktimeManpower,2)}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<script>
    function exportF(elem) {
        var company_name =  document.getElementById('company_name').innerHTML;  
        var period =  document.getElementById('period').innerHTML;  
        var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
            var textRange; var j = 0;
            tab = document.getElementById('renz');//.getElementsByTagName('table'); // id of table
            if (tab==null) {
                return false;
            }
            if (tab.rows.length == 0) {
                return false;
            }
            
            for (j = 0 ; j < tab.rows.length ; j++) {
                tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
                //tab_text=tab_text+"</tr>";
            }
            
            tab_text = tab_text + "</table>";
            tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
            tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
            tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
            
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");
            
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
            {
                txtArea1.document.open("txt/html", "replace");
                txtArea1.document.write(tab_text);
                txtArea1.document.close();
                txtArea1.focus();
                sa = txtArea1.document.execCommand("SaveAs", true, company_name+period+".xls");
            }
            else                 //other browser not tested on IE 11
            //sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
            try {
                var blob = new Blob([tab_text], { type: "application/vnd.ms-excel" });
                window.URL = window.URL || window.webkitURL;
                link = window.URL.createObjectURL(blob);
                a = document.createElement("a");
                if (document.getElementById("caption")!=null) {
                    a.download=document.getElementById("caption").innerText;
                }
                else
                {
                    a.download =  company_name+period;
                }
                
                a.href = link;
                
                document.body.appendChild(a);
                
                a.click();
                
                document.body.removeChild(a);
            } catch (e) {
            }
            
            
            return false;
            //return (sa);
        }
    </script>
    @endsection
    
    
    