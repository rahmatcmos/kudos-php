  <footer>
    <nav class="container-fluid">
      <ul>
        <li><a href="/pages/kudos-theme-information">{{ trans('nav.about') }}</a></li>
        @if(session('categories'))
          @foreach (session('categories') as $category)
            <li><a href="/categories/{{ $category['slug'] }}">{{ isset($category[session('language')]['name']) ? $category[session('language')]['name'] : $category['default']['name']}}</a></li>
          @endforeach
        @endif
        <li><a href="http://kudos.store/marketing">{{ trans('nav.seo') }}</a></li>
        <li><a href="http://kudos.store/hosting">{{ trans('nav.hosting') }}</a></li>
      </ul>
    </nav>
  </footer>
  
  <!-- js -->
  <script src="/build/themes/kudos/js/all.js"></script>

  @yield('foot')

</body>
</html>