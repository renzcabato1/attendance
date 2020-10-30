
{{-- edit Laborer --}}
<div class="modal fade" id="viewImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='row'>
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Generated Image</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{-- <img width='100%' src='{{$laborer->image}}'> --}}
                    <label style="position:relative; top:7px;" id = 'name_label'></label>
                    <img style='width:80%;display:block;margin-left:auto;margin-right:auto;' id='image' src=''>
               
                   
                </div>
        </div>
    </div>
</div>