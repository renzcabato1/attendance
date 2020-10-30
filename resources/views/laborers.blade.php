@extends('layouts.header')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li> <a href="">Laborers </a></li>
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
    @if(auth()->user()->role == 1)
    <div class = 'col-md-6'>
        <a href='#new_laborer'  data-toggle="modal"><button type="button" data-target="#new_laborer" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'><i class="pe-7s-add-user"></i> New Laborer</button></a>
        {{-- <a href='{{ url('/generate-laborer') }}'  onclick = "show()" ><button type="button" class="btn btn-primary pull-left" style='margin-left:28px;margin-bottom:10px;margin-top:10px'><i class="pe-7s-add-user"></i> Update IC Masterlist</button></a> --}}
    </div>
    @endif
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
                        <span style='margin-left:28px;padding-top:50px'>Active (AC) - {{$active_count}}  | Inactive (IN) - {{$inactive_count}} </span>
                        <thead>
                            <td>User ID</td>
                            <td>Name</td>
                            <td>Agency</td>
                            <td>Status</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            @foreach($laborers as $laborer)
                            <tr>
                                <td>{{$laborer->usruid}}</td>
                                <td>{{$laborer->name}}</td>
                                <td>{{$laborer->agency_name}}</td>
                                <td>{{$laborer->active}}</td>
                                <td>
                                    @if(auth()->user()->role == 1)
                                    <a href="#edit_laborer{{$laborer->usruid}}" data-toggle="modal"  class="btn btn-info btn-sm">
                                      
                                        Edit
                                    </a>
                                    @endif
                                    <a  onclick='getImage({{$laborer->usruid}})' data-toggle="modal"  class="btn btn-success btn-sm">
                                 
                                        Generate Image
                                    </a>
                                    @if(auth()->user()->role == 7)
                                        <button onclick="setURL('print_id_laborer/{!!$laborer->id!!}')" data-href="" data-toggle="modal" data-target="#previewID" class="btn btn-primary btn-sm" >
                                            View  ID
                                        </button>

                                        <a href="print_id_laborer/{!!$laborer->id!!}" target="_target" data-toggle="modal"  class="btn btn-danger btn-sm">
                                     
                                            Print ID
                                        </a>
                                       
                                    @endif
                                </td>
                                @include('edit_laborer_modal')
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$laborers->links()}}
                    @include('view_image')
                    <script>
                        function getImage(laborerId)
                        {
                            document.getElementById("myDiv").style.display="block";
                            $.ajax({ 
                                type: "GET",
                                url: "{{ url('/get-image/') }}",            
                                data: {
                                    "laborerId" : laborerId,
                                },
                                dataType: "json",   //expect html to be returned
                                success: function(data){  
                                    document.getElementById("myDiv").style.display="none"; 
                                    $("#viewImage").modal('show');
                                    $('#name_label').html('Name : '+data.laborer.name);
                                    $("#image").attr("src",data.laborer.image);
                                },
                                error: function(e)
                                {
                                    document.getElementById("myDiv").style.display="none"; 
                                    alert("Error: Please try to generate again.");
                                }
                                
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="previewID" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document" style="width:80%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="col-12 modal-title text-center">Laborer ID Preview</h5>
                <br>
                <div class="col-md-12 text-center">
                    <iframe id="previewFrame" src="" frameborder="0" height="340px" width="100%"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger btn-outline" data-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function setURL(url) {
        document.getElementById("previewFrame").src = url +'#toolbar=0&navpanes=0&scrollbar=0';
    }
</script>
@include('new_laborer_modal')
@endsection


