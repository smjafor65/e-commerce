

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamspos.dreamstechnologies.com/html/template/signin-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Dec 2025 03:10:58 GMT -->
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

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset("assets")}}/img/favicon.png">

		<!-- Apple Touch Icon -->
		<link rel="apple-touch-icon" sizes="180x180" href="{{asset("assets")}}/img/apple-touch-icon.png">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset("assets")}}/css/bootstrap.min.css">

        <!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset("assets")}}/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="{{asset("assets")}}/plugins/fontawesome/css/all.min.css">

         <!-- Tabler Icon CSS -->
	    <link rel="stylesheet" href="{{asset("assets")}}/plugins/tabler-icons/tabler-icons.min.css">

	    <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset("assets")}}/css/style.css">

    </head>
    <body class="account-page bg-white">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="login-content user-login mt-5">
                    <div class="login-logo text-center mb-4">
                        <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo">
                        <a href="{{ url('/') }}" class="login-logo logo-white d-block mt-2">
                            <img src="{{ asset('assets/img/logo-white.svg') }}" alt="Logo White">
                        </a>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card">
                            <div class="card-body p-5">
                                <div class="login-userheading text-center mb-4">
                                    <h3>{{ __('Sign In') }}</h3>
                                    <h4 class="text-muted">Access the Dreamspos panel using your email and passcode.</h4>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror border-end-0" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <span class="input-group-text border-start-0"><i class="ti ti-mail"></i></span>
                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                                    <div class="pass-group">
                                        <input id="password" type="password" class="pass-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Remember Me & Forgot -->
                                <div class="form-login authentication-check mb-3">
                                    <div class="row">
                                        <div class="col-12 d-flex align-items-center justify-content-between">
                                            <div class="custom-control custom-checkbox">
                                                <label class="checkboxs ps-4 mb-0 pb-0 line-height-1 fs-16 text-gray-6">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="checkmarks"></span>{{ __('Remember Me') }}
                                                </label>
                                            </div>
                                            @if (Route::has('password.request'))
                                            <div class="text-end">
                                                <a class="text-orange fs-16 fw-medium" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-login mb-3">
                                    <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                                </div>

                                <div class="signinform text-center mb-3">
                                    <h4>New on our platform? <a href="{{ route('register') }}" class="hover-a">Create an account</a></h4>
                                </div>

                                <div class="form-setlogin or-text text-center mb-3"><h4>OR</h4></div>

                                <!-- Social login buttons -->
                                <div class="d-flex align-items-center justify-content-center flex-wrap">
                                    <div class="text-center me-2 flex-fill">
                                        <a href="javascript:void(0);" class="br-10 p-2 btn btn-info d-flex align-items-center justify-content-center">
                                            <img class="img-fluid m-1" src="{{ asset('assets/img/icons/facebook-logo.svg') }}" alt="Facebook">
                                        </a>
                                    </div>
                                    <div class="text-center me-2 flex-fill">
                                        <a href="javascript:void(0);" class="btn btn-white br-10 p-2 border d-flex align-items-center justify-content-center">
                                            <img class="img-fluid m-1" src="{{ asset('assets/img/icons/google-logo.svg') }}" alt="Google">
                                        </a>
                                    </div>
                                    <div class="text-center flex-fill">
                                        <a href="javascript:void(0);" class="bg-dark br-10 p-2 btn btn-dark d-flex align-items-center justify-content-center">
                                            <img class="img-fluid m-1" src="{{ asset('assets/img/icons/apple-logo.svg') }}" alt="Apple">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text text-center">
                        <p>Copyright &copy; 2025 DreamsPOS</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



		<!-- jQuery -->
        <script src="{{asset("assets")}}/js/jquery-3.7.1.min.js" type="35ce4b4acd03f02e06a16363-text/javascript"></script>

         <!-- Feather Icon JS -->
		<script src="{{asset("assets")}}/js/feather.min.js" type="35ce4b4acd03f02e06a16363-text/javascript"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{asset("assets")}}/js/bootstrap.bundle.min.js" type="35ce4b4acd03f02e06a16363-text/javascript"></script>

		<!-- Custom JS -->
        <script src="{{asset("assets")}}/js/script.js" type="35ce4b4acd03f02e06a16363-text/javascript"></script>

    <script src="{{asset("assets")}}/cloudflare-static/rocket-loader.min.js" data-cf-settings="35ce4b4acd03f02e06a16363-|49" defer></script></body>

<!-- Mirrored from dreamspos.dreamstechnologies.com/html/template/signin-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Dec 2025 03:10:58 GMT -->
</html>
