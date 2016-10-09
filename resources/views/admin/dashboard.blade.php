@extends('admin.layouts.app')

@section('content')
  <div class="title row">
    <div class="col-md-12">
      <h1>{{ trans('dashboard.dashboard') }}</h1>
    </div>
  </div>
  
  <section class="container-fluid">
    
    <h2>{{ trans('shops.shop') }} {{ trans('dashboard.stats') }}</h2>
    <ul>
      <li>{{ trans('dashboard.numberof') }} {{ trans('categories.categories') }}: {{ $stats['categories'] }}</li>
      <li>{{ trans('dashboard.numberof') }} {{ trans('products.products') }}:  {{ $stats['products'] }}</li>
      <li>{{ trans('dashboard.numberof') }} {{ trans('customers.customers') }}:  {{ $stats['customers'] }}</li>
      <li>{{ trans('dashboard.numberof') }} {{ trans('pages.pages') }}:  {{ $stats['pages'] }}</li>
      <li>{{ trans('dashboard.numberof') }} {{ trans('blog.blog') }} {{ trans('blog.articles') }}:  {{ $stats['blogs'] }}</li>
      <li>{{ trans('dashboard.numberof') }} {{ trans('orders.orders') }}:  {{ $stats['orders'] }}</li>
      <li>{{ trans('orders.revenuegenerated') }}:  &pound;{{ number_format($stats['revenue'],2) }}</li>
    </ul>
    
  </section>
    
@endsection




