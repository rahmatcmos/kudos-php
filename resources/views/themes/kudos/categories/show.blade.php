@extends('themes.kudos.layouts.app')

@section('content')
<h2>{{ $category[$language]['name'] }} - {{ trans('products.products') }}</h2>
<ul class="row">
  @foreach ($products as $product)
    <li class="col-md-2 text-center">
      <a href="/products/{{ $product->slug }}"><img src="/storage/{{ str_replace('/thumb/', '/medium/', $product->defaultImage) }}" class="img-responsive"></a>
      <h2><a href="/products/{{ $product->slug }}">{{ $product[$language]['name']}}</a></h2>
      @if(!empty($product->salePrice))
      <p>&pound;{{ $product->salePrice}}</p>
      @else
      <p>&pound;{{ $product->price}}</p>
      @endif
    </li>
  @endforeach
</ul>
@endsection