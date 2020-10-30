
{{-- Edit Attendance --}}
<div class="modal fade" id="edit_attendance{{$attendance->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Edit Attendance</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='edit-attendance/{{$attendance->id}}'  >
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
                            <label style="position:relative; top:7px;">Date: {{$date_new}} ({{date('D', strtotime($dates[$key1]))}})</label>
                        </div>
                    </div>
                    <div class='row'>
                            <div class='col-md-2'>
                                <label style="position:relative; top:7px;">Time In:</label>
                                <input  type="hidden" class="form-control" name="name" value='{{$name}}' required >
                                <input  type="hidden" class="form-control" name="date"  value='{{ date('Y-m-d', strtotime($attendance->time_in))}}' required >
                                <input id='start_time1{{$name.$new_date}}'  type="time" class="form-control" name="start_time" value='{{ date('H:i', strtotime($attendance->time_in))}}'  required >
                                <p class='error' id='start_time_error1{{$name.$new_date}}'></p>
                            </div>
                            <div class='col-md-2'>
                                <label style="position:relative; top:7px;">Time Out:</label>
                                <input id='end_time1{{$name.$new_date}}'  type="time" class="form-control" name="end_time" value='{{ date('H:i', strtotime($attendance->time_out))}}'  required >
                                <p class='error' id='end_time_error1{{$name.$new_date}}'></p>
                            </div>
                            <div class='col-md-2'>
                                <label style="position:relative; top:7px;">&nbsp;</label>
                                <div class="form-group">
                                    <input style="position:relative; top:7px;" {{ (date('Y-m-d', strtotime($attendance->time_in)) != date('Y-m-d', strtotime($attendance->time_out)) ? "checked":"") }}  id='nextday{{$name.$new_date}}' type="checkbox"  name="nextday" class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">is Nextday</label>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <label style="position:relative; top:7px;">Device:</label>
                                <select id="device{{$name.$new_date}}" data-placeholder="Select Device" class="chosen-select form-control" name='device_name'  >
                                    <option></option>
                                    @foreach($devices as $device)
                                    <option value="{{$device->id}}" {{ ($attendance->device_in == $device->id ? "selected":"") }}>{{$device->name}}</option>
                                    @endforeach
                                </select>
                                <p class='error' id='device_error{{$name.$new_date}}'></p>
                            </div>
                            <div class='col-md-2'>
                                <label style="position:relative; top:7px;">Remarks:</label>
                                <div class="form-group">
                                    <input  type="remarks" id="remarks{{$name.$new_date}}" class="form-control" name="remarks" placeholder="Remarks" required >  
                                </div>
                                <p class='error' id='remarks_error{{$name.$new_date}}'></p>
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
