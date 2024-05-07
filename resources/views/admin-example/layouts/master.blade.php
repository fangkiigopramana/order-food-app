<!DOCTYPE html>
<html lang="en">
<head>
    <title>Warmindo Aroma - Admin Dashboard</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Warmindo Aroma - Admin Dashboard">
    <meta name="author" content="Capstone Siklus 2 Kelompok 10 2024">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('admin/assets/plugins/fontawesome/js/all.min.js') }}"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{ asset('admin/assets/css/portal.css') }}">
</head>

<body>
 
    @include('admin.partials.header')
    
    <div class="app">
        @yield('content')
    </div>

    <footer>
        <!-- Footer konten -->
    </footer>
        <!-- Scripts yang dibutuhkan -->
        <script src="{{ asset('admin/assets/plugins/popper.min.js') }}"></script>
        <script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>  
        <script src="{{ asset('admin/assets/plugins/chart.js/chart.min.js') }}"></script> 
        <script src="{{ asset('admin/assets/js/index-charts.js') }}"></script> 
        <script src="{{ asset('admin/assets/js/app.js') }}"></script>
</body>
</html>
