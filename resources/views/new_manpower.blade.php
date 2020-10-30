{{-- New Laborer --}}
<div class="modal fade" id="new_manpower" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">New Manpower</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='new-manpower' onsubmit="show()">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">Number of Manpower:</label>
                    <input type="number" name="number_of_manpower" placeholder='' value='' class="form-control" required>
                    <label style="position:relative; top:7px;">Department</label>
                    <select class='form-control' name = 'department' required>
                        <option></option>
                        @foreach($departments as $department)
                            <option value='{{$department->id}}'>{{$department->name}}</option>
                        @endforeach
                    </select>
                    <label style="position:relative; top:7px;">Position</label>
                    <select class='form-control' name = 'position' required>
                        <option></option>
                        @foreach($positions as $position)
                            <option value='{{$position->id}}'>{{$position->work_name}}</option>
                        @endforeach
                    </select>
                    <label style="position:relative; top:7px;">Remarks</label>
                    <textarea class='form-control' name='remarks' placeholder='Remarks'></textarea>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='submit1' class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>