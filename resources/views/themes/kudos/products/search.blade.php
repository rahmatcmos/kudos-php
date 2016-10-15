@extends('themes.kudos.layouts.app')

@section('content')
  @if(session('query'))
  <p>{{ trans('search.searchingfor') }} {{ session('query') }}</p>
  @endif
  <ul class="row">
    @foreach ($products as $product)
      <li class="col-md-2 text-center">
        <a href="/products/{{ $product->slug }}"><img src="/storage/{{ str_replace('/thumb/', '/medium/', $product->defaultImage) }}" class="img-responsive"></a>
        <h2><a href="/products/{{ $product->slug }}">{{ $product[$language]['name'] }}</a></h2>
        @if(!empty($product->salePrice))
        <p><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->salePrice }}</p>
        @else
        <p><i class="fa fa-{{ strtolower(session('currency')) }}"></i>{{ $product->price }}</p>
        @endif
      </li>
    @endforeach
  </ul>
@endsection