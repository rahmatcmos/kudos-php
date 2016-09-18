@include('themes.basic.layouts.partials.header') 
  
  <div class="container">
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