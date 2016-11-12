@extends('themes.Kudos.layouts.full')

@section('content')
  <ul class="row">
    @foreach ($blogs as $blog)
      <li class="col-md-6">
        <div class="row">
          <div class="col-md-4">
            <a href="/blog/{{ $blog->slug }}"><img src="/storage/{{ $blog['defaultImage'] }}" class="img-responsive full"></a>
          </div>
          <div class="col-md-8">
            <h2><a href="/blog/{{ $blog->slug }}">{{ $blog[$language]['name'] }}</a></h2>
            <p>{{ $blog[$language]['excerpt'] }}</p>
            <p><a href="/blog/{{ $blog->slug }}">Read More</a></p>
          </div>
        </div>
      </li>
    @endforeach
  </ul>
  {{ $blogs->links() }}
@endsection