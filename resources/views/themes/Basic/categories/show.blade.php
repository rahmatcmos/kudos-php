@extends('themes.Basic.layouts.app')

@section('content')
<h2>{{ $category[$language]['name'] }} - {{ trans('products.products') }}</h2>
<ul class="row">
  @foreach ($products as $product)
    <li class="col-md-3">
      <img src="/uploads/{{ str_replace('/thumb/', '/medium/', $product->defaultImage) }}" class="img-responsive">
      <h2><a href="/products/{{ $product->slug }}">{{ $product[$language]['name']}}</a></h2>
      {!! $product[$language]['content'] !!}
      <a href="/products/{{ $product->slug }}" class="btn btn-primary">View Details</a>
    </li>
  @endforeach
</ul>
{{ $products->appends(['order_by' => session('product.order_by'), 'order_dir' => session('product.order_dir')] )->links() }}
@endsection