<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.partials.head')
</head>
<body class='d-flex justify-content-center align-items-center bg-body-tertiary' style='height: 100vh;'>

    @yield('content')

    @include('layout.partials.footer-scripts')
    @yield('custom-scripts')
</body>
</html>

