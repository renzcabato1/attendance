{{-- New Laborer --}}
<div class="modal fade" id="approved_ot{{$ot_request->id}}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='approved_ot/{{$ot_request->id}}' onsubmit="show()">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">Approved OT:</label>
                    <input type="number" name="approved_ot" min="0" step="0.1" max='{{$max_ot->max_ot}}' placeholder='' value='' class="form-control" required>
                   
                    <label style="position:relative; top:7px;">Remarks</label>
                    <textarea class='form-control' name='remarks' placeholder='Remarks' required></textarea>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='submit1' class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>