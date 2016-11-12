@extends('themes.basic.layouts.account')

@section('content')
<h1>{{ trans('orders.orders') }}</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th class="hidden-xs">{{ trans('orders.id') }}</th>
      <th>{{ trans('orders.total') }}</th>
      <th>{{ trans('orders.date') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($orders as $order)
    <tr>
      <td class="hidden-xs"><a href="/account/orders/{{ $order->id }}">{{ $order->id }}</a></td>
      <td><a href="/account/orders/{{ $order->id }}">&pound;{{ number_format($order->total,2) }}</a></td>
      <td><a href="/account/orders/{{ $order->id }}">{{ $order->created_at }}</a></td>
    </tr>    
    @endforeach
  </tbody>
</table>
{{ $orders->links() }}
@endsection