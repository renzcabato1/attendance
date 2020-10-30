@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Generated Records</a></li>
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
@if(session()->has('status'))
    <div class="alert alert-success fade in col-md-6" style='margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>  {{session()->get('status')}}</strong>
    </div>
@endif
   
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <form  method="GET" action="">
                            <div class="row">
                               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        Agencies
                                        <select data-placeholder="Choose Agency" class="chosen-select form-control" name='agency[]'  id='agency'  multiple>
                                            <option ></option>
                                            @foreach($agencies as $agency)
                                            {{-- <option value="{{$agency->id}}" {{ ($agency->id == $agency_id) ? 'selected="selected"' : '' }}>{{$agency->agency_name}}</option> --}}
                                            <option value="{{$agency->id}}" @if($agency_id != Null) {{ in_array($agency->id, $agency_id) ? 'selected="selected"' : '' }} @endif>{{$agency->agency_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class='error' id='agency_error'></p>
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
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <br>
                                        <button type="submit" class="btn btn-info btn-fill">Generate</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div style='width:100%;padding-bottom:5px'><div class='green'></div><i style='padding-left: 5px;'>Already Generated</i></div>
                                        <div style='width:100%;padding-bottom:5px'><div class='redbox1'></div><i style='padding-left: 5px;'>Unprocess</i></div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        @if($dateranges)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <form  method="POST" action="generate-all">
                            {{ csrf_field() }}
                            <input type='hidden' name='date' value='{{$date_range}}'>
                            <input type='hidden' value='{{$works}}' name='generatedwork'>
                            <input type='hidden' value='{{json_encode($agency_id)}}' name='agency'>
                            <button type="submit" class="btn btn-warning btn-fill">Generate All</button>
                        </form>
                        <table id="generate_records"  class="table table-striped table-bordered table-hover" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Agency</th>
                                    <th>Company</th>
                                    <th>Location </th>
                                    <th>Positon</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $green = 0;
                                    $red = 0;
                                @endphp
                               
                                @foreach($works as $work)
                                  
                                    <tr>
                                        <td>
                                            {{$work->agency_name}}
                                            {{-- {{$work->agency_id}} --}}
                                        </td>
                                        <td>
                                            {{$work->CompanyInfo->company_name}}
                                            {{-- {{$work->company_id}} --}}
                                        </td>
                                        <td>
                                            {{$work->LocationInfo->name}}
                                            {{-- {{$work->location_id}} --}}
                                        </td>
                                        <td>
                                            {{$work->PositionInfo->work_name}}
                                            {{-- {{$work->work_id}} --}}
                                        </td>
                                        @php
                                            $generates_agency_id = ($generates->pluck('agency_id'))->toArray();
                                            $generates_company_id = ($generates->pluck('company_id'))->toArray();
                                            $generates_location_id = ($generates->pluck('location_id'))->toArray();
                                            $generates_position_id = ($generates->pluck('position_id'))->toArray();
                                        
                                            $keys_agency_id = array_keys($generates_agency_id,$work->agency_id);
                                            // dd($keys_agency_id);
                                            $keys_company_id = array_keys($generates_company_id,$work->company_id);
                                            $keys_location_id= array_keys($generates_location_id,$work->location_id);
                                            $keys_position_id = array_keys($generates_position_id,$work->work_id);
                                            $results = array_intersect($keys_agency_id,$keys_company_id,$keys_location_id,$keys_position_id);
                                            
                                        @endphp
                                        <td>
                                            @if($results != null)
                                            <div class='green'></div>
                                            @php
                                                $green = $green + 1;
                                            @endphp
                                            @else
                                                <div class='redbox1'></div>
                                                @php
                                                $red = $red + 1;
                                            @endphp
                                            @endif
                                        </td>
                                    </tr>    
                                  
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td align='right' colspan=3>
                                    </td>
                                    <td align='left' colspan=2>
                                        <div style='width:100%;padding-bottom:5px'><div class='green'></div><i style='padding-left: 5px;'>Already Generated({{$green}})</i></div>
                                        <div style='width:100%;padding-bottom:5px'><div class='redbox1'></div><i style='padding-left: 5px;'>Unprocess({{$red}}) </i></div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<script>
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


