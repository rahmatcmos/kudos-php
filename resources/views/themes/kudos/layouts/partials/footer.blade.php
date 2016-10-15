  <footer>
    <nav class="container-fluid">
      <ul class="list-inline">
        <li><a href="/pages/info">{{ trans('nav.about') }}</a></li>
        @if(!session('categories'))
          <li><a href="/">{{ trans('shops.back')}}</a></li>
        @else
          @foreach (session('categories') as $category)
            <li><a href="/categories/{{ $category['slug'] }}">{{ isset($category[session('language')]['name']) ? $category[session('language')]['name'] : $category['default']['name']}}</a></li>
          @endforeach
        @endif
        <li><a href="/pages/about">{{ trans('nav.seo') }}</a></li>
        <li><a href="/pages/about">{{ trans('nav.hosting') }}</a></li>
      </ul>
    </nav>
  </footer>
  
  <!-- js -->
  <script src="/build/themes/kudos/js/all.js"></script>

  @yield('foot')

</body>
</html>