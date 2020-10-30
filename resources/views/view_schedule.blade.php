@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Attendances</a></li>
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        From
                                        <input type="date" value='{{$from}}' onkeydown="return false" class="form-control" name="from" onchange='view_laborer()' id='from' required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        To
                                        <input type="date" value='{{$to}}' onkeydown="return false" class="form-control" name="to" id='to' onchange='view_laborers()'  required>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Employees
                                        <div class='laborer_view_select'>
                                        <select data-placeholder="Choose Employee Name..." class="chosen-select form-control" name='laborer[]' id='laborer_select' multiple required>
                                            @foreach($laborers as $laborer)
                                                <option value="{{$laborer->id}}" @if($names != Null) {{ in_array($laborer->id, $names) ? 'selected="selected"' : '' }} @endif>{{$laborer->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                        
                                </div>
                                    </div>
                            </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <br>
                                        <button type="submit" class="btn btn-info btn-fill">Generate</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <br>
                                        @if((auth()->user()->role != 2) && (auth()->user()->role != 3))
                                        <a href='{{ url('/new-schedule') }}' onclick='show()'><button type="button"  class="btn btn-primary" ><i class="pe-7s-plus"></i> New Schedule</button></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div style='width:100%;padding-bottom:5px'><div class='redbox1'></div><i style='padding-left: 5px;'>Absent</i></div>
                                        <div style='width:100%;padding-bottom:5px'><div class='orangebox1'></div><i style='padding-left: 5px;'>No In or No Out</i></div>
                                        <div style='width:100%;padding-bottom:5px'>(<i>RD</i>)<i style='padding-left: 5px;'>Rest Day</i></div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        @if($names != Null)
        <a id="btnExport" onclick="exportF(this)" class="btn btn-success btn-fill" style='margin-bottom:5px;'>Export to Excel</a><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table id="example" class="table table-striped table-bordered" style="width:100%;">
                            Period: <span id='period'> {{date('M d, Y',strtotime($from)).' - '.date('M d, Y',strtotime($to)) }} 
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
                                $absent = 0;
                                @endphp
                                <tr>
                                    <td class='schedulewidth'>
                                        {{$name_all[$key]->name}}
                                    </td>
                                    @foreach($dates as $key1 => $date)
                                    
                                    <td class='schedulewidth' style='vertical-align:top;'>
                                        @php
                                        $attendance_display = 0;
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
                                        @foreach($schedules_all as $schedules)
                                        @foreach($schedules as $schedule)
                                        
                                        @if(($schedule->laborer_id == $name) && (date('Y-m-d', strtotime($schedule->date)) == $date))
                                        Schedule @if($schedule->rest_day == 1)  (<i>RD</i>)@endif 
                                        @if($generate == null) 
                                            @if((auth()->user()->role != 2) && (auth()->user()->role != 3)) 
                                         
                                             <a href="#edit_schedule{{$schedule->id}}" data-toggle="modal"  ><i  class="pe-7s-edit" title='edit' ></i></a>
                                             <a href='delete-schedule/{{$schedule->id}}' onclick="return confirm('Are you sure you want to delete this Schedule?')" ><i class="pe-7s-close danger" title='delete'></i></a>
                                           
                                            @endif 
                                        @else  
                                            @if(date('Y-m-d',strtotime("-1 days")) < $date)
                                            @php
                                            $edit_Schedule = 0;
                                        @endphp
                                            @foreach($attendances_all as $attendance)
                                            @if(($attendance->laborer_id == $name) && (date('Y-m-d', strtotime($attendance->time_in)) == $date))
                                            @php
                                            $edit_Schedule = 1;
                                            @endphp
                                            @break
                                            @else
                                            @php
                                                $edit_Schedule = 0;
                                            @endphp
                                            @endif
                                            @endforeach
                                                @if($edit_Schedule == 0)
                                                        @if((auth()->user()->role != 2) && (auth()->user()->role != 3)) 
                                                            <a href="#edit_schedule{{$schedule->id}}" data-toggle="modal"  ><i  class="pe-7s-edit" title='edit' ></i></a>
                                                            <a href='delete-schedule/{{$schedule->id}}' onclick="return confirm('Are you sure you want to delete this Schedule?')" ><i class="pe-7s-close danger" title='delete'></i></a>
                                                        @endif
                                                    @endif
                                            @endif
                                        @endif
                                        <p class='fontsize' id='rede_{{$namea.$new_date}}' >
                                            {{date("g:i a", strtotime($schedule->start_time))}} - {{date("g:i a", strtotime($schedule->end_time))}}
                                            <br>
                                            @if($schedule->with_breaktime != null)
                                            {{'Breaktime :'. $schedule->with_breaktime . 'hr'}}
                                            @else
                                            {{'Breaktime : 0 '}}
                                            @endif
                                            <br>
                                            @if((auth()->user()->role == 2) || (auth()->user()->role == 5))
                                            @if((in_array($schedule->company_id,json_decode(auth()->user()->company))) && (in_array($schedule->work_id,json_decode(auth()->user()->work))) && (in_array($schedule->location_id,json_decode(auth()->user()->department))))
                                            
                                            @else
                                            @php
                                            $attendance_display = 1;
                                            @endphp
                                            <br>
                                            <br>
                                          
                                            <br>
                                            {{'Company :'. $schedule->company_name}}
                                            <br>
                                            {{'Department :'. $schedule->department_name}}
                                            <br>
                                            {{'Position :'. $schedule->work_name}}
                                            @endif
                                            @elseif((auth()->user()->role == 4))
                                            {{'Company :'. $schedule->company_name}}
                                            <br>
                                            {{'Department :'. $schedule->department_name}}
                                            <br>
                                            {{'Position :'. $schedule->work_name}}
                                            @else
                                            {{'Company :'. $schedule->company_name}}
                                            <br>
                                            {{'Department :'. $schedule->department_name}}
                                            <br>
                                            {{'Position :'. $schedule->work_name}}
                                            @endif
                                            <br>
                                            {{'Encoded By :'. $schedule->user_info->name}}
                                        </p>
                                        {{-- <p class='fontsize' id='rede_{{$namea.$new_date}}'  style='padding-bottom:5px;'>Device : {{$schedule->name}}</p> --}}
                                       
                                        @php
                                        $i = 1;
                                        ${'first_time' . $name . $date} = $schedule->date.' '. date("H:i", strtotime($schedule->start_time));
                                        ${'end_time' . $name .$date} = $schedule->end_date.' '. date("H:i", strtotime($schedule->end_time));
                                        break;
                                        @endphp
                                        @endif
                                        @endforeach
                                        @endforeach
                                        @if ($i == 0)
                                        
                                        Schedule : No Schedule Found
                                        @endif
                                        @if($attendance_display == 0)
                                        @foreach($attendances_all as $attendance)
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
                                        @endphp
                                      
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
                                                            @if($total_approved_ot == 0)
                                                                @else
                                                                <br>
                                                                <i  style='color:green;' title='{{'Remarks: '.$approved_ot_final[$approved_ot]['remarks']}}&#13;{{'Approved By: '.$approved_ot_final[$approved_ot]['name_of_approver']}}' >Approved {{$total_approved_ot}} hrs</i>
                                                                @endif
                                                            </p>
                                                            <p class='fontsize'> Late : {{$total_late .' mins'}} </p>
                                                            <p class='fontsize'> Undertime : {{$total_undertime .' mins'}}</p>
                                                            {{-- @include('approve_attendance') --}}
                                                            @endif
                                                            @endif
                                                            @php break; @endphp
                                                            @endif
                                                            @endforeach
                                                            @if ($a == 0)
                                                            <p style='padding-top: 3px;'></p>
                                                           Attendance<br> <i>No Entries</i>
                                                            @endif
                                                            @if(($i == 1) && ($a == 0))
                                                            <style>
                                                                #rede_{{$namea.$new_date}}
                                                                {color:red;}
                                                            </style>
                                                            @php $absent = $absent + 1; @endphp
                                                            @else 
                                                            <style>
                                                                #rede_{{$namea.$new_date}}
                                                                {
                                                                    color:black;
                                                                }
                                                            </style>
                                                            @endif
                                                            @endif
                                                        </td>
                                                        @include('edit_schedule')
                                                        @endforeach
                                                        <td class='schedulewidth'>
                                                            <p style='padding-top: 3px;'></p>
                                                            <p class='fontsize'> Total Rendered : {{floor($grand_rendered) .' hrs ' . round((($grand_rendered - floor($grand_rendered)) * 60),0) . ' mins' }}</p>
                                                            <p class='fontsize'> Total OT : {{floor($grand_ot) .' hrs ' . round((($grand_ot - floor($grand_ot)) * 60),0) . ' mins' }}</p>
                                                            <p class='fontsize'> Total Approved OT : {{$grand_approved_ot .' hrs'}}</p>
                                                            <p class='fontsize'> Late : {{$grand_late .' mins'}}</p>
                                                            <p class='fontsize'> Undertime : {{$grand_undertime .' mins'}}</p>
                                                            <p class='fontsize'> Absent : {{$absent}}</p>
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
                                });
                                function show_alert(elem)
                                {
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
                                function view_laborer()
                                {
                                    
                                    $('#laborer_select').val('');
                                    var from = document.getElementById("from").value;
                                    $('#to').val(''); 
                                    document.getElementById("to").min = from;
                                }
                                function view_laborers()
                                {
                                    
                                    $('.laborer_view_select').children().remove();
                                    var from = document.getElementById("from").value;
                                    var to = document.getElementById("to").value;
                                    document.getElementById("myDiv").style.display="block";
                                    $.ajax({    //create an ajax request to load_page.php
                                        type: "GET",
                                        url: "{{ url('/get-laborer-details/') }}",            
                                        data: {
                                            "from" : from,
                                            "to" : to
                                        }     ,
                                        dataType: "json",   //expect html to be returned
                                        success: function(data){    
                                            $('.laborer_view_select').append('<select data-placeholder="Choose Employee Name..." class="chosen-select form-control" name="laborer[]"" id="laborer_select" multiple>');
                
                                            jQuery.each(data, function(laborer) {
                                                //now you can access properties using dot notation
                                                $('#laborer_select').append('<option value='+ data[laborer].id +' >'+ data[laborer].name +'</option>');
                                            })
                                            $('.laborer_view_select').append('</select>');
                                            
                                            var chosen_js = '{{ asset('/chosen/chosen.jquery.js')}}';
                                            var init_js = '{{ asset('/chosen/docsupport/init.js')}}';
                                            $.getScript(chosen_js);
                                            $.getScript(init_js,function(jd) {
                                                $("#laborer_select_chosen").css({"width": "100%"});
                                            });
                                            document.getElementById("myDiv").style.display="none";
                                        },
                                        error: function(e)
                                        {
                                            alert(e);
                                        }
                                        
                                    });
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
                <script>
                    function exportF(elem) {
                        // var company_name =  document.getElementById('company_name').innerHTML;  
                        var period =  document.getElementById('period').innerHTML;  
                        var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
                            var textRange; var j = 0;
                            tab = document.getElementById('example');//.getElementsByTagName('table'); // id of table
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
                                sa = txtArea1.document.execCommand("SaveAs", true, period+".xls");
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
                                    a.download =  period;
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
                
                
                