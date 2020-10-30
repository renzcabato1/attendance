@if (count($errors))
@foreach($errors->all() as $error)
    <div class="alert alert-danger fade in col-md-6" style='margin-bottom:10px;margin-top:10px;'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> {{ $error }}</strong>
    </div>
@endforeach
@endif
