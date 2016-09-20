@extends('themes.Basic.layouts.app')

@section('content')
<h2>{{ $category[$language]['name'] }} - {{ trans('products.products') }}</h2>
<ul>
@foreach ($products as $product)
  <li><a href="/products/{{ $product->slug }}">{{ $product[$language]['name']}}</a></h2>
@endforeach
</ul>
@endsection