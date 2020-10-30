@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-left">
                <li> <a href="">Home Page</a></li>
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

@endsection


