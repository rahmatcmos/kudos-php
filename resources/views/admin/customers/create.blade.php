@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <h1><a href="/customers">{{ trans('customers.customers') }}</a> > {{ trans('crud.create') }}</h1>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <!-- if there are creation errors, they will show here -->
      {{ Html::ul($errors->all()) }}
      {{ Form::open(['url' => 'customers']) }}
        {{ Form::hidden('shop_id', session('shop')) }}
        {{ Form::label('first_name', trans('customers.first name')) }}
        {{ Form::text('first_name', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('last_name', trans('customers.last name')) }}
        {{ Form::text('last_name', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('email', trans('customers.email')) }}
        {{ Form::email('email', '', ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::submit(trans('crud.create'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
    
@endsection
