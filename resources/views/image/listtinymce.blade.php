<link href="{{ asset('css/bootstrap.min.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.dataTables.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/dataTables.bootstrap.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/selectize.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/selectize.bootstrap3.css') }}" rel="stylesheet">
<link href="{{ asset('css/theme/assets/css/zabuto_calendar.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/theme/assets/js/gritter/css/jquery.gritter.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/theme/assets/lineicons/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/theme/assets/css/style.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/theme/assets/css/style-responsive.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/jquery.Jcrop.min.css') }}" rel='stylesheet' type='text/css'>

<link href="{{ asset('css/jquery.fancybox.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/font-awesome.css') }}" rel='stylesheet' type='text/css'>

<script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.Jcrop.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script type="text/javascript">
function selectURL(title,url,tipe) {
    if (url == '') return false;
    url = url;
    if(tipe == 1){
        top.tinyMCE.execCommand('mceInsertContent', false, '<img class="img-responsive" alt="'+title+'" src="' + url + '"/>');
        top.tinymce.activeEditor.windowManager.close();
    }else{
         top.tinyMCE.execCommand('mceInsertContent', false, '<div class="row"><div class="col-xs-12"><img class="img-responsive" alt="'+title+'" src="' + url + '"/></div></div>');
        top.tinymce.activeEditor.windowManager.close();
    }
  


}


function searchThis() {     
    var frm = document.searchform;
    title = frm.title.value;
    if(title == ''){ title = '-'; }
    location = "<?php echo Config::get('app.url');?>/system/public/searchlisttinymce/"+encode_js(title.trim());
}
function encode_js(str){
    str = (str + '').toString();
    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
    replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '%20').replace(/\s/g,'%20').replace(/%2F/g,'-').replace(/%/g,'%25');
}
</script>
<section class="main-content"> 
    <div class="content-wraps">     
        <div class="wrappers">
            <div class="panelss">
                <div class="panel-bodyss"> 
                    <div class="row widget bg-primary">
                        <div class="col-xs-12 widget-body">
                            <form id="searchform" name="searchform" method="POST" action="" onsubmit="searchThis(); return false;">
                                <div class="col-xs-3">
                                    <input type="text" class="form-control" name="title" placeholder="Kata Kunci">
                                </div>
                                <div class="col-xs-6">
                                    <button class="btn btn-success"  onclick="searchThis()"><i class="ti-search"></i>Search</button>
                                </div>
                                <div class="col-xs-3 text-right margintop8">
                                    <a href="<?php echo Config::get('app.url');?>/system/public/createcroppopup" class="btn btn-xs btn-warning">Upload Gambar</a>                                   
                                </div>
                            </form>
                        </div>
                    </div> 
                    <?php $url = Config::get('app.url')."/system/public/image/original/" ;?>
              
                    <div id="listData">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="table-responsive">
                                      @foreach ($image as $images)
                                         <div class="col-xs-8">
                                            <div class="box border1px">
                                                <div class="image">
                                                 <img src="{{url('/image/original/'.$images->path)}}" alt="Image" class="img-responsive"/>
                                                </div>
                                                                                                    
                                            </div>
                                         </div>
                                         <div class="col-xs-4">
                                                <button class="btn btn-primary btn-xs" type="button" onclick="selectURL('<?php echo $images->name; ?>','<?php echo $url.$images->path; ?>',1)">
                                                    Insert Orginial Image
                                                </button>
                                                  <br/>
                                                  <br/>
                                                  <button class="btn btn-primary btn-xs" type="button" onclick="selectURL('<?php echo $images->name; ?>','<?php echo $url.$images->path; ?>',2)">
                                                    Insert Full Bootsrap Image
                                                </button>
                                        </div>            
                                      @endforeach
                                </div>                                                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
    </div>
    <a class="exit-offscreen"></a>
</section>