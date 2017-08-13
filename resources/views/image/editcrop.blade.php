@extends('layouts.app')

@section('content')
 <section id="main-content">
          <section class="wrapper">

            
<div class="container">
    <div class="row">
  <br>
      <div class="col-md-10">
      <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/image') }}">Image</a></li>
          <li class="active">Ubah Image</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Image</h2>
          </div>

          <div class="panel-body">
            {!! Form::model($image, ['method' => 'PATCH','files' => true, 'class'=>'form-horizontal','action'=>['ImageController@updatecrop','id'=>$image->id]]) !!}
            @include('image._formcrop')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
          </section>
      </section>
    
@endsection

