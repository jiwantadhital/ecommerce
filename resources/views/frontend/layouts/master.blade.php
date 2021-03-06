<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
  <title> {{$title}}</title>
  <link href="{{asset('assets/frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
  <!--theme-style-->
  <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
  <!--//theme-style-->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <!--fonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
  <!--//fonts-->
  <script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
  <!--script-->
  @yield('css')
</head>
<body>
@yield('content')
@yield('js')
</body>
</html>