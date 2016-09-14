@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>
            {{ ($customers->currentPage()-1) * $customers->perPage() + 1 }}
            to
            {{ min($customers->total(), $customers->currentPage() * $customers->perPage()) }}
            of 
            {{ $customers->total() }}
            {{ trans('customers.customers') }}</h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/customers/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Form::open(['method' => 'get', 'url' => 'admin/customers']) }}
        {{ Form::text('search', '', ['class' => 'form-control', 'placeholder' => trans('search.search').'...']) }}
      {{ Form::close() }}
      @if( $customers->search )
        <p class="clear-search"><a href="/admin/customers" class="btn btn-red">clear search for "{{ $customers->search }}"</a></p>
      @endif
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <a href="/admin/customers?page={{ $customers->currentPage() }}&order_by=first_name&order_dir={{ session('customer.order_dir') == 'asc' ? 'desc' : 'asc' }}&search={{ $customers->search }}" 
                class="order-{{ session('customer.order_by') == 'first_name' ? session('customer.order_dir') : '' }}">
                {{ trans('customers.name') }}
              </a>
            </th>
            <th>
              <a href="/admin/customers?page={{ $customers->currentPage() }}&order_by=email&order_dir={{ session('customer.order_dir') == 'asc' ? 'desc' : 'asc' }}&search={{ $customers->search }}" 
                class="order-{{ session('customer.order_by') == 'email' ? session('customer.order_dir') : '' }}">
              {{ trans('customers.email') }}
              </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($customers as $customer)
          <tr>
            <td><a href="/admin/customers/{{ $customer->id }}/edit">{{ $customer->first_name }} {{ $customer->last_name }}</a></td>
            <td><a href="/admin/customers/{{ $customer->id }}/edit">{{ $customer->email }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
      {{ $customers->appends(['search' => $customers->search, 'order_by' => session('customer.order_by'), 'order_dir' => session('customer.order_dir')] )->links() }}
    </div>
  </section>
    
@endsection
