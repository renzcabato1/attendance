@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Schedule</a></li>
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
                    <div class="header">
                        <h4 class="title">New Schedule</h4>
                    </div>
                    <div class="content">
                        @if($error == null)
                        <form  method="POST" action="" onsubmit=" return new_schedule(); ">
                            {{ csrf_field() }}
                            @if(session()->has('status'))
                            <div class='row'>
                                <div class="col-md-6">
                                    <div class="alert alert-danger fade in col-md-6">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>{{session()->get('status')}}</strong>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Name
                                        <select data-placeholder="Choose Laborer Name..." class="chosen-select form-control" name='laborer[]' id='laborer_select' multiple>
                                            @foreach($laborers as $laborer)
                                            <option value="{{$laborer->id}}" >{{$laborer->name}}</option>
                                            @endforeach
                                            <option value="0" >All</option>
                                        </select>
                                        <p class='error' id='name_error'></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Select Dates
                                        {{-- <input id='month'  type="month" class="form-control" name="month" value="{{ old('month') }}" onkeydown='return false'  required > --}}
                                        <script type="text/javascript" src="{{ asset('/js/jquery-ui-1.11.1.js')}}"></script>
                                        <script type="text/javascript" src="{{ asset('jquery-ui.multidatespicker.js')}}"></script>
                                        <link rel="stylesheet" type="text/css" href="{{ asset('/css/mdp.css')}}">
                                        <style>
                                            table tr th {
                                                min-width:20px;
                                            }
                                            table tr td {
                                                min-width:20px;
                                            }
                                        </style>
                                        <div id="with-altField" style='margin:0px'></div>
                                        <input type="hidden" id="altField"  name="month"  placeholder='Please Select Date/s' >
                                        <p class='error' id='altField_error'></p>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        Company
                                        <select id='company' data-placeholder="Select Company" class="chosen-select form-control" name='company'  >
                                            <option></option>
                                            @foreach($companies as $company)
                                            <option value='{{$company->id}}'>{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                    
                                        <p class='company' id='company_error'></p>
                                        Department
                                        <select id='departments' data-placeholder="Select department" class="chosen-select form-control" name='department' required  >
                                            <option></option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}" >{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='department' id='department_error'></p>
                                        Position
                                        <select id='positions' data-placeholder="Select Position" class="chosen-select form-control" name='position' required >
                                            <option></option>
                                            @foreach($positions as $position)
                                            <option value="{{$position->id}}" >{{$position->work_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='position' id='position_error'></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Devices
                                        <select id='devices' data-placeholder="Select Device" class="chosen-select form-control" name='devices[]'  >
                                            @foreach($devices as $device)
                                            <option value="{{$device->id}}" >{{$device->name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='error' id='device_error'></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Start Time
                                        <input id='start_time'  type="time" class="form-control" name="start_time" value="{{ old('start_time') }}"  required >
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        End Time
                                        <input id='end_time'  type="time" class="form-control" name="end_time" value="{{ old('end_time') }}"  required >
                                        
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <p style='padding-top:9px;'></p>
                                        <input style="position:relative; top:7px;" id='nextday' type="checkbox"  name="nextday" class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">Nextday</label>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <p style='padding-top:9px;'></p>
                                        <input style="position:relative; top:7px;"  type="checkbox"  name="restday" class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">Rest Day</label>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <p style='padding-top:9px;'></p>
                                        <input style="position:relative; top:7px;"  type="checkbox"  name="break"  class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">With Breaktime</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <br>
                                        <button type="submit" class="btn btn-info btn-fill">Save </button>
                                    </div>
                                </div>
                                <input id='date_generate' value='{{date('Y-m-d')}}' type='hidden'>
                                <script>
                                    var date1 = new Date(document.getElementById("date_generate").value);
                                  
                                    var date2 = new Date();
                                    var diff = Math.abs(date2 -date1)/ (1000*60*60*24) -1;
                                    $('#with-altField').multiDatesPicker({
                                        altField: '#altField',
                                        minDate: -diff, // today
                                    });
                                </script>
                                <script type="text/javascript">
                                    
                                    $('#laborer_select').change(function(e){
                                        dd($(this).val());
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
                                    $(function(){
                                        var dtToday = new Date();
                                        var year = dtToday.getFullYear();
                                        var month = dtToday.getMonth() + 1;
                                        if(month < 10)
                                        {
                                            month = '0'+month;
                                        }
                                        var min_date = year + '-' + month ;
                                        $('#month').attr('min', min_date);
                                    });
                                    function new_schedule() {
                                        var min_time = $('#start_time').val();
                                        var end_time = $('#end_time').val();
                                        var checkedValue = $('.checkbox:checked').val();
                                        if (checkedValue != 1)
                                        {
                                            if (min_time > end_time)
                                            {
                                                alert('Please set End Time Greater than Star Time!');
                                                return false;
                                            }
                                            
                                        }
                                        
                                        if(document.getElementById('laborer_select').value.length==0)
                                        { 
                                            document.getElementById('name_error').innerHTML = "This Field is Required";
                                            
                                        }
                                        else 
                                        {
                                            document.getElementById('name_error').innerHTML = "";
                                        }
                                        if(document.getElementById('location').value.length==0)
                                        { 
                                            document.getElementById('location_error').innerHTML = "This Field is Required";
                                            
                                        }
                                        else 
                                        {
                                            document.getElementById('location_error').innerHTML = "";
                                        }
                                        if(document.getElementById('devices').value.length==0)
                                        { 
                                            document.getElementById('device_error').innerHTML = "This Field is Required";
                                            
                                        }
                                        else 
                                        {
                                            document.getElementById('device_error').innerHTML = "";
                                        }
                                        if(document.getElementById('altField').value.length==0)
                                        { 
                                            document.getElementById('altField_error').innerHTML = "Please select Date/s";
                                            
                                        }
                                        else 
                                        {
                                            document.getElementById('altField_error').innerHTML = "";
                                        }
                                        
                                        if((document.getElementById('laborer_select').value.length==0)||(document.getElementById('devices').value.length==0)||(document.getElementById('altField').value.length==0)||(document.getElementById('location').value.length==0))
                                        {
                                            return false;
                                        }
                                        else
                                        {
                                            document.getElementById("myDiv").style.display="block";
                                        }
                                    }
                                </script>
                            </div>
                        </form>
                        @else
                        <form  method="POST" action="" onsubmit=" return new_schedule(); ">
                            {{ csrf_field() }}
                            @if(session()->has('status'))
                            <div class='row col-md-12'>
                                <div class="alert alert-danger fade in col-md-6">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    <strong>{{session()->get('status')}}</strong>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Name
                                        <select data-placeholder="Choose Laborer Name..." class="chosen-select form-control" name='laborer[]' id='laborer_select' multiple>
                                            @foreach($laborers as $laborer)
                                            <option value="{{$laborer->id}}" {{ in_array($laborer->id, $labs) ? 'selected="selected"' : '' }} >{{$laborer->name}}</option>
                                            @endforeach
                                            <option value="0" >All</option>
                                        </select>
                                        <p class='error' id='name_error'></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Select Dates 
                                        {{-- <input id='month'  type="month" class="form-control" name="month" value="{{ old('month') }}" onkeydown='return false'  required > --}}
                                        <script type="text/javascript" src="{{ asset('/js/jquery-ui-1.11.1.js')}}"></script>
                                        <script type="text/javascript" src="{{ asset('jquery-ui.multidatespicker.js')}}"></script>
                                        <link rel="stylesheet" type="text/css" href="{{ asset('/css/mdp.css')}}">
                                        <style>
                                            table tr th {
                                                min-width:20px;
                                            }
                                            table tr td {
                                                min-width:20px;
                                            }
                                        </style>
                                        <div id="with-altField" style='margin:0px'></div>
                                        <input type="hidden" id="altField"  name="month"  placeholder='Please Select Date/s' >
                                        <p class='error' id='altField_error'></p>
                                        
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        Company
                                        <select id='companies' data-placeholder="Select Company" class=" form-control" name='company' required >
                                            <option></option>
                                            @foreach($companies as $company)
                                            <option value="{{$company->id}}" >{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='company' id='company_error'></p>
                                        Department
                                        <select id='departments' data-placeholder="Select department" class=" form-control" name='department' required  >
                                            <option></option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}" >{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='department' id='department_error'></p>
                                        Position
                                        <select id='positions' data-placeholder="Select Position" class=" form-control" name='position' required >
                                            <option></option>
                                            @foreach($positions as $position)
                                            <option value="{{$position->id}}" >{{$position->work_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='position' id='position_error'></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Devices
                                        <select id='devices' data-placeholder="Select Device" class="chosen-select form-control" name='devices[]'  >
                                            @foreach($devices as $device)
                                            <option value="{{$device->id}}" {{ in_array($device->id, $devicesss) ? 'selected="selected"' : '' }} >{{$device->name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='error' id='device_error'></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Start Time
                                        <input id='start_time'  type="time" class="form-control" name="start_time" value="{{$start_time}}"  required >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        End Time
                                        <input id='end_time'  type="time" class="form-control" name="end_time" value="{{$end_time}}"  required >
                                        
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <p style='padding-top:9px;'></p>
                                        <input style="position:relative; top:7px;" id='nextday' type="checkbox" {{ ($nextday == 1 ? "checked":"") }}  name="nextday" class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">Nextday</label>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <p style='padding-top:9px;'></p>
                                        <input style="position:relative; top:7px;"  type="checkbox"  name="restday"  {{ ($restday == 1 ? "checked":"") }} class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">Rest Day</label>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class="form-group">
                                        <p style='padding-top:9px;'></p>
                                        <input style="position:relative; top:7px;"  type="checkbox"  name="break_time"  {{ ($break == 1 ? "checked":"") }} class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">1 Hour Breaktime</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <br>
                                        <button type="submit" class="btn btn-info btn-fill">Save </button>
                                    </div>
                                </div>
                                <script>
                                        var date1 = new Date(document.getElementById("date_generate").value);
                                        
                                        var date2 = new Date();
                                        var diffDays = date2.getDate() - date1.getDate() - 1;
                                        var diff = Math.abs(date2 -date1)/ (1000*60*60*24) - 1;
                                        $('#with-altField').multiDatesPicker({
                                            altField: '#altField',
                                            minDate: -diff, // today
                                        });
                                    function validateForm() {
                                        var x = document.forms["myForm"]["fname"].value;
                                        if (x == "") {
                                            alert("Name must be filled out");
                                            return false;
                                        }
                                    }
                                </script>
                                
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
                                    $(function(){
                                        var dtToday = new Date();
                                        var year = dtToday.getFullYear();
                                        var month = dtToday.getMonth() + 1;
                                        if(month < 10)
                                        {
                                            month = '0'+month;
                                        }
                                        var min_date = year + '-' + month ;
                                        $('#month').attr('min', min_date);
                                    });
                                    function new_schedule() {
                                        var min_time = $('#start_time').val();
                                        var end_time = $('#end_time').val();
                                        var checkedValue = $('.checkbox:checked').val();
                                        if (checkedValue != 1)
                                        {
                                            if (min_time > end_time)
                                            {
                                                alert('Please set End Time Greater than Star Time!');
                                                return false;
                                            }
                                            
                                        }
                                        if(document.getElementById('laborer_select').value.length==0)
                                        { 
                                            document.getElementById('name_error').innerHTML = "This Field is Required";
                                            
                                        }
                                        else 
                                        {
                                            document.getElementById('name_error').innerHTML = "";
                                        }
                                        
                                        if(document.getElementById('devices').value.length==0)
                                        { 
                                            document.getElementById('device_error').innerHTML = "This Field is Required";
                                            
                                        }
                                        else 
                                        {
                                            document.getElementById('device_error').innerHTML = "";
                                        }
                                        if(document.getElementById('altField').value.length==0)
                                        { 
                                            document.getElementById('altField_error').innerHTML = "Please select Date/s";
                                            
                                        }
                                        else 
                                        {
                                            document.getElementById('altField_error').innerHTML = "";
                                        }
                                        
                                        if((document.getElementById('laborer_select').value.length==0)||(document.getElementById('devices').value.length==0)||(document.getElementById('altField').value.length==0)||(document.getElementById('location').value.length==0))
                                        {
                                            return false;
                                        }
                                        else
                                        {
                                            document.getElementById("myDiv").style.display="block";
                                        }
                                    }
                                </script>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


