<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{ asset('backend/css/style.css') }}" rel='stylesheet' type='text/css' />
<link href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet"/>
<!-- font CSS -->
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{ asset('backend/css/font.css') }}" type="text/css"/>
<link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet"> 
<link rel="stylesheet" href="{{ asset('backend/css/morris.css') }}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{ asset('backend/css/monthly.css') }}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{ asset('backend/js/jquery2.0.3.min.js') }}"></script>
<script src="{{ asset('backend/js/raphael-min.js') }}"></script>
<script src="{{ asset('backend/js/morris.js') }}"></script>
<script src="{{ asset('backend/js/morris.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>   

<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="sweetalert2.min.css">

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="#" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{ asset('backend/images/anhcv1.jpg') }}">
                <span class="username">
					<?php 
						$admin = Session::get('admin');
						if($admin){
							echo $admin->name;
						}
					?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Hồ sơ</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Cài đặt</a></li>
                <li><a href="{{ route('admin.logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{ URL::to('/dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                
                <li class="sub-menu">   
                    <a href="{{ URL::to('/category-product/dashboard') }} " >
                        <i class="fa fa-book"></i>
                        <span >Danh mục sản phẩm</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="{{ URL::to('/brand-product/dashboard') }}">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="{{ URL::to('/product/dashboard') }}">
                        <i class="fab fa-product-hunt"></i>
                        <span>Sản phẩm</span>
                    </a>
                    
                </li>

                <li class="sub-menu">
                   <a href="">
                        <i class="fas fa-tasks"></i>
                        <span>Đơn hàng</span>
                   </a>
                    <ul>
                        <li>
                            <a href="{{ URL::to('/order/dashboard') }}">
                                <span> Quản lý đơn hàng</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="{{ URL::to('/user/dashboard') }}">
                        <i class="fas fa-user"></i>
                        <span>Tài khoản người dùng</span>
                    </a>
                    
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        @yield('admin_content')
        @yield('category_list')
        @yield('brand_list')
        @yield('product_list')
        @yield('order_list')
        @yield('user_list')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="https://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
          
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('category_meta_desc');
    CKEDITOR.replace('brand_meta_desc');
    CKEDITOR.replace('desc');
</script>
<script src="sweetalert2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/bootstrap.js') }}"></script>
<script src="{{ asset('backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('backend/js/scripts.js') }}"></script>
<script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
<!-- morris JavaScript -->	
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script type="text/javascript" src="{{ asset('backend/admin/js/product.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/admin/js/category_product.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/admin/js/brand_product.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/admin/js/order.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/admin/js/user.js') }}"></script>
<!-- calendar -->
	<script type="text/javascript" src="{{ asset('backend/js/monthly.js') }}"></script>
	<script type="text/javascript">
		$(window).load( function() {
			$('#mycalendar').monthly({
				mode: 'event',
			});
			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});
		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}
		});
	</script>
</body>
</html>
