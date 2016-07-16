@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <h1><a href="/admin/customers/{{ $address->customer_id }}/edit">Back to {{ trans('customers.customer') }}</a></h1>
    </div>
  </div>
  
  <section class="container-fluid">
    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}
    {{ Form::model($address, ['url' => 'admin/addresses/'.$address->id, 'method' => 'PUT']) }}
      {{ Form::hidden('customer_id', $address->customer_id) }}
      {{ Form::label('address1', trans('address.address1')) }}
      {{ Form::text('address1', $address->address1, ['class' => 'form-control', 'required' => 'required']) }}
      {{ Form::label('address2', trans('address.address2')) }}
      {{ Form::text('address2', $address->address2, ['class' => 'form-control']) }}
      {{ Form::label('address3', trans('address.address3')) }}
      {{ Form::text('address3', $address->address3, ['class' => 'form-control']) }}
      {{ Form::label('town', trans('address.town')) }}
      {{ Form::text('town', $address->town, ['class' => 'form-control', 'required' => 'required']) }}
      {{ Form::label('county', trans('address.county')) }}
      {{ Form::text('county', $address->county, ['class' => 'form-control', 'required' => 'required']) }}
      {{ Form::label('postcode', trans('address.postcode')) }}
      {{ Form::text('postcode', $address->postcode, ['class' => 'form-control', 'required' => 'required']) }}
      {{ Form::label('country', trans('address.country')) }}
      {{ Form::text('country', $address->country, ['class' => 'form-control', 'required' => 'required']) }}
      {{ Form::submit(trans('crud.edit'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
  </section>
    
@endsection
