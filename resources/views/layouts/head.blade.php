@push('head')

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
{{-- <title>{{$title}}</title> --}}
<title>D-Bridge</title>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/logo-mining-bg.jpg') }}">
<link rel="icon" type="image/png" href="{{ asset('assets/img/logo-mining-bg.jpg') }}">
    
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    
<!-- Icons -->
<link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Core CSS -->
<link id="pagestyle" href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
<link id="pagestyle" href="{{ asset('assets/css/tailwind.css') }}" rel="stylesheet">
<link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">

<!-- Vendors CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Helpers -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush