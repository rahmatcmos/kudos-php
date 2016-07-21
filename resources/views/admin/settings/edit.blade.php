@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <h1>{{ trans('settings.settings') }}</h1>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
        <li class="active"><a href="#general" data-toggle="tab">{{ trans('settings.general') }}</a></li>
        <li><a href="#themes" data-toggle="tab">{{ trans('settings.themes') }}</a></li>
      </ul>
    
      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="general">
          {{ Form::model($settings, ['url' => 'admin/settings/'.session('shop'), 'method' => 'PUT']) }}
            {{ Form::label('analytics', trans('settings.analytics')) }}
            {{ Form::text('analytics', $settings->analytics, ['class' => 'form-control']) }}
            {{ Form::label('header', trans('settings.header')) }}
            {{ Form::textarea('analytics', $settings->header, ['class' => 'form-control']) }}
            {{ Form::label('footer', trans('settings.footer')) }}
            {{ Form::textarea('analytics', $settings->footer, ['class' => 'form-control']) }}
            {{ Form::submit(trans('crud.save'), ['class' => 'btn btn-primary']) }}
          {{ Form::close() }}
        </div>
        <div class="tab-pane" id="themes">
          <ul>
            <li class="row">
              <div class="col-xs-8">
                <i class="fa fa-circle text-success"></i> Basic
              </div>
              <div class="col-xs-4 text-right">
                <strong class="text-warning">{{ trans('settings.cannot uninstall') }}</strong>
              </div>
            </li>
          @foreach ($themes as $theme)
            <li class="row">
              <div class="col-xs-8">
                <i class="fa fa-circle text-danger"></i> {{ ucfirst(basename($theme)) }}
              </div>
              <div class="col-xs-4 text-right">
                <a href="#" class="text-success">{{ trans('settings.install') }}</a>
              </div>
            </li>
          @endforeach
          </ul>
        </div>
      </div>
      
    </div>
  </section>
    
@endsection

@section('foot')
<script>
$(function(){
  if(window.location.hash != "") {
    $('a[href="' + window.location.hash + '"]').click()
  }
});
</script>
@endsection
