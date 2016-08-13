@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <h1>{{ trans('settings.settings') }}</h1>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
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
  </section>
    
@endsection
