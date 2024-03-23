<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ !empty($meta_title) ? $meta_title : '' }}</title>

    @if (!empty($meta_description))
       <meta name="description" content="{{ $meta_description }}">
    @endif

    @if (!empty($meta_keywords))
       <meta name="keywords" content="{{ $meta_keywords }}">
    @endif
    <!-- Favicon -->
    
    <link rel="shortcut icon" href="{{asset('/')}}website/assets/images/icons/favicon.ico">
    
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('/')}}website/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/')}}website/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{asset('/')}}website/assets/css/plugins/magnific-popup/magnific-popup.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('/')}}website/assets/css/style.css">
    @yield('style')
</head>
<body>
    <div class="page-wrapper">

     @include('website.layouts.header')
        @yield('content')
     @include('website.layouts.footer')

    </div>

<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div>

@include('website.layouts.mobile')

<!-- Sign in / Register Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="singin-email">Username or email address *</label>
                                        <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="singin-password">Password *</label>
                                        <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="signin-remember">
                                            <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                        </div>

                                        <a href="#" class="forgot-link">Forgot Your Password?</a>
                                    </div>
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="{{ url('auth_register') }}" id="SubmitFormRegister" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="register-name">Name <Span style="color: red">*</Span></label>
                                        <input type="text" class="form-control" id="register-name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="register-email"> Email address <Span style="color: red">*</Span></label>
                                        <input type="email" class="form-control" id="register-email" name="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="register-password">Password <Span style="color: red">*</Span></label>
                                        <input type="password" class="form-control" id="register-password" name="password" required>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" value="submit" class="btn btn-outline-primary-2">
                                            <span>SIGN UP</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                            <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login  btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row no-gutters bg-white newsletter-popup-content">
                <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                    <div class="banner-content text-center">
                        <img src="{{asset('/')}}website/assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                        <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                        <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                        <form action="#">
                            <div class="input-group input-group-round">
                                <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><span>go</span></button>
                                </div><!-- .End .input-group-append -->
                            </div><!-- .End .input-group -->
                        </form>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                            <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                        </div><!-- End .custom-checkbox -->
                    </div>
                </div>
                <div class="col-xl-2-5col col-lg-5 ">
                    <img src="{{asset('/')}}website/assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Plugins JS File -->
<script src="{{asset('/')}}website/assets/js/jquery.min.js"></script>
<script src="{{asset('/')}}website/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}website/assets/js/jquery.hoverIntent.min.js"></script>
<script src="{{asset('/')}}website/assets/js/jquery.waypoints.min.js"></script>
<script src="{{asset('/')}}website/assets/js/superfish.min.js"></script>
<script src="{{asset('/')}}website/assets/js/owl.carousel.min.js"></script>
<script src="{{asset('/')}}website/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Main JS File -->
<script src="{{asset('/')}}website/assets/js/main.js"></script>

@yield('script')

<script>
    $('body').delegate('#SubmitFormRegister', 'submit', function(e){
        e.preventDefault();
         $.ajax({
				type : "POST",
				url  :  "{{ url('auth_register') }}",
				data :  $(this).serialize(),
				dataType : "json",
				success  : function(data) {
                    alert(data.message);
                    if(data.status == true)
                    {
                        location.reload();
                    }
				},
				error :   function(data) {

				}
			});
    });
</script>



</body>



</html>