<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- css -->
  <link rel="stylesheet" href="/build/admin/css/all.css">
    
</head>

<body class="{{ isset($body_class) ? $body_class : '' }}">

  @yield('content')

  <!-- js -->
  <script src="/build/admin/js/all.js"></script>

</body>
</html>