@extends('themes.basic.layouts.account')

@section('content')
  <h1>{{ trans('orders.order') }}: {{ $order->id }}</h1>
  <ul class="row">
    <li class="col-xs-2 col-xs-offset-7 text-right">
      {{ trans('basket.price') }}
    </li>
    <li class="col-xs-3 text-right">
      {{ trans('basket.quantity') }}
    </li>
  </ul>
  <hr>
  @foreach($order->basket['items'] as $id => $item)
  <ul class="row">
    <li class="col-xs-7">
      <h2>
        {{ isset($item['product'][session('language')]['name']) ? $item['product'][session('language')]['name'] : $item['product']['default']['name'] }}
      </h2>
    </li>
    <li class="col-xs-2 text-right">
      &pound;{{ number_format($item['price'],2) }}
    </li>
    <li class="col-xs-3 text-right">
      {{ $item['qty'] }}
    </li>
  </ul>
  <hr>
  @endforeach
  <p class="text-right">
    {{ trans('orders.total') }}: &pound;{{ number_format($order->total, 2) }}
  </p>
@endsection