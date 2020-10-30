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
        <a href='#new_ot_request' data-toggle="modal" ><button type="button" data-target="#new_manpower" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'>+ New Request</button></a>
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
                                    <th>laborer</th>
                                    <th>Number of Hours</th>
                                    <th>Date </th>
                                    <th>Remarks </th>
                                    <th>Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ot_requests as $ot_request)
                                <tr>
                                    <td>{{$ot_request->name}}</td>
                                    <td>{{$ot_request->ot_request}}</td>
                                    <td>{{date('M. d, Y',strtotime($ot_request->date_ot))}}</td>
                                    <td>{{$ot_request->remarks}}</td>
                                    <td>{{$ot_request->status}}</td>
                                    <td>
                                        @if($ot_request->status == 'Pending')
                                            {{-- <a href="#edit_ot_request{{$ot_request->id}}" data-toggle="modal"  class="btn btn-info">
                                                <span class="pe-7s-edit"></span>
                                                Edit
                                            </a> --}}
                                            <a href="delete-ot-request/{{$ot_request->id}}" data-toggle="modal"  onclick="return confirm('Are you sure you want to Delete this request?')" class="btn btn-danger">
                                                <span class="pe-7s-close"></span>
                                                Delete
                                            </a>
                                        @elseif($ot_request->status == 'Approved')
                                        Approved By : {{$ot_request->username}}<br>
                                        Approved OT : {{$ot_request->approved_ot}}<br>
                                        Remarks : {{$ot_request->remarks_ot}}
                                        @elseif($ot_request->status == 'Cancelled')
                                        Cancelled By : {{$ot_request->username}}<br>
                                        Remarks : {{$ot_request->remarks_ot}}
                                        @endif
                                    </td>
                                </tr>
                                {{-- @include('edit_ot_request') --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('new_ot_request')
@endsection


