
{{-- edit Laborer --}}
<div class="modal fade" id="edit_laborer{{$laborer->usruid}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Edit Laborer{{$laborer->id}}</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='edit-laborer/{{$laborer->usruid}}' onsubmit='show()'>
                <style>
                    #department{{$laborer->id}}_chosen{
                        width: 100% !important;
                    }
                    #company{{$laborer->id}}_chosen{
                        width: 100% !important;
                    }
                    #agency{{$laborer->id}}_chosen{
                        width: 100% !important;
                    }
                    #position{{$laborer->id}}_chosen{
                        width: 100% !important;
                    }
                    #status{{$laborer->id}}_chosen{
                        width: 100% !important;
                    }
                </style>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{-- <img width='100%' src='{{$laborer->image}}'> --}}
                    <label style="position:relative; top:7px;">Name:</label>
                    <input type="text" name="name" placeholder='' value='{{$laborer->name}}' class="form-control" readonly>
                   
                   
                    <label style="position:relative; top:7px;">Agency:</label>
                    <select id='agency{{$laborer->id}}' data-placeholder="Select Agency" class="chosen-select form-control" name='agency'  >
                        <option></option>
                        @foreach($agencies as $agency)
                        <option value='{{$agency->id}}' {{ ($laborer->agency_id == $agency->id ? "selected":"") }}>{{$agency->agency_name}}</option>
                        @endforeach
                    </select>

                   
                    <label style="position:relative; top:7px;">Status:</label>
                    <select id='status{{$laborer->id}}' data-placeholder="Select Status" class="chosen-select form-control" name='status'  >
                        <option></option>
                        <option value='AC' {{ ($laborer->active == 'AC' ? "selected":"") }}>AC</option>
                        <option value='IN' {{ ($laborer->active == 'IN' ? "selected":"") }}>IN</option>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>