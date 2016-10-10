@include('themes.kudos.layouts.partials.header') 
  
  <div class="container">
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
  
@include('themes.kudos.layouts.partials.footer') 