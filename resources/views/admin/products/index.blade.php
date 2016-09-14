@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h1>
            {{ ($products->currentPage()-1) * $products->perPage() + 1 }}
            to
            {{ min($products->total(), $products->currentPage() * $products->perPage()) }}
            of 
            {{ $products->total() }}
            {{ trans('products.products') }}
          </h1>
        </div>
        <div class="col-md-3 text-right">
          <a href="/admin/products/create" class="btn btn-success">{{ trans('crud.create') }}</a>
        </div>
      </div>
    </div>
  </div>
  
  <section>
    <div class="container-fluid">
      {{ Form::open(['method' => 'get', 'url' => 'admin/products']) }}
        {{ Form::text('search', '', ['class' => 'form-control', 'placeholder' => trans('search.search').'...']) }}
      {{ Form::close() }}
      @if( $products->search )
        <p class="clear-search"><a href="/admin/products" class="btn btn-red">clear search for "{{ $products->search }}"</a></p>
      @endif
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <a href="/admin/products?page={{ $products->currentPage() }}&order_by=name&order_dir={{ session('product.order_dir') == 'asc' ? 'desc' : 'asc' }}&search={{ $products->search }}" 
                class="order-{{ session('product.order_by') == 'name' ? session('product.order_dir') : '' }}">
                {{ trans('products.name') }}
              </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr>
            <td><a href="/admin/products/{{ $product->id }}/edit">{{ isset($product->$language['name']) ? $product->$language['name'] : $product->default['name'] }}</a></td>
          </tr>    
          @endforeach
        </tbody>
      </table>
      {{ $products->appends(['search' => $products->search, 'order_by' => session('product.order_by'), 'order_dir' => session('product.order_dir')] )->links() }}
    </div>
  </section>
    
@endsection
