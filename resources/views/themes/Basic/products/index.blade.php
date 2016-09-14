@extends('themes.Basic.layouts.app')

@section('content')
    @foreach ($products as $product)
      <h2><a href="/products/{{ $product->slug }}">{{ $product[$language]['name']}}</a></h2>
      {!! $product[$language]['content'] !!}
      <hr>
    @endforeach
@endsection