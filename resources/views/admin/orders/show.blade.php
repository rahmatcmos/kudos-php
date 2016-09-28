@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1><a href="/admin/orders">{{ trans('orders.orders') }}</a> > {{ trans('crud.edit') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          {{ Form::open(['url' => 'admin/orders/' . $order->id]) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit(trans('crud.delete'), ['class' => 'btn btn-danger']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Html::ul($errors->all(), ['class' => 'alert alert-warning']) }}
      <form>
      {{ Form::label('id', trans('orders.ref')) }}
      {{ Form::text('id', $order->id, ['class' => 'form-control', 'required' => 'required']) }}
      {{ Form::label('total', trans('orders.total')) }}
      {{ Form::text('total', $order->total, ['class' => 'form-control', 'required' => 'required']) }}
      {{ Form::label('created_at', trans('orders.created')) }}
      {{ Form::text('created_at', $order->created_at, ['class' => 'form-control', 'required' => 'required']) }}
      </form>
      <div class="white-panel">
        <ul class="row">
          <li class="col-md-2 col-md-offset-7 text-right">
            {{ trans('basket.price') }}
          </li>
          <li class="col-md-3 text-right">
            {{ trans('basket.quantity') }}
          </li>
        </ul>
        <hr>
        @foreach($order->basket['items'] as $id => $item)
        <ul class="row">
          <li class="col-md-7">
            <h2>
              {{ isset($item['product'][$language]['name']) ? $item['product'][$language]['name'] : $item['product']['default']['name'] }}
            </h2>
          </li>
          <li class="col-md-2 text-right">
            &pound;{{ number_format($item['price'],2) }}
          </li>
          <li class="col-md-3 text-right">
            {{ $item['qty'] }}
          </li>
        </ul>
        <hr>
        @endforeach
        <p class="text-right">
          {{ trans('orders.total') }}: &pound;{{ number_format($order->total, 2) }}
        </p>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="white-panel">
            <h2>{{ trans('address.shipping') }}</h2>
            <address>
              {{ $order->basket['shipping']['address1'] }}<br>
              {{ $order->basket['shipping']['address2'] }}<br>
              {{ $order->basket['shipping']['address3'] }}<br>
              {{ $order->basket['shipping']['town'] }}<br>              
              {{ $order->basket['shipping']['county']  }}<br>
              {{ $order->basket['shipping']['postcode'] }}<br>
              {{ $order->basket['shipping']['country'] }}
            </address>
          </div>
        </div>
        <div class="col-md-6">
          <div class="white-panel">
            <h2>{{ trans('address.billing') }}</h2>
            <address>
              {{ $order->basket['billing']['address1'] }}<br>
              {{ $order->basket['billing']['address2'] }}<br>
              {{ $order->basket['billing']['address3'] }}<br>
              {{ $order->basket['billing']['town'] }}<br>              
              {{ $order->basket['billing']['county']  }}<br>
              {{ $order->basket['billing']['postcode'] }}<br>
              {{ $order->basket['billing']['country'] }}
            </address>
          </div>
        </div>
      </div>
        
    
    </div>
  </section>
    
@endsection
