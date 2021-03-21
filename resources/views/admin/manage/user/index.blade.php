@extends('admin_layuot')
@section('user_list')
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
        <table id="tb_user" class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Chọn</th>
                    <th>STT</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
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
          <a href="javascript:;" onclick="user.select_all_users()"><input type="checkbox" id="select_all_users"/> Chọn tất cả</a>    
          <a style="position: absolute;right: 70px;color: red" href="javascript:;"  onclick="user.delete_checkbox_users()">Xóa tất cả</a>        
      </div>
      </footer>
    </div>
  </div>
@endsection