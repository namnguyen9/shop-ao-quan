@extends('layout.layout')
@section('content') 
<div id="show_data" class="container">
     <div class="row">

          <div class="col-sm-3">
               <div class="left-sidebar">
                    <h2>Danh mục sản phẩm</h2>
                   <div class="panel-group category-products" id="accordian">
                       <!--category-productsr-->
                      

                   </div>
                   <!--/category-products-->

                   <div class="brands_products">
                       <!--brands_products-->
                       <h2>Thương hiệu sản phẩm</h2>
                       <div class="brands-name">
                              <ul id="brands" class="nav nav-pills nav-stacked">

                              </ul>
                       </div>
                   </div>
               </div>
           </div>

          <div class="col-sm-9 padding-right">
               <div class="features_items"><!--features_items-->
                    <h2 class="title text-center" id="category_title">Sản phẩm mới nhất</h2>
                    <div id="products"></div>
               </div>
          </div>

     </div> 
</div> 
@endsection
