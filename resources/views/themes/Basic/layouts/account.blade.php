@include('themes.basic.layouts.partials.header') 
  
  <div class="container">
    @if(Session::has('success'))<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>@endif
    @if(Session::has('info'))<div class="alert alert-info" role="alert">{{ Session::get('info') }}</div>@endif
    @if(Session::has('warning'))<div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>@endif
    @if(Session::has('danger'))<div class="alert alert-danger" role="alert">{{ Session::get('danger') }}</div>@endif
    <div class="row">
      <aside class="col-md-3">
        <h2>Navigation</h2>
        <ul>
          <li><a href="/">Your Orders</a></li>
          <li><a href="/">Account Settings</a></li>
          <li><a href="/">Your Addresses</a></li>
        </ul>
      </aside>
      <div class="col-md-9" id="main">
        @yield('content')
      </div>
    </div>
  </div>
  
@include('themes.basic.layouts.partials.footer') 