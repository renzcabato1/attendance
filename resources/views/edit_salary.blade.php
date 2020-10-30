
{{-- edit Laborer --}}
<div class="modal fade" id="edit_salary{{$salary->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Edit Laborer</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='edit-salary'>
                
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{-- <img width='100%' src='{{$laborer->image}}'> --}}
                    <div class='row'>
                        <div class='col-md-6'>
                            <input type="text" name="agency" placeholder='' value='{{$salary->agency_name}}' class="form-control" readonly>
                            <input type="hidden" name="agency_id" placeholder='' value='{{$salary->agency_id}}' class="form-control" >
                        </div>
                        <div class='col-md-6'>
                            <input type="text" name="work" placeholder='' value='{{$salary->work_name}}' class="form-control" readonly>
                            <input type="hidden" name="work_id" placeholder='' value='{{$salary->work_id}}' class="form-control" >
                        </div>
                    </div>
                    <label style="position:relative; top:7px;">Basic Salary:</label>
                    <input type="number" name="basic_salary" value='{{$salary->basic_salary}}' step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">13 Month Salary:</label>
                    <input type="number" name="thirteen_month_salary" value='{{$salary->thirteen_month_salary}}' step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">SIL:</label>
                    <input type="number" name="sil" value='{{$salary->sil}}' step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">Hazard Pay:</label>
                    <input type="number" name="hazard_pay" value='{{$salary->hazard_pay}}' step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">E-Cola:</label>
                    <input type="number" name="ecola" value='{{$salary->ecola}}' step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">SSS:</label>
                    <input type="number" name="sss" value='{{$salary->sss}}' step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">PPE:</label>
                    <input type="number" name="ppe" value='{{$salary->ppe}}' step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">Philhealth:</label>
                    <input type="number" name="ph" value='{{$salary->ph}}' step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">Pag-Ibig:</label>
                    <input type="number" name="hdmf" value='{{$salary->hdmf}}' step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">EC:</label>
                    <input type="number" name="ec" value='{{$salary->ec}}' step="0.01" class="form-control" required>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>