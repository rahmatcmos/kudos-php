@extends('themes.Basic.layouts.app')

@section('content')
  <h1>Welcome to the Kudos Shop Basic theme demo.</h1>
  <div class="content">
    <p><a href="http://kudos.shop" target="_blank">Kudos Shop</a> provides the most simple platform possible for building online shops. It is blazingly fast and requires minimal server requirements.</p>
    <p>This is the most basic and simple theme for Kudos Shop. It uses <strong>no javascript</strong> and is intended for simple shops or as a starting point to build and design your own theme.</p>
    
    <p><a href="/admin" class="btn btn-success">Login to the Admin Panel</a></p>
    
    <h2>Features:</h2>
    <ul>
      <li>Search</li>
      <li>Full account features (orders/address/details management)</li>
      <li>CMS Pages and News content</li>
      <li>Category filter</li>
      <li>Basket</li>
      <li>Checkout</li>
    </ul>
    <h3>For Developers</h3>
    <p>This theme uses <a href="http://getbootstrap.com" target="_blank">Bootstrap</a> and <a href="http://sass-lang.com" target="_blank">Sass</a>.</p>
    <p>This is the PHP Demo using <a href="https://laravel.com" target="_blank">Laravel</a>, there is a gulpfile in /themes/basic for compiling Sass and Javascript, this uses <a href="https://laravel.com/docs/5.2/elixir" target="_blank">Laravel elixir</a> to define basic Gulp tasks. Simply navigate to /themes/basic and enter "gulp watch".</p>
    <p>Controllers are found in <strong>/app/Http/Controllers/Themes/Basic</strong>, assets are found in <strong>/resources/assets/themes/basic</strong> and views are found in <strong>/resources/views/themes/basic</strong></p>
    <p>Thats it. If you know Laravel, you know Kudos Shop.</p>
  </div>
@endsection