<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng nhập | E-Shopper</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('frontend/login_form/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/login_form/css/owl.carousel.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/login_form/css/bootstrap.min.css') }}">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('frontend/login_form/css/style.css') }}">
  </head>
  <body>
	<nav class="navbar navbar-dark bg-dark" style="background-color: white">
		<ul>
			<li>
				<div class="logo pull-left">
					<a href="{{ route('trang-chu') }}"><img src="{{asset('frontend/images/logo.png')}}" alt="" /></a>
				</div>
			</li>
		</ul>
</nav>
  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('/frontend/login_form/images/bg_1.jpg');"></div>
    <div class="contents">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3 class="text-uppercase"><strong>Đăng nhập</strong></h3>
              </div>
              <form action="#"  id="login-form" method="post">
                <div class="form-group first">
                  <label for="username">Tên tài khoản</label>
				          <input  class="form-control" onchange="checkout.resetErr()" type="email" id="email_account" placeholder="Địa chỉ email" />
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Mật khẩu</label>
				          <input  class="form-control" onchange="checkout.resetErr()"  type="password" id="password_account" placeholder="Mật khấu" />
                </div>
				        <em  id="err_login" style="color: red"></em>
                <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Lưu mật khẩu</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                  </label>
                  <span class="ml-auto"><a href="{{ URL::to('/user/sign-up') }}" class="forgot-pass">Đăng kí ngay</a></span> 
                </div>
				        <a href="javascript:;" style="color:white" onclick="checkout.login()" class="btn btn-block py-2 btn-primary">Đăng nhập</a>
                <span class="text-center my-3 d-block">hoặc</span>
                <div class="">
                <a href="{{ url('auth/facebook') }}" class="btn btn-block py-2 btn-facebook">
                  <span class="icon-facebook mr-3"></span> Đăng nhập facebook
                </a>
                <a href="{{ url('auth/google') }}" class="btn btn-block py-2 btn-google"><span class="icon-google mr-3"></span> Đăng nhập Google</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
    <script src="{{ asset('frontend/login_form/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/login_form/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/login_form/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/login_form/js/main.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/admin/js/checkout.js') }}"></script>
  </body>
</html>

