<script type="text/javascript">
  tinymce.init({
    selector : "textarea#description",
    plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
    toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
  }); 
     $( document ).ready(function() {
         $(".inputgambar").change(function () {
	        readURL(this);
	    });

    });
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
{!! Form::label('name', 'Nama', ['class'=>'col-md-12 control-label']) !!} 
<div class="col-md-6">
{!! Form::text('name', null, ['class'=>'form-control']) !!}
{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group{{ $errors->has('credit') ? ' has-error' : '' }}">
{!! Form::label('credit', 'Credit', ['class'=>'col-md-12 control-label']) !!} 
<div class="col-md-6">
{!! Form::text('credit', null, ['class'=>'form-control']) !!}
{!! $errors->first('credit', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group">
	{!! Form::label('name', 'Description', ['class'=>'col-md-12 control-label']) !!}
</div>
<div class="form-group">
	
	<div class="col-md-12">
		{!! Form::textarea('description', null, ['id'=>'description']) !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-12">
	   @if(isset($image))
	    <img src="{{ asset('image/original/'.$image->path) }}" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />
	  	@else
	     <img src="http://placehold.it/100x100" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />
	    @endif
	</div>

</div>
<div class="form-group{{ $errors->has('path') ? ' has-error' : '' }}">
	
	<div class="col-md-6">
	{{ Form::file('path', ['class' => 'inputgambar']) }}
	{!! $errors->first('path', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group">
<div class="col-md-6 ">
<button type="submit" class="btn btn-primary">
<i class="fa fa-btn fa-user"></i> Submit
</button>
</div>
</div>

