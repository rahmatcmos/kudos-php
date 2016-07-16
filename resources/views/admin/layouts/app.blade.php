<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- css -->
  <link rel="stylesheet" href="/build/admin/css/all.css">
 
</head>

<body class="{{ isset($body_class) ? $body_class : '' }}">
  
  <header>
    <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
    <ol>
      <li>
      @if( !isset($shop_remove) )
        <select class="form-control" id="select-shops">
          @foreach ($select_shops as $shop)
          <option value="{{ $shop->id }}" {{ session('shop')==$shop->id ? 'selected="selected"' : '' }}>{{ isset($shop->$language['name']) ? $shop->$language['name'] : $shop->default['name'] }}</option>   
          @endforeach
        </select>
      @endif
      </li>
    </ol>
    <ul>
      <li>
        <select class="form-control" id="select-language">
          @foreach ($languages as $id => $language)
          <option value="{{ $id }}" {{ session('language')==$id ?'selected=selected':'' }}>{{ $language }}{{ config('app.locale')==$id ?' (Default)':''}}</option>   
          @endforeach
        </select>
      </li>
      <li><a href="/admin/users"><i class="fa fa-user"></i></a></li>
      <li><a href="/logout"><i class="fa fa-sign-out"></i></a></li>
    </ul>
  </header>
  
  <div id="wrapper" class="{{ session('toggled')=='true' ? 'toggled' : '' }}">
  
    <aside>
      <nav>
        <ul>
          <li><a href="/admin"><i class="fa fa-dashboard"></i> {{ trans('dashboard.dashboard') }}</a></li>
          <li><a href="/admin/shops"><i class="fa fa-bank"></i> {{ trans('shops.shops') }}</a></li>
          <li><a href="/admin/categories"><i class="fa fa-sitemap"></i> {{ trans('categories.categories') }}</a></li>
          <li><a href="/admin/products"><i class="fa fa-list"></i> {{ trans('products.products') }}</a></li>
          <li><a href="/admin/customers"><i class="fa fa-users"></i> {{ trans('customers.customers') }}</a></li>
          <li><a href="/admin/orders"><i class="fa fa-shopping-cart"></i> {{ trans('orders.orders') }}</a></li>
          <li><a href="/admin/pages"><i class="fa fa-file-o"></i> {{ trans('pages.pages') }}</a></li>
          <li><a href="/admin/blog"><i class="fa fa-comments"></i> {{ trans('blog.blog') }}</a></li>
        </ul>
      </nav>
    </aside>
  
    <div id="content">
      @if(Session::has('success'))<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>@endif
      @if(Session::has('info'))<div class="alert alert-info" role="alert">{{ Session::get('info') }}</div>@endif
      @if(Session::has('warning'))<div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>@endif
      @if(Session::has('danger'))<div class="alert alert-danger" role="alert">{{ Session::get('danger') }}</div>@endif
      @yield('content')
    </div>
  
  </div>
  
  <!-- js -->
  <script src="/build/admin/js/all.js"></script>
  
  @yield('foot')

</body>
</html>