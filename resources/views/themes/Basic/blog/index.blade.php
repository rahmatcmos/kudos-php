@extends('themes.Basic.layouts.app')

@section('content')
    @foreach ($blogs as $blog)
      <h2><a href="/blog/{{ $blog->slug }}">{{ $blog[$language]['name']}}</a></h2>
    @endforeach
@endsection