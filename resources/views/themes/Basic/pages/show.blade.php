@extends('themes.Basic.layouts.app')

@section('content')
<h1>{{ $page[$language]['name'] }}</h1>
{!! $page[$language]['content'] !!}
@endsection