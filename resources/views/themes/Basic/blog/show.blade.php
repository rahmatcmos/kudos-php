@extends('themes.Basic.layouts.full')

@section('content')
<h2>{{ $blog[$language]['name'] }}</h2>
<img src="/uploads/{{ $blog['defaultImage'] }}" class="img-responsive pull-left half">
{!! $blog[$language]['content'] !!}
@endsection