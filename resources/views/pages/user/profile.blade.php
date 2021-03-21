<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thông tin cá nhân</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
	<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js"> </script> 
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/userInformation.css') }}">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet"> <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
				</div>
				<div class="col-sm-8">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
							<li><a href="{{ url('/user/profile') }}"><i class="fa fa-star"></i> Yêu thích</a></li>
							<li><a  href="{{ url('/cart') }}" id="cart_list"><i class="fa fa-shopping-cart"></i> Giỏ hàng<span  class="badge" style="background-color: red" class="badge badge-success"></span></a></li>
							<li><a  href="{{ url('/checkout') }}" ><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
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
									<li><a href="#">Products</a></li>
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

<div class="container" style="background-color:whitesmoke"> 
    <h1 class="text-center">Thông tin khách hàng</h1> 
    <div class="container" > 
		<div class="row profile" >        
			<div class="col-md-3" >          
				<div class="profile-sidebar" style="background-color:whitesmoke">                          
					<div class="profile-userpic"> <img src="{{ asset('frontend/images/iframe4.png') }}" class="img-responsive" alt="Thông tin cá nhân">               
				</div>                                            
				<div class="profile-usertitle">                   
					<div class="profile-usertitle-name">{{ Auth::user()->name }}</div>                  
					</div>                                                
				<div class="profile-userbuttons">                 
					<a href="{{ route('trang-chu') }}" class="btn btn-success btn-sm">Trang chủ</a>                  
					<a href="{{ URL::to('/user/login') }}"  class="btn btn-danger btn-sm">Đăng xuất</a>                
				</div>                                            
				<div class="profile-usermenu">                    
					<ul class="nav" >
						<li><a href="javascript:;" onclick="user.show();"><i class="fas fa-user-edit"></i>Tài Khoản Của Tôi </a></li>
						<li><a href="javascript:;" onclick="user.form_password()" ><i style="color: gold" class="fas fa-key"></i>Đổi Mật Khẩu </a></li>
						<li><a href="javascript:;" onclick="user.manage_address()" ><i style="color:red" class="fas fa-map-marker-alt"></i>Địa chỉ</a></li>
						<li><a href="javascript:;" onclick="user.manage_order()"><i style="color: dodgerblue" class="fas fa-shopping-cart"></i>Đơn Mua</a></li>                       
						<li><a href="javascript:;" onclick="user.manage_favorite_products()"><i style="color: pink" class="glyphicon glyphicon-heart"></i>Sản Phẩm Yêu Thích </a></li>                       
						<li><a href="#"><i style="color: orange" class="glyphicon glyphicon-envelope"></i>Tin Nhắn </a></li>                   
					</ul>                
				</div>                            
			</div>     
				</div>      
			<div  class="col-md-9"> 
				
				<div id="data-profile"></div>

				<div hidden id="address_manage">
					<table id="tbl_address" class="table table-dark">
						<thead style="background-color: rgb(255, 166, 0)">
							<a style="margin-bottom: 10px" href="javascript:;" class="btn btn-success" onclick="checkout.showModalAddress()"  > Thêm mới</a>        
							<tr>
								<th scope = "col"> STT </th> 
								<th scope = "col"> Địa chỉ </th> 
								<th scope = "col"> Thay đổi </th> 
								<th scope = "col"> Xóa địa chỉ</th> 
							</tr> 
							<tbody>

							</tbody>
						</thead>	
					</table>  
				</div>
				
				<div hidden id="manage_order">
					<table id="tbl_order" class = "table thead-dark">
						<a style="margin-bottom: 10px" href="javascript:;" class="btn btn-success" onclick="checkout.showModalAddress()"  > Thêm mới</a>        
						<thead style="background-color: rgb(255, 166, 0)">
							<tr>
								<th scope = "col"> Chọn </th> 
								<th scope = "col"> Tên đơn hàng </th> 
								<th scope = "col"> Mã đơn hàng </th> 
								<th scope = "col"> Số lượng </th> 
								<th scope = "col">Giá tiền </th> 
								<th scope = "col">Tổng số tiền</th> 
								<th scope = "col">Thao tác</th> 
							</tr> 
						</thead>	
						<tbody>

						</tbody>
					</table>  
					<div >
						<a style="margin-left: 8px" href="javascript:;" onclick="user.select_all_orders()"><input type="checkbox" id="btn-select_all_orders"/> Chọn tất cả</a>    
						<a style="position: absolute;right: 45px;color: red" href="javascript:;"  onclick="user.delete_checkbox_orders()">Hủy tất cả</a>        
					</div>
				</div>

					
				<div hidden id="manage_favorite_products">
					<table id="tbl_favorite_products" class = "table thead-dark">
						<thead  style="background-color: rgb(255, 166, 0)">
							<tr>
								<th scope = "col"> Chọn </th> 
								<th scope = "col"> Tên sản phẩm </th> 
								<th scope = "col">Thao tác</th> 
							</tr> 
						</thead>	
						<tbody>

						</tbody>
					</table>  
					<div >
						<a style="margin-left: 8px" href="javascript:;" onclick="user.select_all_favorite_products()"><input type="checkbox" id="btn-select_all_favorite_products"/> Chọn tất cả</a>    
						<a style="position: absolute;right: 45px;color: red" href="javascript:;"  onclick="user.delete_checkbox_favorite_products()">Hủy tất cả</a>        
					</div>
				</div>

			</div>
		</div>
     </div> 
</div>

     
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
									<img src="{{ asset('frontend/images/iframe1.png') }}" alt="" />
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
									<img src="{{ asset('frontend/images/iframe2.png') }}" alt="" />
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
									<img src="{{ asset('frontend/images/iframe3.png') }}" alt="" />
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
									<img src="{{ asset('frontend/images/iframe4.png') }}" alt="" />
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
						<img src="{{ asset('frontend/images/map.png') }}" alt="" />
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
	@include('pages.checkout.delivery_address')
</footer><!--/Footer-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
	<script src="{{ asset('frontend/js/main.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/admin/js/user.js') }}"></script>
	{{-- <script type="text/javascript" src="{{ asset('backend/admin/js/cart.js') }}"></script> --}}
	<script type="text/javascript" src="{{ asset('backend/admin/js/checkout.js') }}"></script>
</body>
</html>


      	