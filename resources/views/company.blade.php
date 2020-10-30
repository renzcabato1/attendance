@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Companies </a></li>
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
<div class='row col-md-12'>
    <div class = 'col-md-6'>
        <a href='#new_company'  data-toggle="modal"><button type="button" data-target="#new_company" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'><i class="pe-7s-add-user"></i> New Department</button></a>
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
                    
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <td>Id</td>
                            <td>Company</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                            <tr>
                                
                                <td>{{$company->id}}</td>
                                <td>{{$company->company_name}}</td>
                                <td>
                                    <a href="#edit_company{{$company ->id}}" data-toggle="modal"  class="btn btn-info">
                                        <span class="pe-7s-edit"></span>
                                        Edit
                                    </a>
                                </td>
                                @include('edit_company')
                                @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('new_company')
@endsection


