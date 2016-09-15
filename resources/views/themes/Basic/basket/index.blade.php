@extends('themes.Basic.layouts.app')

@section('content')
  <h1>Basket</h1>
  <hr>
  @if(empty(session('basket')))
    {{ trans('basket.empty') }}
  @endif
  @foreach(session('basket') as $id => $item)
  <ul class="row">
    <li class="col-md-8">
      <h2>
        <a href="/products/{{ $item['product']['slug'] }}">
          {{ isset($item['product'][$language]['name']) ? $item['product'][$language]['name'] : $item['product']['default']['name'] }}
        </a>
      </h2>
      {{ Form::open(['method' => 'DELETE', 'url' => 'basket/'.$id]) }}
        {{ Form::hidden('id',  $id) }}
        {{ Form::submit('delete', ['class' => 'btn btn-link']) }}
      {{ Form::close() }}
    </li>
    <li class="col-md-2 text-right">
      &pound;{{ number_format($item['price'],2) }}
    </li>
    <li class="col-md-2 text-right">
      x{{ $item['qty'] }}
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