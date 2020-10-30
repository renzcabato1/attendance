@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Manpower Request</a></li>
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
        <a href='#new_manpower' data-toggle="modal" ><button type="button" data-target="#new_manpower" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'>+ New Request</button></a>
    </div>
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
                                    <th>Requestor</th>
                                    <th>Number of Manpower</th>
                                    <th>Department </th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manpowers as $manpower)
                                <tr>
                                    <td>{{auth()->user()->name}}</td>
                                    <td>{{$manpower->number_of_manpower}}</td>
                                    <td>{{$manpower->department_name}}</td>
                                    <td>{{$manpower->position_name}}</td>
                                    <td> 
                                        @if($manpower->status == null)
                                        <i>Pending</i>
                                        @elseif($manpower->status == 'Cancelled')
                                    <i style='color:red;'>Cancelled by {{$manpower->user_name}}</i>
                                    @elseif($manpower->status == 'Approved')
                                    <i style='color:green;'>Approved by {{$manpower->user_name}}</i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($manpower->status == null)
                                        <a href="#edit_manpower_request{{$manpower->id}}" data-toggle="modal"  class="btn btn-info">
                                            <span class="pe-7s-edit"></span>
                                            Edit
                                        </a>
                                        <a href="cancel-request/{{$manpower->id}}" data-toggle="modal"  onclick="return confirm('Are you sure you want to cancel this request?')" class="btn btn-danger">
                                            <span class="pe-7s-close"></span>
                                            Cancel
                                        </a>
                                        @elseif($manpower->status == "Cancelled")
                                        {{$manpower->remarks_status}}
                                        @elseif($manpower->status == "Approved")
                                        Manpower Approved : {{$manpower->approved_number}}<br>
                                        Agency Provider : {{$manpower->agency_name}}
                                        <br>
                                        Remarks : {{$manpower->remarks_status}}

                                        @endif
                                        @include('edit_manpower')
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
@include('new_manpower')
@endsection


