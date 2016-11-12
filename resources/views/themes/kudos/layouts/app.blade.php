@include('themes.Kudos.layouts.partials.header') 
  
  <div class="container-fluid" id="main">
    <div id="crumbs" class="hidden-xs hidden-sm">
      @yield('crumbs')
    </div>
    @yield('content')
  </div>
  
@include('themes.Kudos.layouts.partials.footer') 