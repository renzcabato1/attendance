@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">For Verification</a></li>
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
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <form  method="GET" action="" onsubmit= "show()">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Employees
                                        <select data-placeholder="Choose Employee Name..." class="chosen-select form-control" name='laborer[]' id='laborer_select' multiple>
                                            @foreach($laborers as $laborer)
                                            <option value="{{$laborer->id}}" @if($names != Null) {{ in_array($laborer->id, $names) ? 'selected="selected"' : '' }} @endif>{{$laborer->name}}</option>
                                            @endforeach
                                         
                                            <option value="0" >All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        From
                                        <input type="date" value='{{$from}}' class="form-control" name="from"  required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        To
                                        <input type="date" value='{{$to}}' class="form-control" name="to"  required>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <br>
                                        <button type="submit" class="btn btn-info btn-fill">Generate</button>
                                        
                                    </div>
                                </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div style='width:100%;padding-bottom:5px;'><div class='redbox1'></div><i style='padding-left: 5px;'>Absent</i></div>
                                        <div style='width:100%;padding-bottom:5px;'><div class='orangebox1'></div><i style='padding-left: 5px;'>No In or No Out</i></div>
                                        <div style='width:100%;padding-bottom:5px;'>(<i>RD</i>)<i style='padding-left: 5px;'>Rest Day</i></div>
                                        </div>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
            @if($names != Null)
            
            <form  method="POST" action="verification" onsubmit= "show()">
            {{ csrf_field() }}
            <div class="col-md-1">
                    <div class="form-group">
                        <br>
                        <input type="hidden" value='{{$from}}' class="form-control" name="from"  required>
                        <input type="hidden" value='{{$to}}' class="form-control" name="to"  required>
                        @foreach($names as $key => $name)
                        <input type="hidden" value='{{$name}}' class="form-control" name="names[]"  required>
                        @endforeach
                        <button type="submit" class="btn btn-success btn-fill">Verify All</button>
                        
                    </div>
            </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="content table-responsive table-full-width">
                            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <td >Employee Name</td>
                                        @foreach($dateformats as $key3 => $dateformat)
                                        <td class='schedulewidth'>{{$dateformat}} ({{date('D', strtotime($dates[$key3]))}})</td>
                                        @endforeach
                                        <td class='schedulewidth'>Summary</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($names as $key => $name)
                                    @php
                                    $grand_rendered = 0;
                                    $grand_ot = 0;
                                    $grand_undertime= 0;
                                    $grand_late = 0;
                                    $grand_approved_ot = 0;
                                    @endphp
                                    <tr>
                                        <td class='schedulewidth'>
                                            {{$name_all[$key]->name}}
                                        </td>
                                        @foreach($dates as $key1 => $date)
                                        <td class='schedulewidth' style='vertical-align:top;'>
                                           
                                            @php
                                            $namea = $name = $name_all[$key]->id;
                                            $new_date = strtotime($date);
                                            $date_new = date(('M. j, Y'),strtotime($date));
                                            $i = 0;
                                            $a = 0;
                                            $no_out = 0;
                                            $no_in = 0;
                                            $remark_id = 0;
                                            $verified = 0;
                                            @endphp
                                             @foreach($verification_details as $verification)
                                                @if(($verification['laborer_id'] == $name) && ($verification['date_verified'] == $date))
                                                    @php
                                                            $verified = 1;
                                                            break; 
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if($verified == 1)
                                               <div style='float:right;'> <i class='fontsize pe-7s-check' style='color:green;'  >Verified</i></div>
                                            @endif
                                               
                                                @foreach($schedules_all as $schedules)
                                                    @foreach($schedules as $schedule)
                                                        @if(($schedule->laborer_id == $name) && (date('Y-m-d', strtotime($schedule->date)) == $date))
                                                        Schedule @if($schedule->rest_day == 1)  (<i>RD</i>)@endif 
                                                        <p class='fontsize' id='rede_{{$namea.$new_date}}' > {{date("g:i a", strtotime($schedule->start_time))}} - {{date("g:i a", strtotime($schedule->end_time))}}</p>
                                                        <p class='fontsize' id='rede_{{$namea.$new_date}}'  style='padding-bottom:5px;'>Device : {{$schedule->name}}</p>
                                                    
                                                        @php
                                                        $i =1;
                                                        ${'first_time' . $name . $date} = $schedule->date.' '. date("H:i", strtotime($schedule->start_time));
                                                        ${'end_time' . $name .$date} = $schedule->end_date.' '. date("H:i", strtotime($schedule->end_time));
                                                        @endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                              
                                                    @foreach($attendances_all as $attendance)
                                                    {{-- || (($attendance->laborer_id == $name) && (date('Y-m-d', strtotime($attendance->time_out)) == $dates[$key1])) --}}
                                                    
                                                        @if(($attendance->laborer_id == $name) && (date('Y-m-d', strtotime($attendance->time_in)) == $date))
                                                            @php
                                                            ${'time_in' . $name . $date} = date('Y-m-d H:i', strtotime($attendance->time_in));
                                                            ${'time_out' . $name . $date} = date('Y-m-d H:i', strtotime($attendance->time_out));
                                                            $a = 1;
                                                            if(($attendance->time_in != null)&&($attendance->time_out == null))
                                                            {
                                                                $no_out = 1;
                                                                $no_in = 0;
                                                            }
                                                            else if(($attendance->time_out != null)&&($attendance->time_in == null))
                                                            {
                                                                $no_out = 0;
                                                                $no_in = 1;
                                                            }
                                                            $attendance_history = array_search($attendance->id, array_column($attendance_histories, 'attendance_id'));
                                                            if ($attendance_history !== false)
                                                            {
                                                                $title = $attendance_histories[$attendance_history]['id'];
                                                            } 
                                                            else
                                                            {
                                                                $title = 0;
                                                            }
                                                            @endphp
                                                                        @if($title == 0)
                                                                            @if(($no_out == 0)&&($no_in == 0))
                                                                                <p style='padding-top: 3px;'></p>
                                                                                 Attendance
                                                                                <p class='fontsize'> {{ date('g:i a', strtotime($attendance->time_in))}} - {{date('g:i a', strtotime($attendance->time_out))}}</p>
                                                                                
                                                                            @elseif(($no_out == 1)&&($no_in == 0))
                                                                                <p style='padding-top: 3px;'></p>
                                                                                 Attendance
                                                                                <p class='fontsize' style='color:orange;'> {{ date('g:i a', strtotime($attendance->time_in))}} - XX </p>

                                                                            @elseif(($no_out == 0)&&($no_in == 1))
                                                                                <p style='padding-top: 3px;'></p>
                                                                                Attendance
                                                                                <p class='fontsize' style='color:orange;'> {{ date('g:i a', strtotime($attendance->time_in))}} - XX </p>
                                                                            @endif
                                                                        @else
                                                                            @if(($no_out == 0)&&($no_in == 0))
                                                                                <p style='padding-top: 3px;'></p>
                                                                                <b title='{{'Remarks: '.$attendance_histories[$attendance_history]['remarks']}}&#13;{{'Event: '.$attendance_histories[$attendance_history]['event']}}&#13;{{'Action By: '.$attendance_histories[$attendance_history]['name_of_action']}}'>Attendance
                                                                                <p class='fontsize'> {{ date('g:i a', strtotime($attendance->time_in))}} - {{date('g:i a', strtotime($attendance->time_out))}}</p></b>
                                                                                
                                                                            @elseif(($no_out == 1)&&($no_in == 0))
                                                                                <p style='padding-top: 3px;'></p>
                                                                                <b title='{{'Remarks: '.$attendance_histories[$attendance_history]['remarks']}}&#13;{{'Event: '.$attendance_histories[$attendance_history]['event']}}&#13;{{'Action By: '.$attendance_histories[$attendance_history]['name_of_action']}}'> Attendance
                                                                                <p class='fontsize' style='color:orange;'> {{ date('g:i a', strtotime($attendance->time_in))}} - XX </p></b>

                                                                            @elseif(($no_out == 0)&&($no_in == 1))
                                                                                <p style='padding-top: 3px;'></p>
                                                                                <b title='{{'Remarks: '.$attendance_histories[$attendance_history]['remarks']}}&#13;{{'Event: '.$attendance_histories[$attendance_history]['event']}}&#13;{{'Action By: '.$attendance_histories[$attendance_history]['name_of_action']}}'> Attendance
                                                                                <p class='fontsize' style='color:orange;'> {{ date('g:i a', strtotime($attendance->time_in))}} - XX </p></b>
                                                                            @endif

                                                                        @endif
                                                                        @if(($no_out == 0) && ($no_in == 0))
                                                                            @if (($a == 1) &&($i == 1))
                                                                            @php
                                                                            $total_late = strtotime(${'time_in' . $name . $date})-strtotime(${'first_time' . $name . $date});
                                                                            $total_ot = strtotime(${'time_out' . $name . $date})-strtotime(${'end_time' . $name . $date});
                                                                            if($total_late <= 0)
                                                                            {$total_late = 0 ;} 
                                                                            else{$total_late = round(($total_late/60),0) ;}
                                                                            
                                                                            if(($total_ot < 3600)&&($total_ot >= 0))
                                                                                {  $total_ot = 0; $total_undertime = 0;}
                                                                            else if($total_ot < 0)
                                                                                {  $total_undertime = round(($total_ot/60),0) * -1 ; $total_ot = 0; }
                                                                            else if ($total_ot >= 3600)
                                                                                {  $total_ot = round(($total_ot/3600),2) ;$total_undertime = 0; }
                                                                            $total_rendered = round((((strtotime(${'end_time' . $name . $date})-strtotime(${'first_time' . $name . $date}))-($total_late*60)-($total_undertime*60))/3600),2);
                                                                            $grand_rendered = round(($grand_rendered+$total_rendered),2);
                                                                            $grand_ot = round(($grand_ot+$total_ot),2);
                                                                            $grand_late = round(($grand_late+$total_late),2);
                                                                            $grand_undertime = round(($grand_undertime+$total_undertime),2);
                                                                            @endphp
                                                                                <p style='padding-top: 3px;'></p>
                                                                                <p class='fontsize'> Total Rendered : {{floor($total_rendered) .' hrs ' . round((($total_rendered - floor($total_rendered)) * 60),0) . ' mins' }}</p>
                                                                                <p class='fontsize'> Total OT : {{floor($total_ot) .' hrs ' . round((($total_ot - floor($total_ot)) * 60),0) . ' mins' }}
                                                                                    @if($total_ot >= 1)
                                                                                    @php
                                                                                    $approved_ot = array_search($attendance->id, array_column($approved_ot_final, 'attendance_id'));
                                                                                    if ($approved_ot !== false)
                                                                                    {
                                                                                        $total_approved_ot = $approved_ot_final[$approved_ot]['approve_ot'];
                                                                                    } 
                                                                                    else
                                                                                    {
                                                                                        $total_approved_ot = 0;
                                                                                    }
                                                                                    $grand_approved_ot = round(($grand_approved_ot+$total_approved_ot),2);
                                                                                    @endphp
                                                                                    @if($total_approved_ot != 0)
                                                                                    <br>
                                                                                    <i  style='color:green;' title='{{'Remarks: '.$approved_ot_final[$approved_ot]['remarks']}}&#13;{{'Approved By: '.$approved_ot_final[$approved_ot]['name_of_approver']}}' >Approved {{$total_approved_ot}} hrs</i>
                                                                                    @endif
                                                                                    @endif
                                                                                </p>
                                                                                <p class='fontsize'> Late : {{$total_late .' mins'}} </p>
                                                                                <p class='fontsize'> Undertime : {{$total_undertime .' mins'}}</p>
                                                                        @endif
                                                                @endif
                                                                @php break; @endphp
                                                            @endif
                                                        @endforeach
                                                    
                                                    @if(($i == 1) && ($a == 0))
                                                    <style>
                                                        #rede_{{$namea.$new_date}}
                                                        {
                                                            color:red;
                                                        }
                                                    </style>
                                                    @else 
                                                    <style>
                                                        #rede_{{$namea.$new_date}}
                                                        {
                                                            color:black;
                                                        }
                                                    </style>
                                                    @endif
                                                    @foreach($remarks as $remark)
                                                        @if(($remark['laborer_id'] == $name) && ($remark['date_remarks'] == $date))
                                                            @php
                                                                 $remark_id = 1;
                                                                 $remark_ids = $remark['id'];
                                                                 $date_remarks = $remark['date_remarks'];
                                                                 $laborer_id = $remark['laborer_id'];
                                                                 $remarks_by = $remark['remarks_by'];
                                                                 $remarks_lahat = $remark['remarks'];
                                                                 break; 
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    @if($remark_id == 1)
                                                    <br>
                                                    <a href="#edit_remarks{{$remark_ids}}" data-toggle="modal"  ><i  class="pe-7s-edit" title='Edit Remarks' ></i></a> <a href='delete-remarks/{{$remark_ids}}' onclick="return confirm('Are you sure you want to delete this Attendance?')" ><i class="pe-7s-close danger" title='Delete Remarks'></i></a>
                                                    <br> <i class='fontsize'>Remarks : {!! nl2br($remarks_lahat) !!}</i>
                                                    @include('edit_remarks')
                                                    @else
                                                    <a href="#add_remarks{{$name.$new_date}}" data-toggle="modal"><button type="button"  class="btn btn-success btn-sm" ><i class="pe-7s-plus"></i> Add Remarks</button></a>
                                                    @include('add_remarks')   
                                                    @endif
                                                </td>
                                            @endforeach
                                            <td class='schedulewidth'>
                                                <p style='padding-top: 3px;'></p>
                                                <p class='fontsize'> Total Rendered : {{floor($grand_rendered) .' hrs ' . round((($grand_rendered - floor($grand_rendered)) * 60),0) . ' mins' }}</p>
                                                <p class='fontsize'> Total OT : {{floor($grand_ot) .' hrs ' . round((($grand_ot - floor($grand_ot)) * 60),0) . ' mins' }}</p>
                                                <p class='fontsize'> Total Approved OT : {{$grand_approved_ot .' hrs'}}</p>
                                                <p class='fontsize'> Late : {{$grand_late .' mins'}}</p>
                                                <p class='fontsize'> Undertime : {{$grand_undertime .' mins'}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif 
                <script type="text/javascript">
                $('#laborer_select').change(function(e){
                    if($(this).val() != null)
                    {
                        $("#laborer_select :selected").map(function(i, el) {
                            
                            if($(el).val() == 0){
                                e.preventDefault();
                                $('#laborer_select option').prop('selected', true).trigger('chosen:updated');
                                $("option[value='0']").prop('selected', false).trigger('chosen:updated');
                            }
                        });
                    }
                    // else if($(this).val() == null)
                    // {
                        //     alert($(this).val());
                        // }
                    });
                </script>
                <script>
                    function show_alert(elem) {
                        var min_time = $('#start_time_'+elem).val();
                        var end_time = $('#end_time_'+elem).val();
                        var checkedValue = $('#nextday1_'+elem+':checked').val();
                        if (checkedValue != 1)
                        {
                            if (min_time > end_time)
                            {
                                alert('Please set End Time Greater than Start Time!');
                                return false;
                            }
                        }
                        if(document.getElementById('start_time_'+elem).value.length==0)
                        { 
                            document.getElementById('start_time_error'+elem).innerHTML = "This Field is Required";
                            return false;
                        }
                        else 
                        {
                            document.getElementById('start_time_error'+elem).innerHTML = "";
                        }
                        if(document.getElementById('end_time_'+elem).value.length==0)
                        { 
                            document.getElementById('end_time_error'+elem).innerHTML = "This Field is Required";
                            return false;
                        }
                        else 
                        {
                            document.getElementById('end_time_error'+elem).innerHTML = "";
                        }
                        if(document.getElementById('devices_'+elem).value.length==0)
                        { 
                            document.getElementById('devices_error'+elem).innerHTML = "This Field is Required";
                            return false;
                        }
                        else 
                        {
                            document.getElementById('devices_error'+elem).innerHTML = "";
                        }
                        if((document.getElementById('start_time_'+elem).value.length==0)||(document.getElementById('end_time_'+elem).value.length==0)||(document.getElementById('devices_'+elem).value.length==0))
                        {
                            return false;
                        }
                        
                    }
                </script>
                <script>
                    function attendance_add(id) {
                        var min_time = $('#start_time1'+id).val();
                        var end_time = $('#end_time1'+id).val();
                        var checkedValue = $('#nextday'+id+':checked').val();
                        if (checkedValue != 1)
                        {
                            if (min_time > end_time)
                            {
                                alert('Please set Time Out Greater than Time In!');
                                return false;
                            }
                            
                        }
                        if(document.getElementById('start_time1'+id).value.length==0)
                        { 
                            document.getElementById('start_time_error1'+id).innerHTML = "This Field is Required";
                            return false;
                        }
                        else 
                        {
                            document.getElementById('start_time_error1'+id).innerHTML = "";
                        }
                        if(document.getElementById('end_time1'+id).value.length==0)
                        { 
                            document.getElementById('end_time_error1'+id).innerHTML = "This Field is Required";
                            return false;
                        }
                        else 
                        {
                            document.getElementById('end_time_error1'+id).innerHTML = "";
                        }
                        if(document.getElementById('device'+id).value.length==0)
                        { 
                            document.getElementById('device_error'+id).innerHTML = "This Field is Required";
                            return false;
                        }
                        else 
                        {
                            document.getElementById('device_error'+id).innerHTML = "";
                        }
                        if(document.getElementById('remarks'+id).value.length==0)
                        { 
                            document.getElementById('remarks'+id).innerHTML = "This Field is Required";
                            return false;
                        }
                        else 
                        {
                            document.getElementById('remarks_error'+id).innerHTML = "";
                        }
                        if((document.getElementById('start_time1'+id).value.length==0)||(document.getElementById('end_time1'+id).value.length==0)||(document.getElementById('device'+id).value.length==0))
                        {
                            return false;
                        }
                    }
                </script>
            </div>
        </div>
    </div>
    
    @endsection
    
    
    