@props(['title'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Ease - {{$title}}</title>
    @vite(['resources/js/app.js'])
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Start Page Wrapper -->
    <div id="wrapper">

        <!-- Start flashbag-->
        @include('layouts.flashbag')
        <!-- End flashbag-->

        <!-- Start Sidebar -->
        @include('layouts.sidebar')
        <!-- End Sidebar -->

        <!-- Start Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Start Main Content -->
            <div id="content">

                <!-- Start Topbar -->
                @include('layouts.topbar')
                <!-- End Topbar -->

                <!-- Start Page Content -->
                <div class="container-fluid">
                    {{$slot}}
                </div>
                <!-- End Page Content -->

            </div>
            <!-- End Main Content -->

            <!-- Start Footer -->
            @include('layouts.footer')
            <!-- End Footer -->

        </div>
        <!-- And Content Wrapper -->
    </div>
    <!-- End Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/main1.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>