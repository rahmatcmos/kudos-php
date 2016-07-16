@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/customers">{{ trans('customers.customers') }}</a> > {{ trans('crud.edit') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          {{ Form::open(['url' => 'admin/customers/' . $customer->id]) }}
            {{ Form::hidden('_method', 'DELETE') }}
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#address">{{ trans('crud.add') }} {{ trans('address.address') }}</button>
            {{ Form::submit(trans('crud.delete'), ['class' => 'btn btn-danger']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      <!-- if there are creation errors, they will show here -->
      {{ Html::ul($errors->all()) }}
      {{ Form::model($customer, ['url' => 'admin/customers/'.$customer->id, 'method' => 'PUT']) }}
        {{ Form::hidden('shop_id', session('shop')) }}
        {{ Form::label('first_name', trans('customers.first name')) }}
        {{ Form::text('first_name', $customer->first_name, ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('last_name', trans('customers.last name')) }}
        {{ Form::text('last_name', $customer->last_name, ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::label('telephone', trans('customers.telephone')) }}
        {{ Form::text('telephone', $customer->telephone, ['class' => 'form-control']) }}
        {{ Form::label('email', trans('customers.email')) }}
        {{ Form::email('email', $customer->email, ['class' => 'form-control', 'required' => 'required']) }}
        {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
      {{ Form::close() }}
    </div>
  </section>
  
  <div id="address" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
          <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
    
@endsection
