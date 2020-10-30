
{{-- Add Remarks --}}

<div class="modal fade" id="add_remarks{{$name.$new_date}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Add Remarks</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='add-remarks'  >
                <style>
                    #device{{$namea.$new_date}}_chosen{
                        width: 100% !important;
                    }
                </style>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-12'>
                            <label style="position:relative; top:7px;">Employee Name: {{$name_all[$key]->name}}</label>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <label style="position:relative; top:7px;">Date: {{$date_new}}  </label>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <label style="position:relative; top:7px;">Remarks: </label>
                            <input type='hidden' name = 'date' value='{{$date}}'>
                            <input type='hidden' name = 'laborer_id' value='{{$name_all[$key]->id}}'>
                            <textarea name='remarks' class="form-control" placeholder='Remarks' required></textarea>
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
