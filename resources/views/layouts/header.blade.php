<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('/login_css/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('/login_css/assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <!--     Fonts and icons     -->
    <link href="{{ asset('/login_css/assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <link href="{{ asset('/login_css/style.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('/login_css/jquery-2.1.1.min.js')}}"></script>
    <link href="{{ asset('/login_css/assets/css/animate.min.css')}}" rel="stylesheet'"/>
    <script src="{{ asset('bootstrap.min.js')}}"></script>
    <link href="{{ asset('/datatable/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/datatable/fixedColumns.dataTables.min.css')}}" rel="stylesheet" />
    <script src="{{ asset('/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/datatable/dataTables.fixedColumns.min.js')}}"></script>
    
    
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                scrollY: 500,
                scrollX: true,
                scrollCollapse: true,   
                paging: false,
                fixedColumns: true
            });
        });
        
        $(document).ready(function() {
            $('#example1').DataTable({
                scrollY: 1000,
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: true
            });
        });
        $(document).ready(function() {
            $('#generated_reports').DataTable({
                scrollY: 500,
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                ordering: false,
                fixedColumns: true
            });
        });
        $(document).ready(function() {
            $('#generate_records').DataTable({
                scrollY: 500,
                scrollX: true,
                // scrollCollapse: true,
                paging: false,
                // fixedColumns: true
            });
        });
    </script>
    
    <style>
        .chosen-container-single .chosen-single abbr {
            position: absolute;
            top: 6px;
            right: 26px;
            display: block;
            width: 12px;
            height: 12px;
            background: url("chosen-sprite.png") -42px 1px no-repeat;
            font-size: 1px;
        }
        .chosen-container-single .chosen-single div b {
            display: block;
            width: 100%;
            height: 100%;
            background: url("chosen/chosen-sprite.png") no-repeat 0px 2px;
        }
        .chosen-container-single .chosen-search input[type="text"] {
            margin: 1px 0;
            padding: 4px 20px 4px 5px;
            width: 100%;
            height: auto;
            outline: 0;
            border: 1px solid #aaa;
            background: url("chosen/chosen-sprite.png") no-repeat 100% -20px;
            font-size: 1em;
            font-family: sans-serif;
            line-height: normal;
            border-radius: 0;
        }    
        .chosen-container-multi .chosen-choices li.search-choice .search-choice-close {
            position: absolute;
            top: 4px;
            right: 3px;
            display: block;
            width: 12px;
            height: 12px;
            background: url("chosen/chosen-sprite.png") -42px 1px no-repeat;
            font-size: 1px;
        }
        .chosen-rtl .chosen-search input[type="text"] {
            padding: 4px 5px 4px 20px;
            background: url("chosen/chosen-sprite.png") no-repeat -30px -20px;
            direction: rtl;
        }
        input[type="search"] {
            background-color: #FFFFFF;
            border: 1px solid #E3E3E3;
            border-radius: 4px;
            color: #565656;
            padding: 8px 12px;
            height: 40px;
            -webkit-box-shadow: none;
            box-shadow: none;
            
        }
        table, th, td {
            min-width: 120px;
        }
        label {
            padding-right: 20px;
            padding-bottom: 20px
        }
        
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        body.modal-open div.modal-backdrop { 
            display:none; 
        }
        .error
        {
            color:red;
            font-size: 10px;
        }
        input[type=month]::-webkit-inner-spin-button, 
        input[type=month]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        .schedulewidth
        {
            min-width:200px;
        }
        #department_chosen{
            width: 100% !important;
        }
        #company_chosen{
            width: 100% !important;
        }
        #role_chosen{
            width: 100% !important;
        }
        #agency_chosen{
            width: 100% !important;
        }
        #position_chosen{
            width: 100% !important;
        }
        #location_chosen{
            width: 100% !important;
        }
        .fontsize
        {
            font-size:12px;
            margin: 0em; 
        }
        
        
        input[type=checkbox]
        {
            /* Double-sized Checkboxes */
            -ms-transform: scale(1.4); /* IE */
            -moz-transform: scale(1.4); /* FF */
            -webkit-transform: scale(1.4); /* Safari and Chrome */
            -o-transform: scale(1.4); /* Opera */
            padding: 5px;
        }
        
        .redbox1
        {
            background-color: lightgrey;
            width: 15px;
            height: 15px;
            border: 10px solid red;
            display: inline-block;
            
        }
        .orangebox
        {
            background-color: lightgrey;
            width: 15px;
            height: 15px;
            border: 10px solid orange;
            float:right;
        }
        .orangebox1
        {
            background-color: lightgrey;
            width: 15px;
            height: 15px;
            border: 10px solid orange;
            display: inline-block;
        }
        .green
        {
            background-color: lightgrey;
            width: 15px;
            height: 15px;
            border: 10px solid green;
            display: inline-block;
        }
        /* Might want to wrap a span around your checkbox text */
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
            opacity: .8;
            background-size:200px 120px;
        }
        @media (min-width: 800px) 
        {
            .modal-xl {
                width: 60%; 
            }
        }
        
    </style>
</head>
<body>
    <div id = "myDiv" style="display:none;" class="loader">
    </div>
    <div class="wrapper">
        <div class="sidebar"  data-image="{{ asset('/login_css/assets/img/sidebar-6.jpg')}}">
            <div class="sidebar-wrapper">
                
                <div class="logo" syle='color:white;align:center' >
                    <span style='font-size:20px'>IC Portal</span>
                </div>
                <ul class="nav">
                    @if(auth()->user()->role == 1)
                    <li>
                        <a href="{{ url('/report') }}" >
                            <i class="pe-7s-note2"></i>
                            <p>Logs </p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/schedules') }}" onclick = "show()"  >
                            <i class="pe-7s-alarm"></i>
                            <p>Attendances</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/ap') }}"  onclick = "show()" >
                            <i class="pe-7s-cash"></i>
                            <p>AP</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/user-account') }}"  onclick = "show()" >
                            <i class="pe-7s-add-user"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/laborers') }}" onclick = "show()"  >
                            <i class="pe-7s-id"></i>
                            <p>IC Masterlist</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/devices') }}" onclick = "show()"  >
                            <i class="pe-7s-settings"></i>
                            <p>Devices</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company') }}" onclick = "show()" >
                            <i class="pe-7s-users"></i>       
                            <p>Company</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/department') }}" onclick = "show()" >
                            <i class="pe-7s-users"></i>       
                            <p>Departments</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/positions') }}"  onclick = "show()"  >
                            <i class="pe-7s-timer"></i>
                            <p>Positions</p>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ url('/holidays') }}"  onclick = "show()"  >
                            <i class="pe-7s-info"></i>
                            <p>Holidays</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/payments') }}"  onclick = "show()"  >
                            <i class="pe-7s-config"></i>
                            <p>Rates</p>
                        </a>
                    </li>
                 
                    <li>
                        <a href="{{ url('/for-approval') }}"  onclick = "show()"  >
                            <i class="pe-7s-check"></i>
                            <p>For Approval Manpower</p>
                        </a>
                    </li>
                  
                        <li>
                            <a href="{{ url('/overtime') }}"  onclick = "show()"  >
                                <i class="pe-7s-timer"></i>
                                <p>Overtime</p>
                            </a>
                        </li>
                    <li>
                        <a href="{{ url('/generates') }}"  onclick = "show()"  >
                            <i class="pe-7s-note2"></i>
                            <p>Generated Records</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/payroll-reports') }}"  onclick = "show()"  >
                            <i class="pe-7s-timer"></i>
                            <p>Payroll Reports</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/monitoring') }}"  onclick = "show()"  >
                            <i class="pe-7s-timer"></i>
                            <p>Monitoring</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/can-file-ots') }}"  onclick = "show()"  >
                            <i class="pe-7s-timer"></i>
                            <p>File OT</p>
                        </a>
                    </li>
                    @elseif(auth()->user()->role == 6)
                    <li>
                        <a href="{{ url('/monitoring') }}"  onclick = "show()"  >
                            <i class="pe-7s-timer"></i>
                            <p>Monitoring</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/generates') }}"  onclick = "show()"  >
                            <i class="pe-7s-note2"></i>
                            <p>Generated Records</p>
                        </a>
                    </li>
                    @elseif(auth()->user()->role == 7)
                    <li>
                        <a href="{{ url('/laborers') }}" onclick = "show()"  >
                            <i class="pe-7s-id"></i>
                            <p>IC Masterlist</p>
                        </a>
                    </li>
                    @elseif(auth()->user()->role == 2)
                    <li>
                        <a href="{{ url('/report') }}"  onclick = "show()"  >
                            <i class="pe-7s-note2"></i>
                            <p>Logs</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/schedules') }}"  onclick = "show()"  >
                            <i class="pe-7s-alarm"></i>
                            <p>Attendances</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/manpower') }}"  onclick = "show()"  >
                            <i class="pe-7s-user"></i>
                            <p>Manpower</p>
                        </a>
                    </li>
                    {{-- @if(auth()->user()->file_ot == 1) --}}
                    <li>
                        <a href="{{ url('/overtime-manpower') }}"  onclick = "show()"  >
                            <i class="pe-7s-timer"></i>
                            <p>Overtime Request</p>
                        </a>
                    </li>
                    {{-- @endif --}}
                    @elseif(auth()->user()->role == 3)
                    <li>
                        <a href="{{ url('/schedules') }}" onclick = "show()"  >
                            <i class="pe-7s-alarm"></i>
                            <p>Attendances</p>
                        </a>
                    </li>
                    @if(auth()->user()->generate_role == 1)
                    <li>
                        <a href="{{ url('/ap') }}"  onclick = "show()" >
                            <i class="pe-7s-cash"></i>
                            <p>AP</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/payroll-reports') }}"  onclick = "show()"  >
                            <i class="pe-7s-timer"></i>
                            <p>Payroll Reports</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/generate') }}"  onclick = "show()"  >
                            <i class="pe-7s-note2"></i>
                            <p>Generate</p>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ url('/generates') }}"  onclick = "show()"  >
                            <i class="pe-7s-note2"></i>
                            <p>Generated Records</p>
                        </a>
                    </li>
                  
                    @elseif(auth()->user()->role == 4)
                    <li>
                        <a href="{{ url('/report') }}"  onclick = "show()"  >
                            <i class="pe-7s-note2"></i>
                            <p>Logs</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/schedules') }}"  onclick = "show()"  >
                            <i class="pe-7s-alarm"></i>
                            <p>Attendances</p>
                        </a>
                    </li>
                    
                    
                    @elseif(auth()->user()->role == 5)
                    <li>
                        <a href="{{ url('/report') }}"  onclick = "show()"  >
                            <i class="pe-7s-note2"></i>
                            <p>Logs</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/schedules') }}"  onclick = "show()"  >
                            <i class="pe-7s-alarm"></i>
                            <p>Attendances</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/manpower') }}"  onclick = "show()"  >
                            <i class="pe-7s-user"></i>
                            <p>Manpower</p>
                        </a>
                    </li>
                    {{-- @if(auth()->user()->file_ot == 1) --}}
                    <li>
                        <a href="{{ url('/overtime-manpower') }}"  onclick = "show()"  >
                            <i class="pe-7s-timer"></i>
                            <p>Overtime Request</p>
                        </a>
                    </li>
                    {{-- @endif --}}
                    @endif
                       @if(auth()->user()->approve_rate == 1)
                        <li>
                            <a href="{{ url('/rate-for-approval') }}"  onclick = "show()"  >
                                <i class="pe-7s-timer"></i>
                                <p>Rate For Approval</p>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}"  onclick="logout(); show();" >
                            <i class="pe-7s-cloud-upload"></i>
                            <p>Log Out</p>
                        </a>
                        @if(Auth::user())
                        <form id="logout-form"  action="{{ route('logout') }}"  method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <!-- Modal -->
        @include('change_password')
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!--   Core JS Files   -->
                    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
                    <script src="{{ asset('/inside_css/assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>
                    @yield('content')
                    
                    <script type = "text/javascript">
                        function logout(){
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        }
                        function show() {
                            document.getElementById("myDiv").style.display="block";
                        }
                        var check = function() {
                            if (document.getElementById('password').value ==
                            document.getElementById('confirm_password').value) {
                                document.getElementById('message').style.color = 'green';
                                document.getElementById('message').innerHTML = 'Match';
                                document.getElementById('submit').disabled = false;
                            } else {
                                document.getElementById('message').style.color = 'red';
                                document.getElementById('message').innerHTML = 'Not Match';
                                document.getElementById('submit').disabled = true;
                            }
                        }
                        var check1 = function() {
                            if (document.getElementById('password1').value ==
                            document.getElementById('password2').value) {
                                document.getElementById('message1').style.color = 'green';
                                document.getElementById('message1').innerHTML = 'Match';
                                document.getElementById('submit1').disabled = false;
                            } else {
                                document.getElementById('message1').style.color = 'red';
                                document.getElementById('message1').innerHTML = 'Not Match';
                                document.getElementById('submit1').disabled = true;
                            }
                        }
                    </script>
                    <script src="{{ asset('/chosen/chosen.jquery.js')}}" type="text/javascript"></script>
                    <script src="{{ asset('/chosen/docsupport/init.js')}}" type="text/javascript" charset="utf-8"></script> 
                </body>
                </html>
                