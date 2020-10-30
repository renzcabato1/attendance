@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href=""> Logs</a></li>
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
                        <form  method="GET" action="" onsubmit= "show()">
                            @include('error')
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        From
                                        <input type="date" onkeydown="return false"  value='{{$from}}' class="form-control" name="from" onchange='view_laborer()' id='from' required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        To
                                        <input type="date" onkeydown="return false"  value='{{$to}}' class="form-control" name="to" id='to' onchange='view_laborers()'  required>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class='laborer_view_select'>
                                            Employees
                                            <select data-placeholder="Choose Employee Name..." class="chosen-select form-control" name='laborer[]' id='laborer_select' multiple>
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
                        <table class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>In</td>
                                    <td>Out</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($names as $key2 => $name)
                                <tr>
                                    <td colspan = '3'> {{$name_all[0][$key2]['name']}}</td>
                                </tr>
                                @if($dateformats!=Null)
                                @endif
                                @foreach($dateformats as $key => $dateformat)
                                <tr>
                                    <td>{{$dateformat}}</td>
                                    @php
                                    $data_time = [];   
                                    @endphp
                                    @foreach($attendances_all as $attendance)
                                    @if(($attendance->laborer_id == $name_all[0][$key2]['id']) && (date('Y-m-d', strtotime($attendance->time_in)) == $dates[$key]))
                                    @php
                                    $data_time[] = $attendance;   
                                    @endphp
                                    
                                    @endif
                                    @endforeach
                                    
                                    @if($data_time != [])
                                    <td>@if($data_time[0]->time_in)<i style='font-size:12px'>{{date('Y-m-d', strtotime($data_time[0]->time_in))}}</i> - <b style='font-size:20px'> {{date('g:i a', strtotime($data_time[0]->time_in))}}</b>@endif</td>
                                    <td>@if($data_time[0]->time_out)<i style='font-size:12px'>{{date('Y-m-d', strtotime($data_time[0]->time_out))}}</i> - <b style='font-size:20px'>{{date('g:i a', strtotime($data_time[0]->time_out))}}</b>@endif</td>
                                    @else
                                    <td></td>
                                    <td></td>
                                    @endif
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
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
    @endsection
    
    
    