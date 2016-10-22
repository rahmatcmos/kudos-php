@include('themes.kudos.layouts.partials.header') 
  
  <div class="container" id="main">
    <div id="crumbs" class="hidden-xs hidden-sm">
      @yield('crumbs')
    </div>
    @yield('content')
  </div>
  
@include('themes.kudos.layouts.partials.footer') 