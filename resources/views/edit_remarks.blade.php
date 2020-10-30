
{{-- Edit Remarks --}}

<div class="modal fade" id="edit_remarks{{$generate->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Edit Remarks</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='save-remarks/{{$generate->id}}' onsubmit='show()'  >
                <div class="modal-body">
                    {{ csrf_field() }}
                
                    <div class='row'>
                        <div class='col-md-12'>
                            <label style="position:relative; top:7px;">Remarks: </label>
                            <textarea name='remarks' class="form-control" style='height:300px;' placeholder='Remarks' required>{{$generate->remarks}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary" >Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
