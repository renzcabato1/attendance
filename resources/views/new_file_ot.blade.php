{{-- New Laborer --}}
<div class="modal fade" id="new_file_ot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Can file OT</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <style>
                #company_select_chosen{
                    width: 100% !important;
                }
                #department_select_chosen{
                    width: 100% !important;
                }
                #position_select_chosen{
                    width: 100% !important;
                }
            </style>
            <form  method='POST' action='new-file-ot' onsubmit="show()">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">Company :</label>
                   <select id='company' class='form-control chosen-select' name='company' required>
                        <option></option>
                        @foreach($companies as $company)
                        <option value='{{$company->id}}'>{{$company->company_name}}</option>
                        @endforeach
                   </select>
                    <label style="position:relative; top:7px;">Department :</label>
                   <select id='department' class='form-control chosen-select' name='department' required>
                        <option></option>
                        @foreach($departments as $department)
                        <option value='{{$department->id}}'>{{$department->name}}</option>
                        @endforeach
                   </select>
                    <label style="position:relative; top:7px;">Position :</label>
                   <select id='position' class='form-control chosen-select' name='work' required>
                        <option></option>
                        @foreach($positions as $position)
                        <option value='{{$position->id}}'>{{$position->work_name}}</option>
                        @endforeach
                   </select>
                    
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id='submit1' class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
