<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    @stack('head')
    <style>
        .custom-dropdown-box {
            background-color: #8e121f;
            /* opacity: 0.9; */
            border-radius: 20px;
            padding: 10px;
            z-index: 1;
            /* Optional: To add some space inside the box */
        }
    </style>
</head>

<body>
    @yield('content')

    @include('layouts.footer')
    @include('layouts.script')
    @include('components.toast')
</body>

</html>
