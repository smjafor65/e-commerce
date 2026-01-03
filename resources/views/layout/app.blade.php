<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">


<!-- Mirrored from dreamspos.dreamstechnologies.com/html/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Dec 2025 03:05:11 GMT -->
<head>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Dreams POS is a powerful Bootstrap based Inventory Management Admin Template designed for businesses, offering seamless invoicing, project tracking, and estimates.">
	<meta name="keywords" content="inventory management, admin dashboard, bootstrap template, invoicing, estimates, business management, responsive admin, POS system">
	<meta name="author" content="Dreams Technologies">
	<meta name="robots" content="index, follow">
	<title>Dreams POS - Inventory Management & Admin Dashboard Template</title>

	<script src="{{asset("assets")}}/js/theme-script.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset("assets")}}/img/favicon.png">

	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset("assets")}}/img/apple-touch-icon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset("assets")}}/css/bootstrap.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{asset("assets")}}/css/bootstrap-datetimepicker.min.css">

	<!-- animation CSS -->
	<link rel="stylesheet" href="{{asset("assets")}}/css/animate.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset("assets")}}/plugins/select2/css/select2.min.css">

	<!-- Daterangepikcer CSS -->
	<link rel="stylesheet" href="{{asset("assets")}}/plugins/daterangepicker/daterangepicker.css">

	<!-- Tabler Icon CSS -->
	<link rel="stylesheet" href="{{asset("assets")}}/plugins/tabler-icons/tabler-icons.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{asset("assets")}}/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="{{asset("assets")}}/plugins/fontawesome/css/all.min.css">

	<!-- Color Picker Css -->
	<link rel="stylesheet" href="{{asset("assets")}}/plugins/%40simonwep/pickr/themes/nano.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{asset("assets")}}/css/style.css">

</head>

<body>
	{{-- <div id="global-loader">
		<div class="whirly-loader"> </div>
	</div> --}}
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		@include('layout.partials.header')
		<!-- /Header -->

		<!-- Sidebar -->
        @include('layout.partials.sidebar')

		<div class="page-wrapper">
			@yield('content')
			@include('layout.partials.footer')
		</div>

	</div>
	<!-- /Main Wrapper -->

	<!-- Add Stock -->
	<div class="modal fade" id="add-stock">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<div class="page-title">
						<h4>Add Stock</h4>
					</div>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="https://dreamspos.dreamstechnologies.com/html/template/index.html">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="mb-3">
									<label class="form-label">Warehouse <span class="text-danger ms-1">*</span></label>
									<select class="select">
										<option>Select</option>
										<option>Lobar Handy</option>
										<option>Quaint Warehouse</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="mb-3">
									<label class="form-label">Store <span class="text-danger ms-1">*</span></label>
									<select class="select">
										<option>Select</option>
										<option>Selosy</option>
										<option>Logerro</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="mb-3">
									<label class="form-label">Responsible Person <span class="text-danger ms-1">*</span></label>
									<select class="select">
										<option>Select</option>
										<option>Steven</option>
										<option>Gravely</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="search-form mb-0">
                                    <label class="form-label">Product <span class="text-danger ms-1">*</span></label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Select Product">
                                        <i data-feather="search" class="feather-search"></i>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-md btn-dark me-2" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-md btn-primary">Add Stock</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /Add Stock -->

	<!-- jQuery -->
	<script src="{{asset("assets")}}/js/jquery-3.7.1.min.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- Feather Icon JS -->
	<script src="{{asset("assets")}}/js/feather.min.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- Slimscroll JS -->
	<script src="{{asset("assets")}}/js/jquery.slimscroll.min.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{asset("assets")}}/js/bootstrap.bundle.min.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- ApexChart JS -->
	<script src="{{asset("assets")}}/plugins/apexchart/apexcharts.min.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>
	<script src="{{asset("assets")}}/plugins/apexchart/chart-data.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- Chart JS -->
	<script src="{{asset("assets")}}/plugins/chartjs/chart.min.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>
	<script src="{{asset("assets")}}/plugins/chartjs/chart-data.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- Daterangepikcer JS -->
	<script src="{{asset("assets")}}/js/moment.min.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>
	<script src="{{asset("assets")}}/plugins/daterangepicker/daterangepicker.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- Select2 JS -->
	<script src="{{asset("assets")}}/plugins/select2/js/select2.min.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- Color Picker JS -->
	<script src="{{asset("assets")}}/plugins/%40simonwep/pickr/pickr.es5.min.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>

	<!-- Custom JS -->
	<script src="{{asset("assets")}}/js/theme-colorpicker.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>
	<script src="{{asset("assets")}}/js/script.js" type="8270cbb9f13f4f3bbc83faf5-text/javascript"></script>


<script src="{{asset("assets")}}/cloudflare-static/rocket-loader.min.js" data-cf-settings="8270cbb9f13f4f3bbc83faf5-|49" defer></script></body>


<!-- Mirrored from dreamspos.dreamstechnologies.com/html/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Dec 2025 03:06:35 GMT -->
</html>
