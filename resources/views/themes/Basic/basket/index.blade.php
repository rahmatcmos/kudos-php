@extends('themes.Basic.layouts.full')

@section('content')
  <h1>{{ trans('basket.basket') }}</h1>
  @if(empty(session('basket')['items']))
    <p>{{ trans('basket.empty') }}</p>
  @else
    <ul class="row">
      <li class="col-md-2 col-md-offset-7 text-right">
        {{ trans('basket.price') }}
      </li>
      <li class="col-md-3 text-right">
        {{ trans('basket.quantity') }}
      </li>
    </ul>
    <hr>
    @foreach(session('basket')['items'] as $id => $item)
    <ul class="row">
      <li class="col-md-2 text-right">
        <a href="/products/{{ $item['product']['slug'] }}">
          <img src="/storage/{{ str_replace('/large/', '/thumb/', $item['product']['defaultImage']) }}" class="img-responsive">
        </a>
      </li>
      <li class="col-md-5">
        <h2>
          <a href="/products/{{ $item['product']['slug'] }}">
            {{ isset($item['product'][$language]['name']) ? $item['product'][$language]['name'] : $item['product']['default']['name'] }}
          </a>
        </h2>
        {{ Form::open(['method' => 'DELETE', 'url' => 'basket/'.$id]) }}
          {{ Form::submit('delete', ['class' => 'btn btn-link orange']) }}
        {{ Form::close() }}
      </li>
      <li class="col-md-2 text-right">
        &pound;{{ number_format($item['price'],2) }}
      </li>
      <li class="col-md-3 text-right">
        {{ Form::open(['method' => 'PUT', 'url' => 'basket/'.$id]) }}
          {{ Form::select('qty', $qtyRange, $item['qty']) }}
          {{ Form::submit('update', ['class' => 'btn btn-link green']) }}
        {{ Form::close() }}
      </li>
    </ul>
    <hr>
    @endforeach
    @if(!empty(session('basket')))
    <p class="text-right subtotal">
      {{ trans('orders.subtotal') }}: <strong>&pound;{{ number_format($subtotal, 2) }}</strong>
    </p>
    <p class="text-right">
      <a href="/checkout" class="btn btn-success btn-checkout">
        {{ trans('checkout.checkout') }}
      </a>
    </p>
    @endif
  @endif
@endsection