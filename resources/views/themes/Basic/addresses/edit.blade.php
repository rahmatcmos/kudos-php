@extends('themes.basic.layouts.account')

@section('content')
  {{ Html::ul($errors->all()) }}
  {{ Form::model($address, ['url' => 'account/addresses/'.$address->id, 'method' => 'PUT']) }}
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
@endsection
