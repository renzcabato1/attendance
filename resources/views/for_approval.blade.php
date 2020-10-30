@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">For Approval</a></li>
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
        {{-- <a href='#new_manpower' data-toggle="modal" ><button type="button" data-target="#new_manpower" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'>+ New Request</button></a> --}}
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manpowers as $manpower)
                                <tr>
                                    <td>{{$manpower->user_name}}</td>
                                    <td>{{$manpower->number_of_manpower}}</td>
                                    <td>{{$manpower->department_name}}</td>
                                    <td>{{$manpower->position}}</td>
                                    <td>
                                        <a href="#approved{{$manpower->id}}" data-toggle="modal"  class="btn btn-success">
                                            <span class="pe-7s-check"></span>
                                            Approve
                                        </a>
                                        <a href="#cancell{{$manpower->id}}" data-toggle="modal"  class="btn btn-danger">
                                                <span class="pe-7s-close"></span>
                                                Cancel
                                            </a>
                                    </td>
                                    @include('approve_modal')
                                    @include('cancel_modal')
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


