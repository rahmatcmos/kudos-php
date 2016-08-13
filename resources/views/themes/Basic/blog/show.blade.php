@extends('themes.Basic.layouts.app')

@section('content')
<h2>{{ $blog[$language]['name'] }}</h2>
{!! $blog[$language]['content'] !!}
@endsection