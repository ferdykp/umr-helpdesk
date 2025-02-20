<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    @stack('head')
</head>
<body class="g-sidenav-show bg-gray-100">
    {{-- <div class="min-height-300 position-absolute w-100"
        style="background-image: url('/assets/img/mining3.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 0.8;">
    </div> --}}
    @include('layouts.aside')
    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')
    @include('layouts.script')
    @include('components.toast')
</body>
</html>