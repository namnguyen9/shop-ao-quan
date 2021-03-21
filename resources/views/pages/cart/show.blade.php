<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Giỏ Hàng</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
	<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js"> </script> 
    <link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
<header id="header"><!--header-->
	<div class="header_top"><!--header_top-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header_top-->
	
	<div class="header-middle"><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="logo pull-left">
						<a href="{{ route('trang-chu') }}"><img src="{{asset('frontend/images/logo.png')}}" alt="" /></a>
					</div>
					<div class="btn-group pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								USA
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="#">Canada</a></li>
								<li><a href="#">UK</a></li>
							</ul>
						</div>
						
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								DOLLAR
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="#">Canadian Dollar</a></li>
								<li><a href="#">Pound</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
							<li><a href="{{ url('/user/profile') }}"><i class="fa fa-star"></i> Yêu thích</a></li>
							<li><a  href="{{ url('/cart') }}" id="cart_list"><i class="fa fa-shopping-cart"></i> Giỏ hàng<span class="badge" class="badge badge-success"></span></a></li>
							@if (count(Cart::content()) > 0)
							<li><a  href="{{ url('/checkout') }}" ><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
							@else
							<li><a  href="{{ url('/cart') }}" ><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
							@endif
							@if (Auth::id())
                            <li>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    @if (Auth::user())
										@if (Auth::user()->avatar)
											<img alt="" src="{{ Auth::user()->avatar }}" width="30px" height="30px" style="border-radius:50%">
											<span class="username">
												<?php 
													$user = Auth::user();
													if($user){
														echo $user->name;
													}
												?>
											</span>
												<b class="caret"></b>
											</a>
											<ul class="dropdown-menu extended logout">
												<li><a href="{{ url('/user/profile') }}"><i class=" fa fa-suitcase"></i>Tài Khoản Của Tôi</a></li>
												<li><a href="{{ url('/user/profile') }}"><i class="fas fa-sticky-note"></i>Đơn Hàng</a></li>
												<li><a href="javascript:;" onclick="checkout.logout()" ><i class="fa fa-key"></i> Đăng xuất</a></li>
											</ul>
										@else
												<span class="username">
													<?php 
														$user = Auth::user();
														if($user){
															echo $user->name;
														}
													?>
												</span>
												<b class="caret"></b>
											</a>
											<ul class="dropdown-menu extended logout">
												<li><a href="{{ url('/user/profile') }}"><i class=" fa fa-suitcase"></i>Tài Khoản Của Tôi</a></li>
												<li><a href="{{ url('/user/profile') }}"><i class="fas fa-sticky-note"></i>Đơn Hàng</a></li>
												<li><a href="javascript:;" onclick="checkout.logout()" ><i class="fa fa-key"></i> Đăng xuất</a></li>
											</ul>
										@endif
                                	 @endif
                            </li> 
                            @else
                                <li id="login"><a href="{{ url('/user/login') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                            @endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-middle-->

	<div class="header-bottom"><!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="{{ route('trang-chu') }}" class="active">Trang chủ</a></li>
							<li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="shop.html">Products</a></li>
								</ul>
							</li> 
							<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a></li> 
							<li><a href="">Giỏ hàng<span class="badge" class="badge badge-success"></span></a></li>
							<li><a href="contact-us.html">Liên hệ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-bottom-->
</header><!--/header-->

<section >
	<section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
					<li><a href="{{ route('trang-chu') }}">Home</a></li>
                    <li class="active">Giỏ Hàng</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
				<table 	id="cart" class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image" colspan="2">Sản phẩm</td>
							<td class="price">Phân loại	</td>
							<td class="price">Đơn Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="quantity">Tổng tiền</td>
							<td class="delete">Xóa</td>
						</tr>
					</thead>
					<tbody>
					 
					</tbody>
				</table>
            </div>
        </div>
    </section>
    <!--/#cart_items-->

	<section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tổng đơn giá<span id="subtotal">0 đ</span></li>
                            <li>Thuế <span id="tax">0 đ</span></li>
                            <li>Phí vận chuyển<span >Free</span></li>
                            <li>Thành tiền<span id="total">0 đ</span></li>
                        </ul>
						@if (Auth::check())
							<div id="btn-cart">
								
							</div>
						@else
                        	<a class="btn btn-default update" href="{{ URL::to('/user/login') }}">Mua ngay</a>
						@endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#do_action-->
</section>

<footer id="footer"><!--Footer-->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="companyinfo">
						<h2><span>e</span>-shopper</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="{{ ('frontend/images/iframe1.png') }}" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="{{ ('frontend/images/iframe2.png') }}" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="{{ ('frontend/images/iframe3.png') }}" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="{{ ('frontend/images/iframe4.png') }}" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="address">
						<img src="{{ ('frontend/images/map.png') }}" alt="" />
						<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="footer-widget">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Service</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">Online Help</a></li>
							<li><a href="#">Contact Us</a></li>
							<li><a href="#">Order Status</a></li>
							<li><a href="#">Change Location</a></li>
							<li><a href="#">FAQ’s</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Quock Shop</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">T-Shirt</a></li>
							<li><a href="#">Mens</a></li>
							<li><a href="#">Womens</a></li>
							<li><a href="#">Gift Cards</a></li>
							<li><a href="#">Shoes</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Policies</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">Terms of Use</a></li>
							<li><a href="#">Privecy Policy</a></li>
							<li><a href="#">Refund Policy</a></li>
							<li><a href="#">Billing System</a></li>
							<li><a href="#">Ticket System</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>About Shopper</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">Company Information</a></li>
							<li><a href="#">Careers</a></li>
							<li><a href="#">Store Location</a></li>
							<li><a href="#">Affillate Program</a></li>
							<li><a href="#">Copyright</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-3 col-sm-offset-1">
					<div class="single-widget">
						<h2>About Shopper</h2>
						<form action="#" class="searchform">
							<input type="text" placeholder="Your email address" />
							<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
							<p>Get the most recent updates from <br />our site and be updated your self...</p>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
				<p class="pull-right">Designed by <span><a target="_blank" href="https://www.themeum.com">Themeum</a></span></p>
			</div>
		</div>
	</div>
	
</footer><!--/Footer-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
	<script src="{{ asset('frontend/js/main.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/admin/js/cart.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/admin/js/checkout.js') }}"></script>
</body>
</html>


    