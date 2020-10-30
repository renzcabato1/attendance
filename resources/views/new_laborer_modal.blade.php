{{-- New Laborer --}}
<div class="modal fade" id="new_laborer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">New laborer</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='new-laborer' >
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{-- <img width='100%' src='{{$laborer->image}}'> --}}
                    <label style="position:relative; top:7px;">User ID:</label>
                    <input type="text" name="user_id" placeholder=''  class="form-control" required>
                    <label style="position:relative; top:7px;">Name:</label>
                    <input type="text" name="name" placeholder=''  class="form-control" required>
                  
                    <label style="position:relative; top:7px;">Agency:</label>
                    <select id='agency' data-placeholder="Select Agency" class="chosen-select form-control" name='agency'  >
                        <option></option>
                        @foreach($agencies as $agency)
                        <option value='{{$agency->id}}'>{{$agency->agency_name}}</option>
                        @endforeach
                    </select>

                   
                    <label style="position:relative; top:7px;">Status:</label>
                    <select id='status' data-placeholder="Select Status" class="form-control" name='status'  >
                        <option></option>
                        <option value='AC' >AC</option>
                        <option value='IN' >IN</option>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>