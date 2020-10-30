{{-- New Laborer --}}
<div class="modal fade" id="new_holiday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">New Holiday</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='new-holiday' >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">Holiday Name:</label>
                    <input type="text" name="holiday_name" placeholder='' value='' class="form-control" required>
                    <label style="position:relative; top:7px;">Holiday Type:</label>
                    <select class='form-control' name = 'holiday_type' required>
                        <option ></option>
                        <option value = 'Legal Holiday'>Legal Holiday</option>
                        <option value = 'Special Holiday'>Special Holiday</option>
                    </select>
                    <label style="position:relative; top:7px;">Holiday Date:</label>
                    <input type="date" name="holiday_date" placeholder='' value='' class="form-control" required>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='submit1' class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>