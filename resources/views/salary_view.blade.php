@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Salaries</a></li>
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
        <a href='#new_holiday'  data-toggle="modal" ><button type="button" data-target="#new_holiday" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'>+ New Rate</button></a>
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
                                    {{-- <th></th> --}}
                                    <th>Agency</th>
                                    <th>Position </th>
                                    <th>Basic Salary</th>
                                    <th>13th month Salary</th>
                                    <th>SIL</th>
                                    <th>Hazard Pay</th>
                                    <th>Ecola </th>
                                    <th>PPE </th>
                                    <th>SSS </th>
                                    <th>Philhealth </th>
                                    <th>HDMF </th>
                                    <th>EC </th>
                                    <th>Expiration Date </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($salaries as $salary)
                                <tr>
                                    {{-- <td> --}}
{{--                                       
                                        <a href="#edit_salary{{$salary->id}}" data-toggle="modal"  class="btn btn-info">
                                            <span class="pe-7s-edit"></span>
                                            Edit
                                        </a> --}}
                                    {{-- </td> --}}
                                    <td>{{$salary->agency->agency_name}} </td>
                                    <td>{{$salary->work->work_name}} </td>
                                    <td>{{number_format(($salary->basic_salary),2)}}</td>
                                    <td>{{number_format(($salary->thirteen_month_salary),2)}}</td>
                                    <td>{{number_format(($salary->sil),2)}}</td>
                                    <td>{{number_format(($salary->hazard_pay),2)}}</td>
                                    <td>{{number_format(($salary->ecola),2)}}</td>
                                    <td>{{number_format(($salary->ppe),2)}}</td>
                                    <td>{{number_format(($salary->sss),2)}}</td>
                                    <td>{{number_format(($salary->ph),2)}}</td>
                                    <td>{{number_format(($salary->hdmf),2)}}</td>
                                    <td>{{number_format(($salary->ec),2)}}</td>
                                    <td>@if($salary->expiration_date!= null){{date('M. d, Y',strtotime($salary->expiration_date))}}@endif</td>
                                </tr>
                                @include('edit_salary')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('new_rate')
@endsection


