@extends('themes.kudos.layouts.app')

@section('content')
<ul class="row">
  @foreach ($products as $product)
    <li class="col-md-3">
      <a href="/products/{{ $product->slug }}"><img src="/storage/{{ str_replace('/thumb/', '/medium/', $product->defaultImage) }}" class="img-responsive"></a>
      <h2><a href="/products/{{ $product->slug }}">{{ $product[$language]['name']}}</a></h2>
      @if(!empty($product->rrp))
      <p>rrp: <strong>&pound;{{ $product->rrp }}</strong></p>
      @endif
      @if(!empty($product->salePrice))
      <p>was: <strong>&pound;{{ $product->price}}</strong></p>
      <p>now: <strong>&pound;{{ $product->salePrice}}</strong></p>
      @else
      <p>price: <strong>&pound;{{ $product->price}}</strong></p>
      @endif
      <a href="/products/{{ $product->slug }}" class="btn btn-primary full">View Details</a>
      <hr>
    </li>
  @endforeach
</ul>
{{ $products->appends(['order_by' => session('product.order_by'), 'order_dir' => session('product.order_dir')] )->links() }}
@endsection