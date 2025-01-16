<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHQMAI :: Administrative Panel</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/summernote/summernote.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/dropzone/min/dropzone.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/select2/css/select2.min.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('admin-assets/css/adminlte.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/css/custom.css')}}">

	<link rel="stylesheet" href="{{asset('admin-assets/css/datetimepicker.css')}}">


    <!-- Favicon -->
	<link rel="icon" href="{{ asset('admin-assets/img/favicon.ico') }}" type="image/x-icon">

	<!-- Other head elements -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <div class="navbar-nav pl-2">
                <!-- Breadcrumb -->
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                        <div class="d-flex align-items-center">
                            @if (Auth::guard('admin')->check() && !empty(Auth::guard('admin')->user()->image) && base64_decode(Auth::guard('admin')->user()->image, true) !== false)
                            <?php
                            $imageData = Auth::guard('admin')->user()->image;
                            $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                            ?>
                            <img src="{{ $imageSrc }}" class="img-circle elevation-2 mr-2" alt="{{ Auth::guard('admin')->user()->name }}"  width="40" height="40" style="padding: 3px";>
                            @else
                            <img src="{{ asset('admin-assets/img/avatar5.png') }}" class="img-circle elevation-2 mr-2" width="40" height="40" alt="" style="padding: 3px";>
                            @endif

                            <div>
                                <p class="mb-0">Admin</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                        <h4 class="h4 mb-0"><strong>{{Auth::guard('admin')->user()->name}}</strong></h4>
                        <div class="mb-3">{{Auth::guard('admin')->user()->email}}</div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                            <i class="fas fa-user-cog mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('admin.logout')}}" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

		<!-- /.navbar -->
		<!-- Main Sidebar Container -->

		@include('developer.layouts.sidebar')

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->

			@yield('content')

			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer text-center">
			<p>&copy; <span id="currentYear"></span> <a style="color: #326B6A;" target="_blank" href="https://opus-bd.com/">Opus Technology Limited</a> All rights reserved.</p>
		</footer>

	</div>
	<!-- ./wrapper -->
	<!-- jQuery -->

	<script>
		// Get the current year
		var currentYear = new Date().getFullYear();

		// Update the content of the 'currentYear' span with the current year
		document.getElementById('currentYear').textContent = currentYear;
	</script>
	<script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('admin-assets/js/adminlte.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/summernote/summernote.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/dropzone/min/dropzone.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/select2/js/select2.min.js')}}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{asset('admin-assets/js/demo.js')}}"></script>

	<script src="{{asset('admin-assets/js/datetimepicker.js')}}"></script>

	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).ready(function() {
			$(".summernote").summernote({
				height: 250
			});
		});
	</script>
	@yield('customJs')
</body>

</html>
