@extends('themes.basic.layouts.full')

@section('content')
{{ Form::open(['url' => 'checkout', 'class' => 'form-inline']) }}
  <div class="row">
    <div class="col-md-6">
      <h1>{{ trans('checkout.deliveryaddress') }}</h1>
      @if(!$addresses->isEmpty())
      <select class="form-control" name="shipping_id">
        @foreach ($addresses as $address)
        <option value="{{ $address->id }}">
          {{ $address->address1 }},
          {!! !empty($address->address2) ? $address->address2.',' : '' !!}
          {!! !empty($address->address3) ? $address->address3.',' : '' !!}
          {{ $address->town }},
          {{ $address->county }},
          {{ $address->postcode }}
        </option>   
        @endforeach
      </select>
      @endif
      <p><a href="/account/addresses/create" class="btn btn-primary">{{ trans('crud.add') }} {{ trans('address.address') }}</a></p>
      <h1>{{ trans('checkout.billingaddress') }}</h1>
      @if(!$addresses->isEmpty())
      <select class="form-control" name="billing_id">
        @foreach ($addresses as $address)
        <option value="{{ $address->id }}">
          {{ $address->address1 }},
          {!! !empty($address->address2) ? $address->address2.',' : '' !!}
          {!! !empty($address->address3) ? $address->address3.',' : '' !!}
          {{ $address->town }},
          {{ $address->county }},
          {{ $address->postcode }}
        </option>   
        @endforeach
      </select>
      @endif
      <p><a href="/account/addresses/create" class="btn btn-primary">{{ trans('crud.add') }} {{ trans('address.address') }}</a></p>
    </div>
    <div class="col-md-6 payment">
      <h1>{{ trans('checkout.checkout') }}</h1>
      <div class="form-row">
        <label>{{ trans('checkout.cardnumber') }}</label>
        <input type="text" size="20" name="number" value="4242424242424242" class="form-control" readonly>
      </div>
      <div class="form-row">
        <label>{{ trans('checkout.expiration') }} (MM/YY)</label>
        <input type="text" size="2" name="expiryMonth" class="form-control" value="06" readonly> / 
        <input type="text" size="4" name="expiryYear" class="form-control" value="2018" readonly>
      </div>
      <div class="form-row">
        <label>{{ trans('checkout.cvc') }}</label>
        <input type="text" size="4" name="cvc" class="form-control" value="123" readonly>
      </div>
      <input type="submit" class="btn btn-success" value="{{ trans('checkout.checkout') }}">
    </div>
  </div>
{{ Form::close() }}
@endsection