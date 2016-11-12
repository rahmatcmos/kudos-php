@extends('themes.basic.layouts.account')

@section('content')
  {{ Form::open(['url' => 'account/addresses']) }}
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
    {{ Form::submit(trans('crud.create'), ['class' => 'btn btn-primary']) }}
  {{ Form::close() }}
@endsection
