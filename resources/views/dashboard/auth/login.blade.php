<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 10 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
	<base href="../../../">
	<meta charset="utf-8" />
	<title>Login Page 1 | Keenthemes</title>
	<meta name="description" content="Login page example" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<link rel="canonical" href="https://keenthemes.com/metronic" />

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

	<link href="{{asset('css/pages/login/classic/login-1.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />

	<link rel="shortcut icon" href="{{asset('media/logos/favicon.ico')}}" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
	class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
			id="kt_login">
			<!--begin::Aside-->
			<div class="login-aside d-flex flex-column flex-row-auto" style="/* background-color: #F2C98A; */background-image: url(/media/login.png);background-size: 489px">				<!--begin::Aside Top-->
				<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
					<!--begin::Aside header-->
					<a href="#" class="text-center mb-10">
						{{-- <img src="assets/media/logos/logo-letter-1.png" class="max-h-70px" alt="" /> --}}
					</a>
					<!--end::Aside header-->
					<!--begin::Aside title-->
				
					<!--end::Aside title-->
				</div>
				<!--end::Aside Top-->
				<!--begin::Aside Bottom-->
				<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
					style="background-image: url(assets/media/login.png) ; background-size: 489px;"></div>
				<!--end::Aside Bottom-->
			</div>
			<!--begin::Aside-->
			<!--begin::Content-->
			<div
				class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
				<!--begin::Content body-->
				<div class="d-flex flex-column-fluid flex-center">
					<!--begin::Signin-->
					<div class="login-form login-signin">
						<!--begin::Form-->
						@if (session('error'))
							<div class="alert alert-danger">
								{{ session('error') }}
							</div>
						@endif
						<form class="form-auth-small m-t-20"
							action="{{route('dashboard.auth.login',['locale'=>app()->getLocale()])}}" method="post">
							@csrf
							<!--begin::Title-->
							<div class="pb-13 pt-lg-0 pt-5">
								<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to
									Metronic</h3>
								<span class="text-muted font-weight-bold font-size-h4">New Here?
									<a href="javascript:;" id="kt_login_signup"
										class="text-primary font-weight-bolder">Create an Account</a></span>
							</div>
							<!--begin::Title-->
							<!--begin::Form group-->
							<div class="form-group">
								<label class="font-size-h6 font-weight-bolder text-dark">Email</label>
								<input class="form-control  h-auto py-6 px-6 rounded-lg" type="text" name="email"
									autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group">
								<div class="d-flex justify-content-between mt-n5">
									<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
								</div>
								<input class="form-control  h-auto py-6 px-6 rounded-lg" type="password" name="password"
									autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Action-->
							<div class="pb-lg-0 pb-5">
								<button type="submit"
									class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign
									In</button>

							</div>
							<!--end::Action-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Signin-->
					<!--begin::Signup-->

					<!--end::Signup-->
					<!--begin::Forgot-->

					<!--end::Forgot-->
				</div>

				<!--end::Content footer-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Login-->
	</div>
	<!--end::Main-->


	<script>
		var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
	</script>

	<script>
		var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };
	</script>



	<script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>

	<script src="{{asset('plugins/custom/prismjs/prismjs.bundle.js')}}"></script>

	<script src="{{asset('js/scripts.bundle.js')}}"></script>

	<script src="{{asset('js/pages/custom/login/login-general.js')}}"></script>

	<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

	<script src="{{asset('crudjs/crud.js')}}"></script>
	<!--end::Page Scripts-->
</body>

<!--end::Body-->

</html>