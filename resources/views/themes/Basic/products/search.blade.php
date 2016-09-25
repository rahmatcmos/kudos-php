@extends('themes.Basic.layouts.search')

@section('content')
  @if(session('query'))
  <p>{{ trans('search.searchingfor') }} {{ session('query') }}</p>
  @endif
  <ul class="row">
    @foreach ($products as $product)
      <li class="col-md-3">
        <img src="/uploads/{{ $product->defaultImage }}" class="img-respsonive">
        <h2><a href="/products/{{ $product->slug }}">{{ $product[$language]['name']}}</a></h2>
        {!! $product[$language]['content'] !!}
        <a href="/products/{{ $product->slug }}" class="btn btn-primary">View Details</a>
      </li>
    @endforeach
  </ul>
@endsection