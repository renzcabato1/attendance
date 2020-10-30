@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Positions</a></li>
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
        <a href='#new_position'  data-toggle="modal" ><button type="button" data-target="#new_position" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'>New Position</button></a>
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
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Discount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($positions as $position)
                                <tr>
                                    <td>{{$position->work_name}}</td>
                                    <td>{{$position->status_name}}</td>
                                    <td>{{$position->discount_percent.' %'}}</td>
                                    <td>
                                        <a href="#edit_position{{$position->id}}" data-toggle="modal"  class="btn btn-info">
                                            <span class="pe-7s-edit"></span>
                                            Edit
                                        </a>
                                        @include('edit_position')
                                        {{-- <a href="delete-position/{{$position->id}}" data-toggle="modal"  onclick="return confirm('Are you sure you want to delete this Position?')" class="btn btn-danger">
                                            <span class="pe-7s-close"></span>
                                            Delete
                                        </a> --}}
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
@include('new_position')
@endsection