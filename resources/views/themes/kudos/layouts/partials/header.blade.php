<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">
  <title>Kudos Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- css -->
  <link rel="stylesheet" href="/build/themes/kudos/css/all.css">
  
  @yield('head')
  
</head>

<body class="{{ isset($body_class) ? $body_class : '' }}">
  
  <section id="quick-basket">
    quick basket
  </section>
  
  {{ Form::open(['url' => 'products/search', 'method' => 'get', 'id' => 'search']) }}
    <input type="text" name="query"class="form-control" placeholder="Enter Keyword(s)">
  {{ Form::close() }}
  
  <header>
    <form>
      <ul class="list-inline">
        <li>
          <select name="language">
            <option>{{ trans('languages.english') }}</option>
          </select>
        </li>
        <li>
          <select name="currency">
            <option>{{ trans('currencies.gbp') }}</option>
          </select>
        </li>
        <li class="pull-right">
          <a href="/basket">
            Basket ({{ session('basket')['count'] }})
          </a>
        </li>
        <li class="pull-right">
          <a href="#"><i class="fa fa-search"></i></a> &bull;
        </li>
      </ul>
    </form>
    <figure class="text-center">
      <a href="/"><img src="{{ url('/build/themes/kudos/img/logo.jpg') }}" alt="" width="150"></a>
      <figcaption>KUDOS THEME <a href="/pages/info" title="">Theme info</a></figcaption>
    </figure>
  </header>
  
  <nav class="text-center">
    <ul class="list-inline">
      @if(!session('categories'))
        <li><a href="/">{{ trans('shops.back')}}</a></li>
      @else
      @foreach (session('categories') as $category)
        <li><a href="/categories/{{ $category['slug'] }}">{{ $category[session('language')]['name']}}</a></li>
      @endforeach
      @endif
    </ul>
    <form>
      <p>
        Filter by
        <select><option>Size</option></select>
        <select><option>Color</option></select>
        <select><option>Material</option></select>
        <a href="#">clear filters</a>
      </p>
    </form>
  </nav>
  
  <div class="container">
    @if(Session::has('success'))<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>@endif
    @if(Session::has('info'))<div class="alert alert-info" role="alert">{{ Session::get('info') }}</div>@endif
    @if(Session::has('warning'))<div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>@endif
    @if(Session::has('danger'))<div class="alert alert-danger" role="alert">{{ Session::get('danger') }}</div>@endif
  </div>