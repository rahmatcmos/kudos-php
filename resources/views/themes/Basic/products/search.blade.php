@extends('themes.Basic.layouts.search')

@section('content')
  @if(session('query'))
  <p>{{ trans('search.searchingfor') }} {{ session('query') }}</p>
  @endif
  <ul class="row">
    @foreach ($products as $product)
      <li class="col-md-3">
        <a href="/products/{{ $product->slug }}"><img src="/uploads/{{ str_replace('/thumb/', '/medium/', $product->defaultImage) }}" class="img-responsive"></a>
        <h2><a href="/products/{{ $product->slug }}">{{ $product[$language]['name']}}</a></h2>
        <p>Price: &pound;{!! isset($product->salePrice) ? '<strike>'.$product->price.'</strike> &pound;'.$product->salePrice : $product->price !!}</p>
        <a href="/products/{{ $product->slug }}" class="btn btn-primary">View Details</a>
        <hr>
      </li>
    @endforeach
  </ul>
{{ $products->appends(['order_by' => session('product.order_by'), 'order_dir' => session('product.order_dir')] )->links() }}
@endsection