<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 admin template and web Application ui kit.">
    <title>:: My-Task::</title>
    <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/nestable/jquery-nestable.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/prism/prism.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/my-task.style.min.css') }}">

    <!-- jQuery -->
<script src="{{ asset('assets/jquery.min.js') }}"></script>


</head>

<body>

    <div id="mytask-layout" class="theme-indigo">
        <!-- sidebar -->
        @include('backend.includes.sidebar')

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            @include('backend.includes.header')

            <!-- Body: Body -->
            @yield('content')

        </div>
    </div>
</body>

<script src="{{ asset('assets/plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('assets/plugins/prism/prism.js') }}"></script>
@stack('before-scripts')

<script>
    $(document).ready(function() {
        $('.sidebar-mini-btn').click(function() {
            $(this).toggleClass('sidebar-mini');
        });

        var toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
        $(toggleSwitch).on('change', function() {
            if (toggleSwitch.checked == true) {
                $('body').attr('data-theme', 'dark');
            } else {
                $('body').attr('data-theme', 'light');
            }
        });

        var togglertlSwitch = document.querySelector('.theme-rtl input[type="checkbox"]');
        $(togglertlSwitch).on('change', function() {
            if (togglertlSwitch.checked == true) {
                $('body').addClass('rtl_mode');
            } else {
                $('body').removeClass('rtl_mode');
            }
        });
        /*var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/6051a040f7ce18270930e55a/1f0vdjvfu';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();*/
        // cSidebar overflow daynamic height

        overFlowDynamic();

        $(window).resize(function() {
            overFlowDynamic();
        });

        function overFlowDynamic() {
            var sideheight = $(".sidebar.sidebar-mini").height() + 48;

            if (sideheight <= 760) {
                $(".sidebar.sidebar-mini").css("overflow", "scroll");
            } else {
                $(".sidebar.sidebar-mini").css("overflow", "visible");
            }
        }
    });
</script>






<script src="{{ asset('assets/sweetalert2@11.js') }}"></script>
@stack('after-scripts')

</html>
