<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- css -->
  <link rel="stylesheet" href="/build/themes/basic/css/all.css">
  
  @yield('head')
 
</head>

<body class="{{ isset($body_class) ? $body_class : '' }}">
  
  @if(Session::has('success'))<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>@endif
  @if(Session::has('info'))<div class="alert alert-info" role="alert">{{ Session::get('info') }}</div>@endif
  @if(Session::has('warning'))<div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>@endif
  @if(Session::has('danger'))<div class="alert alert-danger" role="alert">{{ Session::get('danger') }}</div>@endif
  @yield('content')

  <!-- js -->
  <script src="/build/themes/basic/js/all.js"></script>
  
  @yield('foot')

</body>
</html>