@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">User List</a></li>
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
<div class='row col-md-12'>
    <div class = 'col-md-6'>
        <a href='#new_account'  data-toggle="modal"><button type="button" data-target="#new_account" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'><i class="pe-7s-add-user"></i> New Account</button></a>
    </div>
    @if(session()->has('status'))
    <div class="alert alert-success fade in col-md-6" style='margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>  {{session()->get('status')}}</strong>
    </div>
    @endif
    @include('error')
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content table-responsive table-full-width">
                    <form method="GET" action="" class="custom_form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-3">
                                <input type='text' class='form-control' name='name' placeholder="Search" required>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-md btn-submit" style="width:100px;border-radius:4px" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    <table id="" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Company</td>
                            <td>Department</td>
                            <td>Agency</td>
                            <td>Position</td>
                            <td>Role</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            @foreach($accounts as $account)
                            <tr>
                                <td>{{$account->name}}</td>
                                <td>{{$account->email}}</td>
                                <td>
                                    @foreach(json_decode($account->company) as $com) 
                                    @php
                                    $key = array_search($com, array_column($company_array, 'id'));
                                    @endphp
                                    {{$companies[$key]->company_name}}
                                    <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach(json_decode($account->department) as $dept) 
                                    @php
                                    $key = array_search($dept, array_column($department_array, 'id'));
                                    @endphp
                                    {{$departments[$key]->name}}
                                    <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach(json_decode($account->agency) as $agency) 
                                    @php
                                    $key1 = array_search($agency, array_column($agencies_array, 'id'));
                                    @endphp
                                    {{$agencies[$key1]->agency_name}}
                                    <br>
                                    @endforeach
                                </td>
                                <td>
                                        @foreach(json_decode($account->work) as $work) 
                                        @php
                                        $key = array_search($work, array_column($position_array, 'id'));
                                        @endphp
                                        {{$positions[$key]->work_name}}
                                        <br>
                                        @endforeach
                                    </td>
                                <td>{{$account->role_name}}</td>
                                @if($account->status_account != 1)
                                <td>
                                    <a href="#edit_account{{$account->id}}" data-toggle="modal"  class="btn btn-info">
                                        <span class="pe-7s-edit"></span>
                                        Edit
                                    </a>
                                    <a href="reset-account/{{$account->id}}"  class="btn btn-success">
                                        <i class='pe-7s-refresh'></i> Reset
                                    </a>
                                    <a href="deactivate-account/{{$account->id}}" class="btn btn-danger">
                                        Deactivate
                                    </a>
                                    @include('account')
                                </td>
                                @else
                                <td>
                                    <a href="activate-account/{{$account->id}}"  class="btn btn-success">
                                        Activate
                                    </a>
                                    @include('account')
                                </td>
                                @endif
                                @endforeach
                            </tfoot>
                        </table>
                        {{$accounts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('account_modal')
@endsection


