<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Ease - {{$title}}</title>
    {{-- @vite(['resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{asset('css/app.min.css')}}">
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- flashbag-->
        @include('components.flashbag')

        <!-- Sidebar -->
        @include('layouts.admin.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('layouts.admin.topbar')

                <!-- Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    @isset($header)
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">{{ $header }}</h1>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        </div>
                    @endisset
                    {{$slot}}
                </div>
            </div>

            <!-- Footer -->
            @include('layouts.admin.footer')

        </div>
        <!-- And Content Wrapper -->
    </div>

    <!-- Scroll to Top Button-->
    @include('components.scrollTopButton')

    <!-- Logout Modal-->
    @include('components.logoutModal')

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/main1.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>