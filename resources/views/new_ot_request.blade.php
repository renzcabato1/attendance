{{-- New Laborer --}}
<div class="modal fade" id="new_ot_request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">New OT Request</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <style>
                #laborer_select_chosen{
                    width: 100% !important;
                }
            </style>
            <form  method='POST' action='new-ot-request' onsubmit="show()">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label style="position:relative; top:7px;">Date :</label>
                <input type="date" name="date_of_ot" id='date_of_ot' min='@if($generate != null){{date("Y-m-d",strtotime($generate->date_to. "+1 days"  ))}}@endif'  onchange='view_laborers()' class="form-control" required>
                    <label style="position:relative; top:7px;">laborers:</label>
                    <div class='laborer_view_select'>
                    <select data-placeholder="Choose Employee Name..." class="chosen-select form-control" name='laborer[]' id='laborer_select' multiple>
                        {{-- @foreach($laborers as $laborer) --}}
                            <option value="" ></option>
                        {{-- @endforeach --}}
                    </select>
                    </div>
                    <label style="position:relative; top:7px;">Over Time:</label>
                    <input type="number" name="number_of_ot" placeholder='' min='1' max = '{{$max_ot->max_ot}}' step="0.01"  value='' class="form-control" required>
                    
                    <label style="position:relative; top:7px;">Remarks</label>
                    <textarea class='form-control' name='remarks' placeholder='Remarks' required></textarea>
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
    function view_laborers()
    {
        $('.laborer_view_select').children().remove();
        var from = document.getElementById("date_of_ot").value;
        document.getElementById("myDiv").style.display="block";
        $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "{{ url('/get-laborers-ot/') }}",            
            data: {
                "from" : from,
            }     ,
            dataType: "json",   //expect html to be returned
            success: function(data){    
             
                $('.laborer_view_select').append('<select data-placeholder="Choose Employee Name..." class="chosen-select form-control" name="laborer[]"" id="laborer_select" multiple>');
                
                jQuery.each(data, function(laborer) {
                    //now you can access properties using dot notation
                    $('#laborer_select').append('<option value='+ data[laborer].id +' >'+ data[laborer].name +'</option>');
                })
                $('.laborer_view_select').append('</select>');
                
                var chosen_js = '{{ asset('/chosen/chosen.jquery.js')}}';
                var init_js = '{{ asset('/chosen/docsupport/init.js')}}';
                $.getScript(chosen_js);
                $.getScript(init_js,function(jd) {
                    $("#laborer_select_chosen").css({"width": "100%"});
                });
                document.getElementById("myDiv").style.display="none";
            },
            error: function(e)
            {
                
            }
            
        });
    }
</script>