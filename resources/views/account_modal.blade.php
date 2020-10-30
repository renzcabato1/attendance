
{{-- New Account --}}
<div class="modal fade" id="new_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">New Account</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <form  method='POST' action='new-account' >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Name:</label>
                            <input type="text" name="name" placeholder='' value='' class="form-control" required>
                        </div>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Email:</label>
                            <input type="email" name="email" placeholder='' value='' class="form-control" required>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Company:</label>
                            <select id='company' data-placeholder="Select Company" class="chosen-select form-control" name='company[]' required multiple>
                                <option></option>
                                @foreach($companies as $company)
                                <option value='{{$company->id}}'>{{$company->company_name}}</option>
                                @endforeach
                                {{-- <option value="0" >All</option> --}}
                            </select>
                        </div>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Department:</label>
                            <select id='department' data-placeholder="Select Department" class="chosen-select form-control" name='department[]' required multiple>
                                <option></option>
                                @foreach($departments as $department)
                                <option value='{{$department->id}}'>{{$department->name}}</option>
                                @endforeach
                                {{-- <option value="0" >All</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Agency:</label>
                            <select id='agency' data-placeholder="Select Agency" class="chosen-select form-control" name='agency[]' multiple required>
                                <option></option>
                                @foreach($agencies as $agency)
                                <option value='{{$agency->id}}'>{{$agency->agency_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Position :</label>
                            <select id='position' data-placeholder="Select Position" class="chosen-select form-control" name='position[]' multiple required>
                                <option></option>
                                @foreach($positions as $position)
                                <option value='{{$position->id}}'>{{$position->work_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label style="position:relative; top:7px;">Role:</label>
                    <select id='role' data-placeholder="Select Role" class="chosen-select form-control" name='role' required>
                        <option></option>
                        @foreach($roles as $role)
                        <option value='{{$role->id}}'>{{$role->role}}</option>
                        @endforeach
                    </select>
                    <label style="position:relative; top:7px;">New Password:</label>
                    <input type='password'  class="form-control" pattern=".{8,}"  name='password' id='password1'  onkeyup='check1();' required>
                    <p style="font-size:10px;color:red">Passwords must be at least 8 characters long.</p>
                    <label style="position:relative; top:7px;"> Confirm Password :</label>
                    <input type='password'  class="form-control"  pattern=".{8,}" name='password_confirmation'  onkeyup='check1();' id='password2'  required>
                    <p style="font-size:10px;" id='message1'></p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id='submit1' class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 
<script type="text/javascript">
    $('#department').change(function(e){
        if($(this).val() != null)
        {
            $("#department :selected").map(function(i, el) {
                if($(el).val() == 0){
                    e.preventDefault();
                    $('#department option').prop('selected', true).trigger('chosen:updated');
                    $("option[value='0']").prop('selected', false).trigger('chosen:updated');
                }
            });
        }
    });
</script>