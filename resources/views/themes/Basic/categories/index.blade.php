@extends('themes.Basic.layouts.app')

@section('content')
    @foreach ($categories as $category)
      <h2><a href="/categories/{{ $category->slug }}">{{ $category[$language]['name']}}</a></h2>
      {!! $category[$language]['content'] !!}
      <hr>
    @endforeach
@endsection