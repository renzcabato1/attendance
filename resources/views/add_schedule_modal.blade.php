
{{-- Add Schedule --}}
<div class="modal fade" id="add_schedule{{$name.$new_date}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='add-schedule' onsubmit="return show_alert({{$name.$new_date}})" >
                <style>
                    #devices_{{$namea.$new_date}}_chosen{
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
                        <div class='col-md-3'>
                            <label style="position:relative; top:7px;">Start Time:</label>
                            <input  type="hidden" class="form-control" name="name" value='{{$name}}' required >
                            <input  type="hidden" class="form-control" name="date"  value='{{$dates[$key1]}}' required >
                            <input id='start_time_{{$name.$new_date}}'  type="time" class="form-control" name="start_time"  required >
                            <p class='error' id='start_time_error{{$name.$new_date}}'></p>
                        </div>
                        <div class='col-md-2'>
                            <label style="position:relative; top:7px;">End Time:</label>
                            <input id='end_time_{{$name.$new_date}}'  type="time" class="form-control" name="end_time"  required >
                            <p class='error' id='end_time_error{{$name.$new_date}}'></p>
                        </div>
                        <div class='col-md-2'>
                            <label style="position:relative; top:7px;">&nbsp;</label>
                            <div class="form-group">
                                <input style="position:relative; top:7px;" id='nextday1_{{$name.$new_date}}'  type="checkbox"  name="nextday" class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">is Nextday</label>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <label style="position:relative; top:7px;">&nbsp;</label>
                            <div class="form-group">
                                <input style="position:relative; top:7px;"  type="checkbox"  name="rest_day" class='checkbox col-sm-1' value="1"><label class="control-label col-sm-6">Rest Day</label>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <label style="position:relative; top:7px;">Device:</label>
                            <select id="devices_{{$name.$new_date}}" data-placeholder="Select Device" class="chosen-select form-control" name='device_name'  >
                                <option></option>
                                @foreach($devices as $device)
                                <option value="{{$device->id}}" >{{$device->name}}</option>
                                @endforeach
                            </select>
                            <p class='error' id='devices_error{{$name.$new_date}}'></p>
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
