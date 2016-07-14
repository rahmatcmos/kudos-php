@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <h1><a href="/admin/users">{{ trans('users.users') }}</a> > {{ trans('crud.create') }}</h1>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <!-- if there are creation errors, they will show here -->
      {{ Html::ul($errors->all()) }}
      {{ Form::open(['url' => 'admin/users']) }}
        {{ Form::label('name', trans('users.name')) }}
        {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('email', trans('users.email')) }}
        {{ Form::email('email', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('password', trans('users.password')) }}
        {{ Form::password('password', ['class' => 'form-control']) }}
        {{ Form::submit(trans('crud.create'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
