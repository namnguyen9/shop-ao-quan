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
                <h3 class="text-uppercase"><strong>Đăng kí tài khoản</strong></h3>
              </div>
              <form action="#" id="sign-up-form"  method="post">
                <div class="form-group first">
                  <label for="username">Họ và tên</label>
                  <input type="text" id="new_name" class="form-control" placeholder="Họ và tên" >
                  <em  class="error-name" style="color: red"></em>
                </div>
                <div class="form-group first">
                    <label for="username">Tên tài khoản</label>
                    <input  type="email" id="new_email"  class="form-control" placeholder="Địa chỉ email"  >
                    <em  class="error-email" style="color: red"></em>
                  </div>
                <div class="form-group last mb-3">
                  <label for="password">Mật khẩu</label>
                  <input type="password"  id="new_password" class="form-control" placeholder="Mật khẩu" >
                  <em  class="error-password" style="color: red"></em>
                </div>
                
                <div class="form-group last mb-3">
                    <label for="password">Số điện thoại</label>
                    <input type="text" id="new_phone" class="form-control" placeholder="Số điện thoại">
                    <em  class="error-phone" style="color: red"></em>
                </div>
                <a href="javascript:;" style="color:white" onclick="checkout.new_user_signup()" class="btn btn-block py-2 btn-primary">Đăng kí</a>
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