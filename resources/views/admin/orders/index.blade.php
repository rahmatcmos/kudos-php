@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <h1>
        @if($orders->total()>0)
          {{ ($orders->currentPage()-1) * $orders->perPage() + 1 }}
          to
          {{ min($orders->total(), $orders->currentPage() * $orders->perPage()) }}
          of 
          {{ $orders->total() }}
        @endif
        {{ trans('orders.orders') }}
      </h1>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Form::open(['method' => 'get', 'url' => 'admin/orders']) }}
        {{ Form::text('search', '', ['class' => 'form-control', 'placeholder' => trans('search.search').'...']) }}
      {{ Form::close() }}
      @if( $orders->search )
        <p class="clear-search"><a href="/admin/orders" class="btn btn-red">clear search for "{{ $orders->search }}"</a></p>
      @endif
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <a href="/admin/orders?page={{ $orders->currentPage() }}&order_by=id&order_dir={{ session('order.order_dir') == 'asc' ? 'desc' : 'asc' }}&search={{ $orders->search }}" 
                class="order-{{ session('order.order_by') == 'id' ? session('order.order_dir') : '' }}">
                {{ trans('orders.id') }}
              </a>
            </th>
            <th>
              <a href="/admin/orders?page={{ $orders->currentPage() }}&order_by=created_at&order_dir={{ session('order.order_dir') == 'asc' ? 'desc' : 'asc' }}&search={{ $orders->search }}" 
                class="order-{{ session('order.order_by') == 'created_at' ? session('order.order_dir') : '' }}">
                {{ trans('orders.created_at') }}
              </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
          <tr>
            <td><a href="/admin/orders/{{ $order->id }}">{{ $order->id }}</a></td>
            <td><a href="/admin/orders/{{ $order->id }}">{{ $order->created_at }}</a></td>
          </tr> 
          @endforeach
        </tbody>
      </table>
      {{ $orders->appends(['search' => $orders->search, 'order_by' => session('customer.order_by'), 'order_dir' => session('customer.order_dir')] )->links() }}
    </div>
  </section>
    
@endsection
