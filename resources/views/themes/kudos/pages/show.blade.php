@extends('themes.Kudos.layouts.full')

@section('crumbs')
<ul>
  <li><a href="/" title="{{ trans('nav.home') }}">{{ trans('nav.home') }}</a> &raquo;</li>
  <li><a href="/pages/{{ $page->slug }}" title="{{ $page->name }}">{{ $page->name }}</a></li>
</ul> 
@endsection

@section('content')
<h1>{{ $page->name }}</h1>
<div class="content">
  {!! $page->content !!}
</div>
@endsection