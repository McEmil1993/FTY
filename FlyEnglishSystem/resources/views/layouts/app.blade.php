<!DOCTYPE html>
<html lang="en">
<head>
    @include ('components.header')
    @include ('components.script')
</head>
<body class="hold-transition layout-navbar-fixed sidebar-mini layout-fixed">
    <div class="wrapper">
        @include ('components.top')
        @include ('components.side')

        @yield('content')

        @include ('components.footer')
    </div>
   
</body>
</html>
