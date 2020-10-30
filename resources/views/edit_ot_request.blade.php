{{-- New Laborer --}}
<div class="modal fade" id="edit_ot_request{{$ot_request->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Edit OT Request</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <style>
                    #laborer_select{{$ot_request->id}}_chosen{
                        width: 100% !important;
                    }
                </style>
            <form  method='POST' action='edit-ot-request/{{$ot_request->id}}' onsubmt="show()">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">laborers:</label>
                    <select data-placeholder="Choose Employee Name..." class="chosen-select form-control" name='laborer' id='laborer_select{{$ot_request->id}}' >
                        @foreach($laborers as $laborer)
                        <option value="{{$laborer->id}}" {{ ($laborer->id == $ot_request->laborer_id ? "selected":"") }}>{{$laborer->name}}</option>
                        @endforeach
                    </select>
                    <label style="position:relative; top:7px;">Over Time:</label>
                    <input type="number" name="number_of_ot" placeholder='' min='1' max = '{{$max_ot->max_ot}}' value='{{$ot_request->ot_request}}'  class="form-control" required>

                    <label style="position:relative; top:7px;">Date :</label>
                    <input type="date" name="date_of_ot" placeholder='' value='{{$ot_request->date_ot}}' min='@if($generate != null){{$generate->date_to}}@endif' class="form-control" required>

                    <label style="position:relative; top:7px;">Remarks</label>
                    <textarea class='form-control' name='remarks' placeholder='Remarks' required>{{$ot_request->remarks}}</textarea>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='submit1' class="btn btn-primary">Save</button>
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>