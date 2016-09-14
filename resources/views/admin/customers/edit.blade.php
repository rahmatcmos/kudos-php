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
  
  <section class="container-fluid">
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
  </section>
  
  @if(!$orders->isEmpty())
  <div class="title row">
    <div class="col-md-12">
      <h2>{{ trans('customers.customers') }} {{ trans('orders.orders') }}</h2>
    </div>
  </div>
  <section class="container-fluid">
    <h2></h2>
    <div class="row">
      @foreach ($orders as $order)
      @endforeach
    </div>
  </section>
  @endif
  
  @if(!$addresses->isEmpty())
  <section class="container-fluid">
    <h2 class="heading">{{ trans('customers.customers') }} {{ trans('address.addresses') }}</h2>
    <div class="row">
      @foreach ($addresses as $address)
      <address class="col-md-4 col-lg-3">
        {{ $address->address1 }}<br>
        {!! !empty($address->address2) ? $address->address2.'<br>' : '' !!}
        {!! !empty($address->address3) ? $address->address3.'<br>' : '' !!}
        {{ $address->town }}<br>
        {{ $address->county }}<br>
        {{ $address->postcode }}<br>
        {{ $address->country }}<br>
        {{ Form::open(['url' => 'admin/addresses/' . $address->id]) }}
          {{ Form::hidden('_method', 'DELETE') }}
          <a href="/admin/addresses/{{ $address->id }}/edit" class="btn btn-success">{{ trans('crud.edit') }} {{ trans('address.address') }}</a>
          {{ Form::submit(trans('crud.delete'), ['class' => 'btn btn-danger']) }}
        {{ Form::close() }}
      </address>   
      @endforeach
    </div>
  </section>
  @endif
  
  <div id="address" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{ trans('crud.add') }} {{ trans('address.address') }}</h4>
        </div>
        {{ Form::model($customer, ['url' => 'admin/addresses']) }}
        <div class="modal-body">
            {{ Form::hidden('customer_id', $customer->id) }}
            
            {{ Form::label('address1', trans('address.address1')) }}
            {{ Form::text('address1', '', ['class' => 'form-control', 'required' => 'required']) }}
            {{ Form::label('address2', trans('address.address2')) }}
            {{ Form::text('address2', '', ['class' => 'form-control']) }}
            {{ Form::label('address3', trans('address.address3')) }}
            {{ Form::text('address3', '', ['class' => 'form-control']) }}
            {{ Form::label('town', trans('address.town')) }}
            {{ Form::text('town', '', ['class' => 'form-control', 'required' => 'required']) }}
            {{ Form::label('county', trans('address.county')) }}
            {{ Form::text('county', '', ['class' => 'form-control', 'required' => 'required']) }}
            {{ Form::label('postcode', trans('address.postcode')) }}
            {{ Form::text('postcode', '', ['class' => 'form-control', 'required' => 'required']) }}
            {{ Form::label('country', trans('address.country')) }}
            {{ Form::text('country', '', ['class' => 'form-control', 'required' => 'required']) }}
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">{{ trans('crud.add') }}</button>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
    
@endsection
