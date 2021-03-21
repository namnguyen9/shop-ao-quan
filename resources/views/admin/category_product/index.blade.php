@extends('admin_layuot')
@section('category_list')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div>
        <div class="col-12 mb-3" id="btn_add-category">
            <a href="javascript:;" class="btn btn-success" onclick="category_product.showModal()" id="comeback"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm mới</a>
        </div>
        <div hidden class="col-12 mb-3" id="btn_add-seo-meta">
          <a href="javascript:;" class="btn btn-primary" onclick="category_product.showData()" ><i class="fas fa-long-arrow-alt-left"></i>Quay lại</a>
          <a href="javascript:;" class="btn btn-success" onclick="category_product.showModalSeoMeta()"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm mới</a>
        </div>
      </div>
      <div class="panel-heading">
          Danh mục sản phẩm
      </div>
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
            <form action="{{ URL::to('/category-product/search') }}" method="POST">
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
        <table id="tb_category" class="table table-striped b-t b-light">
          <thead>
            <tr id="tr_category">
              <th>Chọn</th>
              <th>STT</th>
              <th>Tên danh mục</th>
              <th>Mô tả</th>
              <th>Trạng thái</th>
              <th>Ngày thêm</th>
              <th>Seo Meta</th>
              <th>Thao tác</th>
              <th style="width:30px;"></th>
            </tr>
            <tr hidden id="tr_seo-meta-caregory">
              <th>STT</th>
              <th>Từ khóa</th>
              <th>Miêu tả</th>
              <th>Thao tác</th>
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
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
        <div id="btn_remove-all" >
          <a  href="javascript:;" onclick="category_product.select_all_categories()"><input type="checkbox" id="select_all_categories"/> Chọn tất cả</a>    
          <a style="position: absolute;right: 70px;color: red" href="javascript:;"  onclick="category_product.delete_checkbox_categories()">Xóa tất cả</a>        
      </div>
      </footer>
    </div>
  </div>
@include('admin.category_product.modal')
@include('admin.category_product.modal_seo_meta')
@endsection
