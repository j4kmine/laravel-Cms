<script type="text/javascript">
  tinymce.init({
    selector : "textarea#culture",
    plugins : ["advlist autolink lists link image charmap print preview anchor template addimageleft " , "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste gambar"],
    toolbar : "insertfile undo redo addimageleft | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image gambar",
    content_css : '<?php echo Config::get("app.url");?>/system/public/css/bootstrap.min.css,<?php echo Config::get("app.url");?>/system/public/css/theme/assets/css/style-responsive.css,<?php echo Config::get("app.url");?>/system/public/css/backend_custome.css,<?php echo Config::get("app.url");?>/system/public/css/layout.css,<?php echo Config::get("app.url");?>/system/public/css/components.css'
  }); 
   tinymce.init({
    selector : "textarea#language",
    plugins : ["advlist autolink lists link image charmap print preview anchor template addimageleft " , "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste gambar"],
    toolbar : "insertfile undo redo addimageleft | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image gambar",
        content_css : '<?php echo Config::get("app.url");?>/system/public/css/bootstrap.min.css,<?php echo Config::get("app.url");?>/system/public/css/theme/assets/css/style-responsive.css,<?php echo Config::get("app.url");?>/system/public/css/backend_custome.css,<?php echo Config::get("app.url");?>/system/public/css/layout.css,<?php echo Config::get("app.url");?>/system/public/css/components.css'
  }); 
    tinymce.init({
    selector : "textarea#tourism_place",
    plugins : ["advlist autolink lists link image charmap print preview anchor template addimageleft " , "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste gambar"],
    toolbar : "insertfile undo redo addimageleft | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image gambar",
        content_css : '<?php echo Config::get("app.url");?>/system/public/css/bootstrap.min.css,<?php echo Config::get("app.url");?>/system/public/css/theme/assets/css/style-responsive.css,<?php echo Config::get("app.url");?>/system/public/css/backend_custome.css,<?php echo Config::get("app.url");?>/system/public/css/layout.css,<?php echo Config::get("app.url");?>/system/public/css/components.css'
  }); 
   tinymce.init({
    selector : "textarea#investment_oportunity",
    plugins : ["advlist autolink lists link image charmap print preview anchor template addimageleft " , "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste gambar"],
    toolbar : "insertfile undo redo addimageleft | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image gambar",
        content_css : '<?php echo Config::get("app.url");?>/system/public/css/bootstrap.min.css,<?php echo Config::get("app.url");?>/system/public/css/theme/assets/css/style-responsive.css,<?php echo Config::get("app.url");?>/system/public/css/backend_custome.css,<?php echo Config::get("app.url");?>/system/public/css/layout.css,<?php echo Config::get("app.url");?>/system/public/css/components.css'
  }); 
  tinymce.init({
    selector : "textarea#culinary",
    plugins : ["advlist autolink lists link image charmap print preview anchor template addimageleft " , "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste gambar"],
    toolbar : "insertfile undo redo addimageleft | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image gambar",
        content_css : '<?php echo Config::get("app.url");?>/system/public/css/bootstrap.min.css,<?php echo Config::get("app.url");?>/system/public/css/theme/assets/css/style-responsive.css,<?php echo Config::get("app.url");?>/system/public/css/backend_custome.css,<?php echo Config::get("app.url");?>/system/public/css/layout.css,<?php echo Config::get("app.url");?>/system/public/css/components.css'
  });
   tinymce.init({
    selector : "textarea#hotel",
    plugins : ["advlist autolink lists link image charmap print preview anchor template addimageleft " , "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste gambar"],
    toolbar : "insertfile undo redo addimageleft | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image gambar ",
        content_css : '<?php echo Config::get("app.url");?>/system/public/css/bootstrap.min.css,<?php echo Config::get("app.url");?>/system/public/css/theme/assets/css/style-responsive.css,<?php echo Config::get("app.url");?>/system/public/css/backend_custome.css,<?php echo Config::get("app.url");?>/system/public/css/layout.css,<?php echo Config::get("app.url");?>/system/public/css/components.css'
  }); 
$(document).ready(function(){
	 $('.openpopupberita').click(function(){
	     $.fancybox.open([{
	            type:'iframe',
	            autoSize        :  false,
	            width:'85%',
	            href:'<?php echo Config::get("app.url");?>/system/public/viewlist',
	       }])
 	});

});
function removedatapublish(){
	$('#list-path').html("");
}
function selectimageberita(id,name){
	   var htmldata = "";
        htmldata += "<div id='path_"+id+"' >";
	    htmldata += "<input type='hidden' name='id_image' value='"+id+"'>";
	    htmldata += "<div class='row boxdatapublish'>";
	    htmldata += "<div class='col-xs-12'>"+'<img src="<?php echo Config::get("app.url");?>/system/public/image/original/'+name+'"style="max-width:500px;max-height:500px;" />'+"</div>"
	    htmldata += "<div class='col-xs-12' text-center><button class='btn btn-xs btn-danger' onclick='removedatapublish("+id+")'>Hapus</button></div>  ";
	    htmldata += "</div>";
	    htmldata += "</div>";

        $('#list-path').html(htmldata);
}
</script>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
{!! Form::label('name', 'Nama', ['class'=>'col-md-12 control-label']) !!} 
<div class="col-md-6">
{!! Form::text('name', null, ['class'=>'form-control']) !!}
{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group">
	{!! Form::label('name', 'Culture', ['class'=>'col-md-12 control-label']) !!}
</div>
<div class="form-group">
	
	<div class="col-md-12">
		{!! Form::textarea('culture', null, ['id'=>'culture']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('name', 'Language', ['class'=>'col-md-12 control-label']) !!}
</div>
<div class="form-group">
	
	<div class="col-md-12">
		{!! Form::textarea('language', null, ['id'=>'language']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('name', 'Tourism Place', ['class'=>'col-md-12 control-label']) !!}
</div>
<div class="form-group">
	
	<div class="col-md-12">
		{!! Form::textarea('tourism_place', null, ['id'=>'tourism_place']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('name', 'Investment Opportunity', ['class'=>'col-md-12 control-label']) !!}
</div>
<div class="form-group">
	
	<div class="col-md-12">
		{!! Form::textarea('investment_oportunity', null, ['id'=>'investment_oportunity']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('name', 'Culinary', ['class'=>'col-md-12 control-label']) !!}
</div>
<div class="form-group">
	
	<div class="col-md-12">
		{!! Form::textarea('culinary', null, ['id'=>'culinary']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('name', 'Penginapan', ['class'=>'col-md-12 control-label']) !!}
</div>
<div class="form-group">
		
	<div class="col-md-12">
		{!! Form::textarea('hotel', null, ['id'=>'hotel']) !!}
	</div>
</div>
<div class="form-group{{ $errors->has('lng') ? ' has-error' : '' }} {{ $errors->has('lat') ? ' has-error' : '' }}">

<div class="col-md-4">
{!! Form::text('lng', null, ['class'=>'form-control','placeholder'=>'Longitude']) !!}
{!! $errors->first('lng', '<p class="help-block">:message</p>') !!}
</div>

<div class="col-md-4">
{!! Form::text('lat', null, ['class'=>'form-control','placeholder'=>'Latitude']) !!}
{!! $errors->first('lat', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group">
<div class="col-md-12">
	 <div id="list-path">
	 	@if(isset($provinsi->image_detail->path))
		 	<div id="path_{{ $provinsi->image_detail->id }}">
		 			<input type="hidden" name="id_image" value="{{$provinsi->image_detail->id}}"><div class="row boxdatapublish">
		 			<div class="col-xs-12"><img src="{{ asset('image/original/'.$provinsi->image_detail->path ) }}" style="max-width:500px;max-height:500px;">
		 			</div>
		 			<div class="col-xs-12" text-center="">
		 				<button class="btn btn-xs btn-danger" type="button" onclick="removedatapublish({{$provinsi->image_detail->id}})">Hapus</button>
		 		    </div>  
		 		</div>
		 	</div>

		@endif
	 </div>
</div>
</div>

<div class="form-group">
<div class="col-md-12 ">
 <a href="#" id="btn-berita" class="btn btn-primary openpopupberita">Pilih Gambar</a>
</div>
</div>
<div class="form-group">
<div class="col-md-6 ">
<button type="submit" class="btn btn-primary">
<i class="fa fa-btn fa-user"></i> Submit
</button>
</div>
</div>

