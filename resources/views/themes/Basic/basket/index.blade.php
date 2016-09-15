@extends('themes.Basic.layouts.app')

@section('content')
  <h1>Basket</h1>
  @if(empty(session('basket')))
    <p>{{ trans('basket.empty') }}</p>
  @endif
  <ul class="row">
    <li class="col-md-2 col-md-offset-7 text-right">
      {{ trans('basket.price') }}
    </li>
    <li class="col-md-3 text-right">
      {{ trans('basket.quantity') }}
    </li>
  </ul>
  <hr>
  @foreach(session('basket') as $id => $item)
  <ul class="row">
    <li class="col-md-7">
      <h2>
        <a href="/products/{{ $item['product']['slug'] }}">
          {{ isset($item['product'][$language]['name']) ? $item['product'][$language]['name'] : $item['product']['default']['name'] }}
        </a>
      </h2>
      {{ Form::open(['method' => 'DELETE', 'url' => 'basket/'.$id]) }}
        {{ Form::submit('delete', ['class' => 'btn btn-link']) }}
      {{ Form::close() }}
    </li>
    <li class="col-md-2 text-right">
      &pound;{{ number_format($item['price'],2) }}
    </li>
    <li class="col-md-3 text-right">
      {{ Form::open(['method' => 'PUT', 'url' => 'basket/'.$id]) }}
        {{ Form::select('qty', $qtyRange, $item['qty']) }}
        {{ Form::submit('update', ['class' => 'btn btn-link']) }}
      {{ Form::close() }}
    </li>
  </ul>
  <hr>
  @endforeach
  @if(!empty(session('basket')))
  <p class="text-right">
    Subtotal: &pound;{{ number_format($subtotal, 2) }}
  </p>
  <p class="text-right">
    <a href="/checkout" class="btn btn-success">
      trans('checkout.checkout')
    </a>
  </p>
  @endif
@endsection