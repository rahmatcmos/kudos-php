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
        <input type="text" class="form-control" placeholder="Enter Keyword(s)">
      </li>
      <li>
        <a href="/basket">
          Basket <span class="badge">0</span>
        </a>
      </li>
    </ul>    
  </header>
  
  <nav>
    <ul class="container list-inline text-center">
      <li><a href="/products">Products</a></li>
      <li><a href="/pages/terms-and-conditions">T&C's</a></li>
      <li><a href="/blog">Blog</a></li>
      <li><a href="/account">Account</a></li>
    </ul>
  </nav>
