
{{-- edit Profile --}}
<div class="modal fade" id="edit_account{{$account->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <style>
                #department{{$account->id}}_chosen{
                    width: 100% !important;
                }
                #role{{$account->id}}_chosen{
                    width: 100% !important;
                }
                #agency{{$account->id}}_chosen{
                    width: 100% !important;
                }
                #company{{$account->id}}_chosen{
                    width: 100% !important;
                }
                #position{{$account->id}}_chosen{
                    width: 100% !important;
                }
            </style>
            <form  method='POST' action='edit-user/{{$account->id}}'>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Name:</label>
                            <input id='name{{$account->id}}' type="text" name="name" placeholder='' value='{{$account->name}}' class="form-control" required>
                        </div>
                        <div class='col-md-6'>
                            
                            
                            <label style="position:relative; top:7px;">Email:</label>
                            <input type="email{{$account->id}}" name="email" placeholder='' value='{{$account->email}}' class="form-control" required>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Company:</label>
                            <select id='company{{$account->id}}' data-placeholder="Select Company" class="chosen-select form-control" name='company[]' required multiple>
                                <option></option>
                                @foreach($companies as $company)
                                <option value='{{$company->id}}' {{ (in_array($company->id,json_decode($account->company)) ? "selected":"") }}>{{$company->company_name}}</option>
                                @endforeach
                                {{-- <option value="0" >All</option> --}}
                            </select>
                        </div>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Department:</label>
                            <select id='department{{$account->id}}' data-placeholder="Select Department" class="chosen-select form-control" name='department[]' required multiple>
                                <option></option>
                                @foreach($departments as $department)
                                <option value='{{$department->id}}' {{ (in_array($department->id,json_decode($account->department)) ? "selected":"") }}>{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Agency:</label>
                            <select id='agency{{$account->id}}' data-placeholder="Select Agency" class="chosen-select form-control" name='agency[]' multiple required>
                                <option></option>
                                @foreach($agencies as $agency)
                                <option value='{{$agency->id}}' {{ (in_array($agency->id,json_decode($account->agency)) ? "selected":"") }}>{{$agency->agency_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class='col-md-6'>
                            <label style="position:relative; top:7px;">Position :</label>
                            <select id='position{{$account->id}}' data-placeholder="Select Position" class="chosen-select form-control" name='position[]' multiple required>
                                <option></option>
                                @foreach($positions as $position)
                                <option value='{{$position->id}}' {{ (in_array($position->id,json_decode($account->work)) ? "selected":"") }}>{{$position->work_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <label style="position:relative; top:7px;">Role:</label>
                    <select id='role{{$account->id}}' data-placeholder="Select Role" class="chosen-select form-control" name='role' required>
                        <option></option>
                        @foreach($roles as $role)
                        <option value='{{$role->id}}' {{ ($account->role == $role->id ? "selected":"") }}>{{$role->role}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
