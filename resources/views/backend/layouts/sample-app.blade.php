<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 admin template and web Application ui kit.">
    <title>:: My-Task::</title>
    <link rel="icon" href="{{ asset('/favicon.ico')}}" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel2/dist/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/my-task.style.min.css') }}">
</head>
<body>

<div id="mytask-layout" class="theme-indigo">
    <!-- main body area -->
    <div class="main px-lg-4 px-md-4 bg-dark-defualt">

        <!-- Body: Header -->
        @include('backend.includes.sample-header')

        <!-- Body: Body -->
        @yield('content')
       
    </div>
</div>
<script src="{{ asset('assets/plugins/owl.carousel2/dist/owl.carousel.min.js') }}"></script>
</body>
</html>