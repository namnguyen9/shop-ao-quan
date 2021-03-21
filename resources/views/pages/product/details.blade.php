<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{!! $meta_desc !!}">
    <meta name="keywords" content="{{ $meta_keywords }}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link  rel="icon" type="image/x-icon" href="/frontend/images/logo.png" />

    <meta property="og:image" content="{{ $image_og }}" />
    <meta property="og:site_name" content="https://shop-quan-ao-laravel.herokuapp.com/" />
    <meta property="og:description" content="{!! $meta_desc !!}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" />

	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title id="title">{{ $meta_title }}</title>
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
                            <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
						</div>
						<div class="btn-group">
                            <div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
						</div>
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
							<li ><a href="{{ URL::to('/cart') }}">Giỏ hàng<span class="badge" style="background-color: red" class="badge badge-success"></span></a></li>
							<li><a href="contact-us.html">Liên hệ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-bottom-->
</header><!--/header-->

    <div class="col-sm-10 padding-right" style="width:100%;padding-left:100px;padding-right:100px;">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="/uploads/images/{{ $librarys[0]->name }}" width="330px" height="400px" alt="" />
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">
								
                    <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                          <div class="item active">
                            @for ($i = 1 ; $i < count($librarys); $i++)
                                <a href=""><img src="/uploads/images/{{ $librarys[$i]->name }}" width="84" height="84" alt=""></a>
                            @endfor
                          </div>
                      </div>
                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                      <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                      <i class="fa fa-angle-right"></i>
                    </a>
              </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2>{{$product->name}}</h2>
                    <img src="images/product-details/rating.png" alt="" />
                    <form id="form_cart" >
                        <span>
                            <span>{{number_format($product->price)."đ"}}</span>
                            <label>Số lượng:</label>
                            <input id="qty" type="number" min="1" value="1" />
                                @if (Auth::id())
                                <a href="javascript:;" id ="add_cart" onclick="home.add_cart({{$product->id}})" class="btn btn-fefault cart">
                                @else
                                <a href="{{ route('login') }}"   class="btn btn-fefault cart">
                                @endif
                            <i class="fa fa-shopping-cart"></i>
                            Thêm giỏ hàng
                            </a>
                        </span>
                    </form>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <th><b>Thương hiệu</b></th>
                                <td>{{$product->brand->name}}</td>
                            </tr>
                            <tr>
                                <td><b>Chất liệu</b></td>
                                <td>{{ $product->fabric_material }}</td>
                            </tr>
                            <tr>
                                <td><b>Màu sắc</b></td>
                                <td>{{ $product->color }}</td>
                            </tr>
                            <tr>
                                <td><b>Phong cách</b></td>
                                <td>{{ $product->style }}</td>
                            </tr>
                            <tr>
                                <td><b>Size</b></td>
                                <td>{{ $product->size }}</td>
                            </tr>
                            <tr>
                                <td><b>Xuất xứ</b></td>
                                <td>{{ $product->origin }}</td>
                            </tr>
                            <tr>
                                <td><b>Danh mục</b></td>
                                <td>{{$product->category->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href=""><img src="/frontend/images/map.png" class="share img-responsive"  alt="" /></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->
        
        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Bình luận</a></li>
                    <li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details" >
                       <pre>{!! $product->desc !!}</pre>           
                </div>
                
                <div style="text-align: center;"  class="tab-pane fade" id="companyprofile" >
                    <div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>
                </div>
              
                <div class="tab-pane fade " id="reviews" >
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p><b>Write Your Review</b></p>
                        
                        <form action="#">
                            <span>
                                <input type="text" placeholder="Your Name"/>
                                <input type="email" placeholder="Email Address"/>
                            </span>
                            <textarea name="" ></textarea>
                            <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/category-tab-->
        
        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Sản phẩm liên quan</h2>
            
            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">	
                        @if (count($product_suggestions) > 0)
                            @foreach ($product_suggestions as $value)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="/product/detail/{{$value->id}}">
                                                        <img src="/uploads/images/{{ $value->photo_librarys[0]->name }}" height="260" alt="" />
                                                        <h2>{{number_format($value->price)."đ"}}</h2>
                                                        <p>{{ $value->name }}</p>
                                                    </a>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href="javascript:;" onclick="home.add_ssfavorite_product({{$value->id}})"><i style="color: pink" class="fas fa-heart"></i></i>Thêm yêu thích</a></li>
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                  </a>			
            </div>
        </div><!--/recommended_items-->
    </div>
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
                                    <img src="/frontend/images/iframe1.png" alt="" />
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
</footer><!--/Footer-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
	<script src="{{ asset('frontend/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/admin/js/home.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/admin/js/checkout.js') }}"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="7rI90W8m"></script>
</body>
</html>


    