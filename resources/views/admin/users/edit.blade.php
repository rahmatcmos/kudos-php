@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/users">{{ trans('users.users') }}</a> > {{ trans('crud.edit') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          {{ Form::open(['url' => 'admin/users/' . $user->id]) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit(trans('crud.delete'), ['class' => 'btn btn-danger']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Html::ul($errors->all(), ['class' => 'alert alert-danger']) }}
      {{ Form::model($user, ['url' => 'admin/users/'.$user->id, 'method' => 'PUT']) }}
        {{ Form::label('first_name', trans('users.first name')) }}
        {{ Form::text('first_name', $user->first_name, ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('last_name', trans('users.last name')) }}
        {{ Form::text('last_name', $user->last_name, ['class' => 'form-control']) }}
        {{ Form::label('email', trans('users.email')) }}
        {{ Form::email('email', $user->email, ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('password', trans('users.new password')) }}
        {{ Form::password('password', ['class' => 'form-control']) }}
        {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
