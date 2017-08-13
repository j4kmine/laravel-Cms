
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
<div class="container">
 
        @if (session()->has('flash_notification.message'))
  <div class="container">
    <div class="alert alert-{{ session()->get('flash_notification.level') }}">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {!! session()->get('flash_notification.message') !!}
    </div>
  </div>
@endif
    </div>
<div class="row widget bg-primary">
        <div class="col-xs-12 widget-body">                             
                <div class="col-xs-12 text-right margintop8">
                    <a href="<?php echo Config::get('app.url');?>/system/public/viewlist" class="btn btn-xs btn-warning">List Gambar</a>                                   
                </div>          
        </div>
    </div>   
<div class="panel-body">
{!! Form::open(['url' => 'storecrop',
'method' => 'post', 'files' => true,'class'=>'form-horizontal']) !!}
<input type="hidden" name="is_popup" value="1"> 
@include('image._formcrop')
{!! Form::close() !!}
</div>
                