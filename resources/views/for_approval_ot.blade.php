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
                    <div class="content table-responsive table-full-width">
                        <table id="example"  class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Requestor Name</th>
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
                                    <td>{{$ot_request->username}}</td>
                                    <td>{{$ot_request->laborer_name}}</td>
                                    <td>{{$ot_request->ot_request}}</td>
                                    <td>{{date('M. d, Y',strtotime($ot_request->date_ot))}}</td>
                                    <td>{{$ot_request->remarks}}</td>
                                    <td>{{$ot_request->status}}</td>
                                    <td>
                                        <a href="#approved_ot{{$ot_request->id}}" data-toggle="modal"  class="btn btn-success">
                                                <span class="pe-7s-check"></span>
                                                Approve
                                        </a>
                                        <a href="#cancell_ot{{$ot_request->id}}" data-toggle="modal"  class="btn btn-danger">
                                                <span class="pe-7s-close"></span>
                                                Cancel
                                        </a>
                                        @include('approve_modal_ot')
                                        @include('cancel_modal_ot')
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
@endsection


