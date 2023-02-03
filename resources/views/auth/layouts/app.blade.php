<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Captive Portal By Thamrin</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	

        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{asset('admin/css/sb-admin-2.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/ionicons.min.css')}}">



</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        @yield('content')

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
     
    <!-- Core plugin JavaScript-->
    <script src="{{asset('adminvendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

</body>

</html>