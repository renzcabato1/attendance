
{{-- edit Laborer --}}
<div class="modal fade" id="edit_schedule{{$schedule->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='edit-schedule/{{$schedule->id}}' onsubmit="show_alert({{$schedule->id}})">
                <style>
                    #devices{{$schedule->id}}_chosen{
                        width: 100% !important;
                    }
                </style>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-12'>
                            <label style="position:relative; top:7px;">Employee Name: {{$schedule->laborer_name}}</label>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-4'>
                            <label style="position:relative; top:7px;">Start Time:</label>
                            <input  type="hidden" class="form-control" name="date" value="{{$schedule->date}}"  required >
                            <input id='start_time{{$schedule->id}}'  type="time" class="form-control" name="start_time" value="{{$schedule->start_time}}"  required >
                            <p class='error' id='error{{$schedule->id}}'></p>
                            <p class='error' id='start_time_error{{$schedule->id}}'></p>
                        </div>
                        <div class='col-md-4'>
                            <label style="position:relative; top:7px;">End Time:</label>
                            <input id='end_time{{$schedule->id}}'  type="time" class="form-control" name="end_time" value="{{$schedule->end_time}}"  required >
                            <p class='error' id='end_time_error{{$schedule->id}}'></p>
                        </div>
                        <div class='col-md-4'>
                            <label style="position:relative; top:7px;">Device:</label>
                            <select id='devices{{$schedule->id}}' data-placeholder="Select Device" class="chosen-select form-control" name='device_name'  >
                                @foreach($devices as $device)
                                <option value="{{$device->id}}" {{ ($schedule->device_id == $device->id ? "selected":"") }}>{{$device->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-4'>
                            <label style="position:relative; top:7px;">&nbsp;</label>
                            <div class="form-group">
                                <input style="position:relative; top:7px;" {{ ($schedule->date != $schedule->end_date ? "checked":"") }}  type="checkbox"  name="nextday" class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">is Nextday</label>
                                <p class='error' id='end_time_error{{$schedule->id}}'></p>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <label style="position:relative; top:7px;">&nbsp;</label>
                            <div class="form-group">
                                <input style="position:relative; top:7px;"   type="checkbox" {{ ($schedule->rest_day == 1 ? "checked":"") }}  name="restday" class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">Rest Day</label>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <label style="position:relative; top:7px;">&nbsp;</label>
                            <div class="form-group">
                                <input style="position:relative; top:7px;"   type="checkbox" {{ ($schedule->with_breaktime == 1 ? "checked":"") }}  name="breaktime" class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">With Breaktime</label>
                            </div>
                        </div>
                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='{{$schedule->id}}' class="btn btn-primary" onclick="show_alert(this.id);">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
