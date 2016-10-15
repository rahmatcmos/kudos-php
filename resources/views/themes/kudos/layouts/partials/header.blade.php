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

  <header>
    <form>
      <ul class="list-inline">
        <li>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="langMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <img src="{{asset('build/themes/kudos/img/flags/'.session('language').'.png')}}" width="24" height="24">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="langMenu">
              <li><a href="/languages/en"><img src="{{asset('build/themes/kudos/img/flags/en.png')}}" width="24" height="24"> English</a></li>
              <li><a href="/languages/fr"><img src="{{asset('build/themes/kudos/img/flags/fr.png')}}" width="24" height="24"> Français</a></li>
              <li><a href="/languages/cn"><img src="{{asset('build/themes/kudos/img/flags/cn.png')}}" width="24" height="24"> 中文</a></li>
              <li><a href="/languages/de"><img src="{{asset('build/themes/kudos/img/flags/de.png')}}" width="24" height="24"> Deutsche</a></li>
              <li><a href="/languages/es"><img src="{{asset('build/themes/kudos/img/flags/es.png')}}" width="24" height="24"> Español</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="currencyMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <i class="fa fa-{{ strtolower(session('currency')) }}"></i> - {{ session('currency') }} 
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="currencyMenu">
              <li><a href="/currencies/GBP"><i class="fa fa-gbp"></i> - {{ trans('currencies.gbp') }}</a></li>
              <li><a href="/currencies/EUR"><i class="fa fa-euro"></i> - {{ trans('currencies.eur') }}</a></li> 
              <li><a href="/currencies/CNY"><i class="fa fa-cny"></i> - {{ trans('currencies.cny') }}</a></li> 
              <li><a href="/currencies/USD"><i class="fa fa-usd"></i> - {{ trans('currencies.usd') }}</a></li>
            </ul>
          </div>
        </li>
        <li class="pull-right">
          <a href="/basket">
            Basket ({{ session('basket')['count'] }})
          </a>
        </li>
        <li class="pull-right">
          <a href="{{ url('account') }}">{{ trans('account.account') }}</a> &bull;
        </li>
        <li class="pull-right hidden-md hidden-lg">
          <a href="#"><i class="fa fa-search"></i></a> &bull;
        </li>
      </ul>
    </form>
    <figure class="text-center">
      <a href="/"><img src="{{ url('/build/themes/kudos/img/logo.jpg') }}" alt="" width="178"></a>
      <figcaption>KUDOS THEME <a href="/pages/info" title="">Theme info</a></figcaption>
    </figure>
    {{ Form::open(['url' => 'products/search', 'method' => 'get', 'id' => 'search', 'class' => 'text-center']) }}
      <input type="text" name="query"class="form-control" placeholder="Enter Keyword(s)">
    {{ Form::close() }}
  </header>
  
  <nav class="text-center main">
    <ul class="list-inline">
      @if(!session('categories'))
        <li><a href="/">{{ trans('shops.back')}}</a></li>
      @else
      @foreach (session('categories') as $category)
        <li><a href="/categories/{{ $category['slug'] }}">{{ isset($category[session('language')]['name']) ? $category[session('language')]['name'] : $category['default']['name']}}</a></li>
      @endforeach
      @endif
    </ul>
    <form class="form-inline">
      <p>
        <em>Filter by</em>
        <select class="form-control"><option>Size</option></select>
        <select class="form-control"><option>Color</option></select>
        <select class="form-control"><option>Material</option></select>
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