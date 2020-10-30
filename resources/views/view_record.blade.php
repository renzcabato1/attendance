@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Attendance</a></li>
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
                <li><a  data-toggle="modal" data-target="#profile" >Change Password</a></li>
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
                        <form  method="GET" action="">
                            @include('error')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Employees
                                        <select data-placeholder="Choose Employee Name..." class="chosen-select form-control" name='laborer[]'  multiple>
                                            @foreach($laborers as $laborer)
                                            <option value="{{$laborer->id}}" @if($names != Null) {{ in_array($laborer->id, $names) ? 'selected="selected"' : '' }} @endif>{{$laborer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        From
                                        <input type="date" value='{{$from}}' class="form-control" name="from"   required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        To
                                        <input type="date" value='{{$to}}' class="form-control" name="to"  required>
                                        
                                    </div>
                                </div>
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
        @if($names != Null)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table id="example" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <td >Employee Name</td>
                                    @foreach($dateformats as $dateformat)
                                    <td>{{$dateformat}}</td>
                                    @endforeach
                                    <td >
                                        Total
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($names as $key => $name)
                                <tr>
                                    <td >
                                        {{$name_all[$key][0]['name']}}
                                    </td>
                                    @php 
                                    $total_time = 0;
                                    $totalko = 0;
                                    @endphp
                                    @foreach($dates as $key1 => $date)
                                    <td >
                                        @foreach($attendances_all as $attendances)
                                            @foreach($attendances as $attendance)
                                                @if(($attendance->laborer_id == $name) && (date('Y-m-d', strtotime($attendance->time_in)) == $dates[$key1]))
                                                IN: {{ date('g:i a', strtotime($attendance->time_in))}}
                                                <br>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        @foreach($attendances_all as $attendances)
                                            @foreach($attendances as $attendance)
                                                @if( ($attendance->laborer_id == $name) && (date('Y-m-d', strtotime($attendance->time_out)) == $dates[$key1]))
                                                OUT: {{date('g:i a', strtotime($attendance->time_out))}}
                                                <br>
                                                ___________
                                                <br>
                                                Total: {{date('H:i', strtotime($attendance->time_out)-strtotime($attendance->time_in))}}
                                                @php 
                                                $totalko = $totalko + strtotime(date('H:i', strtotime($attendance->time_out)-strtotime($attendance->time_in)));
                                                $total_time = $total_time + strtotime($attendance->time_out)-strtotime($attendance->time_in);
                                                @endphp
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    @endforeach
                                    <td>
                                        @php
                                        $minute =intval((($total_time/3600)-intval($total_time/3600)) * 60 );
                                        $total_timea = intval($total_time/3600);
                                        @endphp
                                        @if($total_timea < 10 ) 
                                        @php
                                        $total_timea = '0'.$total_timea;
                                        @endphp
                                        @endif
                                        @if($minute < 10 ) 
                                        @php
                                        $minute = '0'.$minute;
                                        @endphp
                                        @endif
                                        {{$total_timea  . ':' . $minute}}
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection


