@extends('themes.Basic.layouts.full')

@section('content')
  <h1>Checkout</h1>
  {{ Form::open(['url' => 'checkout', 'class' => 'form-inline']) }}
    <div class="form-row">
      <label>Card Number</label>
      <input type="text" size="20" name="number" value="4242424242424242" class="form-control" readonly>
    </div>
    <div class="form-row">
      <label>Expiration (MM/YY)</label>
      <input type="text" size="2" name="expiryMonth" class="form-control" value="06" readonly> / 
      <input type="text" size="4" name="expiryYear" class="form-control" value="2018" readonly>
    </div>
    <div class="form-row">
      <label>CVC</label>
      <input type="text" size="4" name="cvc" class="form-control" value="123" readonly>
    </div>
    <input type="submit" class="btn btn-primary" value="Pay with Stripe">
  {{ Form::close() }}
@endsection

@section('foot')
@endsection