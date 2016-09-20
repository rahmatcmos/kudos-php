@include('themes.basic.layouts.partials.header') 
  
  <div class="container">
    <div class="row">
      <aside class="col-md-3">
        <h2>{{ trans('account.navigation') }}</h2>
        <ul>
          <li><a href="/account">{{ trans('orders.orders') }}</a></li>
          <li><a href="/account/settings">{{ trans('settings.settings') }}</a></li>
          <li><a href="/account/addresses">{{ trans('address.addresses') }}</a></li>
          <li><a href="/logout">{{ trans('auth.logout') }}</a></li>
        </ul>
      </aside>
      <div class="col-md-9" id="main">
        @yield('content')
      </div>
    </div>
  </div>
  
@include('themes.basic.layouts.partials.footer') 