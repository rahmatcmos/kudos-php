<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">
  <title>Basic Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- css -->
  <link rel="stylesheet" href="/build/themes/basic/css/all.css">
  
  @yield('head')
  
</head>

<body class="{{ isset($body_class) ? $body_class : '' }}">
  
  <header class="container">
    <ul class="list-inline">
      <li><a href="/">Basic Theme</a></li>
      <li class="search">
        {{ Form::open(['url' => 'products/search', 'method' => 'get']) }}
          <input type="text" name="query"class="form-control" placeholder="Enter Keyword(s)">
        {{ Form::close() }}
      </li>
      <li>
        <a href="/basket">
          Basket (&pound;{{ number_format(session('basket')['subtotal'], 2) }}) <span class="badge">{{ session('basket')['count'] }}</span>
        </a>
      </li>
    </ul>    
  </header>
  
  <nav>
    <ul class="container list-inline text-center">
      <li><a href="/">Products</a></li>
      <li><a href="/pages/info">Theme Info</a></li>
      <li><a href="/blog">Blog</a></li>
      <li><a href="/account">Account</a></li>
    </ul>
  </nav>
  
  <div class="container">
    @if(Session::has('success'))<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>@endif
    @if(Session::has('info'))<div class="alert alert-info" role="alert">{{ Session::get('info') }}</div>@endif
    @if(Session::has('warning'))<div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>@endif
    @if(Session::has('danger'))<div class="alert alert-danger" role="alert">{{ Session::get('danger') }}</div>@endif
  </div>