@extends('themes.Basic.layouts.app')

@section('content')
  <h2>{{ $product[$language]['name'] }}</h2>
  {!! $product[$language]['content'] !!}
@endsection