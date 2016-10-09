@extends('themes.Basic.layouts.account')

@section('content')
  <h1>{{ trans('settings.settings') }}</h1>
  {{ Html::ul($errors->all(), ['class' => 'alert alert-warning']) }}
  {{ Form::model(['url' => 'account/settings']) }}
    {{ Form::label('email', trans('users.email')) }}
    {{ Form::email('email', $settings->email, ['class' => 'form-control', 'required' => 'required']) }}
    {{ Form::label('telephone', trans('users.telephone')) }}
    {{ Form::text('telephone', $settings->telephone, ['class' => 'form-control']) }}
    {{ Form::label('password', trans('users.new password')) }}
    {{ Form::password('password', ['class' => 'form-control']) }}
    {{ Form::submit(trans('crud.save'), ['class' => 'btn btn-primary']) }}
  {{ Form::close() }}
@endsection