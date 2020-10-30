<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <script src="{{ asset('jquery.min.js')}}"></script>
    <!-- Styles -->
    {{-- <meta http-equiv="refresh" content="1.3" >  --}}
    <style>
        
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;  
            font-weight: 200;
            height: 100%;
            margin: 0;
            background-image: url("{{ asset('/images/bg.jpg')}}");
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: auto;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            
        }
        
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            
        }
        .position-ref {
            position: relative;
            height: 100%;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
            color:white;
            max-height:100%;
            max-width: 100%;
            height:100%;
            width:100%;
        }
        
        .background-color{
            background:rgba(1,1,1,0.7);
        }
        .title {
            font-size: 64px;
        }
        .title1 {
            font-size: 44px;
        }

        ul{
            padding-bottom:15px;

        }
        .links > a {
            color: #636b6f;
            padding: 0 10px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 15px;
            border: 2px solid #73AD21;
            padding: 10px; 
            width: 200px;
            height: 150px; 
            color:white;
        }
        li {
            display: inline;
        }
        
        .image
        {
            max-width: 100%;
            height: auto;
            width: auto;
            border-radius: 50px;
        }
        .no_schedule
        {
            position: absolute;
            top: 20%;
            left: 37%;
        }
        .centered 
        {
            position: absolute;
            top: 10%;
            left: 25%;
            transform: translate(-50%, -50%) ;
            font-size: 35px;
            color: white;
            background-color: red;
            border-radius: 10px;
            
        }
        .centered_na 
        {
            position: absolute;
            top: 90%;
            left: 25%;
            transform: translate(-50%, -50%) ;
            font-size: 35px;
            color: white;
            background-color: red;
            border-radius: 10px;
            
        }
        @media screen and (max-width: 1280px) {
            html {
                -moz-transform: scale(0.75, 0.75);
                zoom: 0.75;
                zoom: 75%;
            }
        }
        @media screen and (max-width: 900px) {
            html {
                -moz-transform: scale(0.50, 0.50);
                zoom: 0.50;
                zoom: 50%;
            }
        }
        
        @media screen and (max-width: 600px) {
            html {
                -moz-transform: scale(0.25, 0.25);
                zoom: 0.25;
                zoom: 25%;
            }
        }
    </style>
    <script>
        
    </script>
</head>
<body  onload="startTime()">
    <div class='body'>
    </div>
    <div class="flex-center position-ref " >
        <div class="content background-color" style='text-align:center;'>
            <div style='width:100%'>
                <div id="txt" class='title1' style='width:100%;'></div>
                <table style='width:100%;'>
                    <tr>
                        <td style="max-width:50%;text-align: center;" text-align='center'>
                            <img style='width:80%;display:block;margin-left:auto;margin-right:auto;' id='image' src="data:image/png;base64,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" class='image' alt="Avatar">
                            <div class="centered" id='' ><span id='no_schedule'></span></div>
                            <div class="centered_na" id='' ><span id='no_time_out'></span></div>
                        </td>
                        <td style='width:50%'>
                            <div  class="title m-b-md">
                                <span id='name'>
                                    
                                </span>
                            </div>
                            <div class="links w3-row-padding">
                                <ul class='links'>
                                    <li class='links'><a >User ID :  <span id='user_id'></span></a></li>
                                </ul>   
                                <ul class='links'>
                                    <li class='links'><a >Date Time: <span id='time'></span></a></li>
                                </ul>   
                                <ul class='links'>
                                    <li class='links'><a >Schedule :  <span id='schedule'></span></a></li>
                                </ul>
                                <ul class='links'>
                                    <li class='links'><a >Department: <span id='department'></span></a></li>
                                </ul> 
                                <ul class='links'>
                                    <li class='links'><a >Position: <span id='position'></span></a></li>
                                </ul> 
                                 
                                <ul class='links'>
                                    <li class='links'><a >Plant  <span id='plant'></span></a></li>
                                </ul> 
                                <ul class='links'>
                                    <li class='links'><a >Assigned Location :  <span id='plant_device'></span></a></li>
                                </ul> 
                                <ul class='links'>
                                    <li class='links'><a >Entrance Last Tap  :  <span id='guard'></span></a></li>
                                </ul>   
                                <ul class='links'>
                                    <li class='links'><a >Entrance Gate  :  <span id='device_name_guard'></span></a></li>
                                </ul>  
                            </div>
                            <input id = 'device_id' value = '{{$id}}' type='hidden' >
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script>
            var id = $( "#device_id" ).val();
           
            $(document).ready(function() {
                loadData();
            });
            var name;
            var department;
            var time;
            var user_id;        
            var loadData = function() {
                $.ajax({    //create an ajax request to load_page.php
                    
                    type: "GET",
                    url: "{{ url('/load-data/') }}",            
                    data: {
                        "device_id" : id,
                    }     ,
                    dataType: "json",   //expect html to be returned
                    success: function(data){    
                        $("#name").html(data.name);
                        $("#user_id").html(data.id_name);
                        $("#time").html(data.time);
                     
                        $("#image").attr("src",data.image);
                        console.log(data.attendances);
                        if(data.schedule_start == '')
                        {
                            $("#schedule").html('No Schedule');
                            $("#no_schedule").html('<span style="padding:20px;">No Schedule</span>');
                            $("#department").html('No Schedule');
                            $("#position").html('No Schedule');
                        }
                        else
                        {
                            $("#no_schedule").html('');
                            $("#schedule").html(data.schedule_start + ' - ' + data.schedule_end);
                            $("#department").html(data.department);
                            $("#position").html(data.position);
                        }
                        $("#guard").html(data.last_tap_guard);
                        $("#device_name_guard").html(data.device_name_guard);
                         $("#plant_device").html(data.device_name);
                        
                        if(data.tna_key == 1)
                        {
                            $("#plant").html('Time In : ' +data.last_tap);
                            $("#no_time_out").html('No Time Out!');
                            
                        }
                        else
                        {
                            $("#plant").html('Time Out : ' + data.last_tap);
                        }
                        interval = setTimeout(loadData, 1); 
                    },
                    error: function(e)
                    {
                        interval = setTimeout(loadData, 1); 
                    }
                    
                });
            };
        </script>
    </body>
    </html>
    