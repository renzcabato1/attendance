@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">OT Request</a></li>
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
    <div class = 'col-md-6'>
        {{-- <a href='#new_laborer'  data-toggle="modal"><button type="button" data-target="#new_laborer" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'><i class="pe-7s-add-user"></i> New Laborer</button></a> --}}
        <a href='#new_file_ot' data-toggle="modal" ><button type="button" data-target="#new_manpower" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'>+ New can file ot</button></a>
    </div>
    @if(session()->has('status'))
    <div class="alert alert-success fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{session()->get('status')}}</strong>
    </div>
    @endif
    @if(session()->has('error_status'))
    <div class="alert alert-danger fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{session()->get('error_status')}}</strong>
    </div>
    @endif
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table id="example"  class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Department</th>
                                    <th>Position </th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($can_file_ots as $can_file_ot)
                                <tr>
                                    <td>{{$can_file_ot->company_info->company_name}}</th>
                                    <td>{{$can_file_ot->department_info->name}}</th>
                                    <td>{{$can_file_ot->position_info->work_name}} </th>
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
@include('new_file_ot')
@endsection


