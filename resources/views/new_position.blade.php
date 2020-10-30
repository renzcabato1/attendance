{{-- New Laborer --}}
<div class="modal fade" id="new_position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">New Position</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='new-position' >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">Position Name:</label>
                    <input type="text" name="position_name" placeholder='' value='' class="form-control" required>
                    <label style="position:relative; top:7px;">Status:</label>
                    <select class='form-control' name = 'status' required>
                        <option ></option>
                        @foreach($discounts_data as $discount_d)
                        <option value='{{$discount_d->id}}' >{{$discount_d->status_name}}</option>
                        @endforeach
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='submit1' class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>