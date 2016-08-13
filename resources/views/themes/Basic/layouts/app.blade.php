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
        <span class="fa-stack fa-lg">
          <i class="fa fa-square fa-stack-2x"></i>
          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
        </span>
      </li>
      <li>
        <a href="/account">
          My Account 
          <span class="fa-stack fa-lg">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fa fa-user fa-stack-1x fa-inverse"></i>
          </span>
        </a>
      </li>
      <li>
        <a href="/basket">
          My Basket <span class="badge">42</span>
          <span class="fa-stack fa-lg">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fa fa-shopping-basket fa-stack-1x fa-inverse"></i>
          </span>
        </a>
      </li>
    </ul>    
  </header>
  
  <nav>
    <ul class="container list-inline text-center">
      <li><a href="/categories">Categories</a></li>
      <li><a href="/pages/about-us">About Us</a></li>
      <li><a href="/pages/terms-and-conditions">T&C's</a></li>
      <li><a href="/blog">Blog</a></li>
      <li><a href="/pages/contact-us">Contact Us</a></li>
    </ul>
  </nav>
  
  <!--<div id="ctas">
    <div class="container">
      <ul class="row text-center">
        <li class="col-md-4"><i class="fa fa-truck"></i> Free UK delivery*</li>
        <li class="col-md-4"><i class="fa fa-lock"></i> 100% Secure Payment <i class="fa fa-credit-card-alt"></i> <i class="fa fa-cc-paypal"></i> <i class="fa fa-cc-stripe"></i></li>
        <li class="col-md-4"><i class="fa fa-thumbs-up"></i> Free returns within 30 days</li>
      </ul>
    </div>
  </div>-->
  
  <div class="container">
    @if(Session::has('success'))<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>@endif
    @if(Session::has('info'))<div class="alert alert-info" role="alert">{{ Session::get('info') }}</div>@endif
    @if(Session::has('warning'))<div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>@endif
    @if(Session::has('danger'))<div class="alert alert-danger" role="alert">{{ Session::get('danger') }}</div>@endif
    <div class="row">
      <aside class="col-md-3">
        <h2>Navigation</h2>
        <ul>
          @foreach ($categories as $category)
            <li><a href="/categories/{{ $category->slug }}">{{ $category[$language]['name']}}</a></li>
          @endforeach
        </ul>
      </aside>
      <div class="col-md-9" id="main">
        @yield('content')
      </div>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <div class="row">
        <dl class="col-md-4">
          <dt>Basic theme</dt>
          <dd>This is the most basic and simple theme for <a href="http://kudos.shop" target="_blank">Kudos Shop</a>. It uses no javascript and is intended for simple shops.</dd>
          <dd>For a more feature rich example check out the <a href="http://kudos.kudos.shop">kudos theme demo</a>.</dd>
        </dl>
        <dl class="col-md-4">
          <dt>NAVIGATION</dt>
          <dd><a href="/categories">Categories</a></dd>
          <dd><a href="/pages/about-us">About Us</a></dd>
          <dd><a href="/pages/terms-and-conditions">T&Cs</a></dd>
          <dd><a href="/blog">Blog</a></dd>
          <dd><a href="/pages/contact-us">Contact Us</a></dd>
        </dl>
        <dl class="col-md-4">
          <dt>MORE ABOUT KUDOS</dt>
          <dd>We are an <a href="http://kudos.agency">agency</a> 100% focussed on ecommerce and selling online.</dd>
          <dd>
            <ul>
              <li>
                Docs: <a href="http://kudos.shop">Kudos Shop</a>
              </li>
              <li>
                Need Hosting? <a href="http://stack.kudos.shop">Kudos Stack</a>
              </li>
              <li>
                Need more sales? <a href="http://spike.kudos.shop">Kudos Spike</a>
              </li>
            </ul>
          </dd>
        </dl>
      </div>
    </div>
  </footer>

  @yield('foot')

</body>
</html>