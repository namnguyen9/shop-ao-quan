@extends('admin_layuot')
@section('order_list')
<section id="order">
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Đơn hàng
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
            <form action="{{ URL::to('/brand-product/search') }}" method="POST">
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
        <table id="tb_order" class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Chọn</th>
              <th>STT</th>
              <th>Tên khách hàng</th>
              <th>Mã số tài khoản</th>
              <th>Số điện thoại</th>
              <th>Địa chỉ</th>
              <th>Hình thức thanh toán</th>
              <th>Tổng tiền</th>
              <th>Tình trạng</th>
              <th>Ghi chú </th>
              <th>Chi tiêt</th>
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
        <div>
          <a href="javascript:;" onclick="order.select_all_orders()"><input type="checkbox" id="select_all_orders"/> Chọn tất cả</a>    
          <a style="position: absolute;right: 70px;color: red" href="javascript:;"  onclick="order.delete_checkbox_orders()">Xóa tất cả</a>        
      </div>
      </footer>
    </div>
  </div>
</section>

<section id="view_order" hidden>
  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="col-12 mb-3" id="btn-back">
        <a href="javascript:;"  class="btn btn-success" onclick="order.back()" ><i class="fas fa-long-arrow-alt-left"></i>Quay lại</a>
    </div>
      <div class="panel-heading">
         Thông tin vận chuyển
      </div>
      <div class="table-responsive">
        <table id="tb_shipping" class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên người nhận hàng</th>
              <th>Số điện thoại người nhận</th>
              <th>Địa chỉ người nhận</th>
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
      </footer>
    </div>
  </div>

<br> 

  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê chi tiết đơn hàng
      </div>
      <div class="table-responsive">
        <table id="tb_order_details" class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Giá sản phẩm</th>
              <th>Số lượng</th>
              <th>Tổng tiền</th>
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
      </footer>
    </div>
  </div>
</section>
@endsection
