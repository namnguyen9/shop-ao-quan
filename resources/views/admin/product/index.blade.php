@extends('admin_layuot')
@section('product_list')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div>
        <div class="col-12 mb-3" id="btnProduct">
            <a href="javascript:;" class="btn btn-success" onclick="product.showModal()" id="comeback"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm mới</a>
        </div>
        <div class="col-12 mb-3" hidden id="comback">
            <a href="javascript:;" class="btn btn-success" onclick="product.showData()" ><i class="fas fa-long-arrow-alt-left"></i>Quay lại</a>
            <a href="javascript:;" class="btn btn-success" onclick="product.showModalFile()" ><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm hình ảnh</a>
        </div>
      </div>
      <div class="panel-heading">
          Danh sách sản phẩm
      </div>
      <div id ="message" style="text-align: center;color:red"></div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <form action="" method="POST">
              {{csrf_field()}}
                <input type="text" class="input-sm form-control" name ='search'  id ='search' placeholder="Search">
                <span class="input-group-btn">
                <button type="submit" class="btn btn-sm btn-default" >Go!</button>
                </span>
          </form>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table id="tb_product" class="table table-striped b-t b-light">
          <thead>
            <tr id="tr_product">
              <th>Chọn</th>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Mô tả</th>
              <th>Chất liệu</th>
              <th>phong cách</th>
              <th>Hình ảnh</th>
              <th>Màu sản phẩm</th>
              <th>Giá sản phẩm</th>
              <th>Size</th>
              <th>Xuất xứ</th>
              <th>Trạng thái</th>
              <th>Thuộc danh mục</th>
              <th>Thuộc thương hiệu</th>
              <th>Ngày thêm</th>
              <th>Thao tác</th>
              <th style="width:30px;"></th>
            </tr>
            <tr hidden id="tr_image">
              <th>Chọn</th>
              <th>STT</th>
              <th>Tên hình ảnh</th>
              <th>Hình ảnh</th>
              <th>Xóa hình ảnh</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li ><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
        <div >
          <div id="btn-select_all_pro">
              <a  href="javascript:;" onclick="product.select_all_products()"><input type="checkbox" id="select_all_products"/> Chọn tất cả</a>    
              <a style="position: absolute;right: 70px;color: red" href="javascript:;"  onclick="product.delete_checkbox_products()">Xóa tất cả</a>        
          </div>
          <div hidden id="btn-select_all_img">
              <a href="javascript:;" onclick="product.select_all_images()"><input type="checkbox" id="select_all_images"/> Chọn tất cả</a>    
              <a style="position: absolute;right: 70px;color: red" href="javascript:;"  onclick="product.delete_checkbox_images()">Xóa tất cả</a>        
          </div>
        </div>
      </footer>
    </div>
  </div>
@include('admin.product.modal')
@include('admin.product.file.modalFile')
@endsection
