<script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.css" type="text/css" />
<script type="text/javascript">
 tinymce.init({
            selector : "textarea#description",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
$(document).ready(function() {
    var oFReader = null;
    var image = null;
    var globalResizedWidth = '600';
    var jcrop_api, globalWidth, globalHeight, globalConfDimension;

    /* INIT */
    $('.image_block').remove();
    $("#uploadImage").val("");

    $("#uploadImage").change(function(){
        $(this).parent().find(".image_block").remove();
        $.when( createImageElement(this) ).done( cropImageElement(this) );
    });
    $("form").submit( function( e ) {
        var form = this;
        var tipe_gambar = $("#tipe").val();
        if(tipe_gambar == 1){
             e.preventDefault(); //Stop the submit for now
                                    //Replace with your selector to find the file input in your form
            var fileInput = $(this).find("input[type=file]")[0],
                file = fileInput.files && fileInput.files[0];
            
            if( file ) {
                var img = new Image();
                img.src = window.URL.createObjectURL( file );
                img.onload = function() {
                    var width = img.naturalWidth;
                    window.URL.revokeObjectURL( img.src );
                    if( width <=  1024) {
                        form.submit();
                    }
                    else {
                        alert('Lebar file tidak boleh melebihi 1024 px.');
                    }
                };
            }
            else { //No file was input or browser doesn't support client side reading
                form.submit();
            }
        }else{
            form.submit();
        }

    });

    
    function createImageElement(obj) {
        var html = '<div class="image_block">';
        html += '<input type="hidden" class="x1" name="x1" value="0" />';
        html += '<input type="hidden" class="y1" name="y1" value="0" />';
        html += '<input type="hidden" class="x2" name="x2" value="0" />';
        html += '<input type="hidden" class="y2" name="y2" value="0" />';
        html += '<br><img class="image_preview" style="width:'+globalResizedWidth+'px" />';
        html += '</div>';
        $(obj).after(html);
    }
   
    function cropImageElement(obj) {
        var ext = getExtension($(obj).val());
        if(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "gif"){
            var dimensionconf = '1000x667';
            var separator = dimensionconf.split("x");
            var dimheight = separator[1];
            var dimwidth = separator[0];
            if(dimwidth != 'undefined' || dimheight != 'undefined'){
                doLoadCropping(obj, dimwidth, dimheight);
            }
            return false;
        }else{
            alert('Silahkan periksa kembali ekstensi file Anda.');
            $('.image_block').remove();
            $("#uploadImage").val("");
            return false;
        }
    }

    function doLoadCropping(obj, dimwidth, dimheight) {
        if(oFReader !=null){
            oFReader = null;
        }
        
        var min_width = dimwidth;
        var min_height = dimheight;
        var objFile = obj.files[0];
        var max_foto_mb = '2';
        var max_foto_byte = parseInt(max_foto_mb)*1048576; //convert MB to Byte
        
        if(objFile.size > max_foto_byte) {
            $(obj).parent().find(".image_block").remove();
            $(obj).val("");
            alert("File terlalu besar, silahkan upload file dengan ukuran yang lebih kecil");
            $('.image_block').remove();
            $("#uploadImage").val("");
        } else {
            // prepare HTML5 FileReader
            oFReader = new FileReader();
            image  = new Image();
            oFReader.readAsDataURL(objFile);
            
            oFReader.onload = function (_file) {
                image.src    = _file.target.result;
                image.onload = function() {
                        globalWidth = this.width;
                        globalHeight = this.height;
                        
                        $(obj).parent().find(".image_preview").attr("src", this.src);

                        if(globalWidth < min_width || globalHeight < min_height) {
                                $(obj).parent().find(".image_block").remove();
                                $(obj).val("");
                                alert("Dimensi gambar terlalu kecil, silahkan upload gambar dengan dimensi yang sesuai");
                        } else {
                            cropImage(globalWidth, globalHeight, min_width, min_height, $(obj).parent().find(".image_preview"));
                        }
                };

                image.onerror= function() {
                    alert('Invalid file type: '+ objFile.type);
                };     
                
            }
        }
    }

    function cropImage(width, height, minwidth, minheight, obj) {
        var resizedWidth = globalResizedWidth;
        var resizedHeight = (resizedWidth * height) / width;
        var resizedMinWidth = (minwidth * resizedWidth) / width;
        var resizedMinHeight = (minheight * resizedHeight) / height;
        
        if(minwidth != '' || minheight != ''){
            $(obj).Jcrop({
                setSelect: [ 0, 0, resizedMinWidth, resizedMinHeight ],
                minSize: [ resizedMinWidth, resizedMinHeight ],
                onSelect: updateCoords,
                allowSelect: false,
                bgFade: true,
                bgOpacity: 0.4,
                aspectRatio: minwidth / minheight
            },function(){
                jcrop_api = this;
            });
        }
    }
    function updateCoords(c){
        $('.x1').val(c.x);
        $('.y1').val(c.y);
        $('.x2').val(c.x2);
        $('.y2').val(c.y2);
        $('.w').val(c.w);
        $('.h').val(c.h);
    };
    function getExtension(filename) {
        return filename.split('.').pop().toLowerCase();
    }
});
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
       
        @endif
    </div>

</div>

<div class="form-group">
    <div class="col-md-12">
        <input type="hidden" id="tipe" name="tipe" />
        <input class="text gbr" type="file" id="uploadImage" name="path" ><br class="clear">
    </div>
</div>
<div class="form-group">
<div class="col-md-6 ">
<button type="submit" class="btn btn-primary">
<i class="fa fa-btn fa-user"></i> Submit
</button>
</div>
</div>

