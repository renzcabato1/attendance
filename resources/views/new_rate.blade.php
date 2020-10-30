{{-- New Laborer --}}
<div class="modal fade" id="new_holiday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">New Rate</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='new-rate' >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">Agency:</label>
                    <select id='agency' data-placeholder="Select Agency" class="chosen-select form-control" name='agency'  >
                        <option></option>
                        @foreach($agencies as $agency)
                        <option value='{{$agency->id}}'>{{$agency->agency_name}}</option>
                        @endforeach
                    </select>
                    <label style="position:relative; top:7px;">Position:</label>
                    <select id='position' data-placeholder="Select Position" class="chosen-select form-control" name='position' required >
                        <option></option>
                        @foreach($positions as $position)
                        <option value="{{$position->id}}" >{{$position->work_name}}</option>
                        @endforeach
                    </select>
                    <label style="position:relative; top:7px;">Basic Salary:</label>
                    <input type="number" name="basic_salary" step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">13 Month Salary:</label>
                    <input type="number" name="thirteen_month_salary"  step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">SIL:</label>
                    <input type="number" name="sil"  step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">Hazard Pay:</label>
                    <input type="number" name="hazard_pay"  step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">E-Cola:</label>
                    <input type="number" name="ecola"  step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">SSS:</label>
                    <input type="number" name="sss"  step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">PPE:</label>
                    <input type="number" name="ppe"  step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">Philhealth:</label>
                    <input type="number" name="ph"  step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">Pag-Ibig:</label>
                    <input type="number" name="hdmf"  step="0.01" class="form-control" required>
                    <label style="position:relative; top:7px;">EC:</label>
                    <input type="number" name="ec" step="0.01" class="form-control" required>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='submit1' class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>