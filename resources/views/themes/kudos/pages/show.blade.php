@extends('themes.kudos.layouts.full')

@section('content')
<h1>{{ $page[$language]['name'] }}</h1>
<div class="content">
  {!! $page[$language]['content'] !!}
</div>
@endsection