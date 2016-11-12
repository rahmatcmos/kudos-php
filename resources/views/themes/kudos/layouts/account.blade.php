@include('themes.Kudos.layouts.partials.header') 
  
  <div class="container">
    <div class="row">
      <aside class="col-md-3 account">
        <h2>{{ trans('account.navigation') }}</h2>
        <ul>
          <li><a href="/account">{{ trans('orders.orders') }}</a></li>
          <li><a href="/account/settings">{{ trans('settings.settings') }}</a></li>
          <li><a href="/account/addresses">{{ trans('address.addresses') }}</a></li>
          <li class="logout">
            <form id="logout-form" action="{{ url('/logout') }}" method="POST">
              {{ csrf_field() }}
              <button class="btn btn-link">{{ trans('auth.logout') }}</button>
            </form>
          </li>
        </ul>
      </aside>
      <div class="col-md-9" id="main">
        @yield('content')
      </div>
    </div>
  </div>
  
@include('themes.Kudos.layouts.partials.footer') 