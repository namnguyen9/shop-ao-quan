  <!-- Modal create -->
  <div class="modal fade" id="modal-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align: center" id="exampleModalLabel">Thêm Địa Chỉ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="address"  enctype="multipart/form-data">
                    @csrf
                    <div  class="row">
                        <input type="hidden" id="shipping-id" name="shipping-id" value="0">
                        <div   class="form-group col-md-12">
                            <label for="#"><b><i>Họ và tên</i></b></label>
                            <input type="text" id="user-name"  class="form-control" placeholder="--Họ và Tên--">
                            <em style="color:red" id="error-name" class="error-name"></em >
                        </div>

                        <div   class="form-group col-md-12">
                            <label for="#"><b><i>Số điện thoại</i></b></label>
                            <input type="text" id="user-phone"  class="form-control" placeholder="--Số điện thoại--">
                            <em style="color:red" id="error-phone" class="error-phone" ></em >
                        </div>

                        <div class="form-group col-md-12">
                            <label for="#"><b><i>Tỉnh/Thành phố</i></b></label>
                            <select  class="form-control" onchange="checkout.districts()"  id="provinces_and_cities">
                                <option  value="-1">Tỉnh/Thành phố</option>
                            </select>
                            <em style="color:red" id="error-province_and_city_id" class="error-province_and_city_id"></em >
                        </div>

                        <div class="form-group col-md-12">
                            <label for="#"><b><i>Quận/Huyện</i></b></label>
                            <select class="form-control"  id="districts">
                                <option value="" >Quận/Huyện</option>
                            </select>
                            <em style="color:red" id="error-district_id" class="error-district_id"></em >
                        </div>

                        <div   class="form-group col-md-12">
                            <label for="#"><b><i>Phường/Xã</i></b></label>
                            <input type="text" id="wards_and_communes"  class="form-control" placeholder="--Phường/Xã--" >
                            <em style="color:red" id="error-wards_and_communes" class="error-wards_and_communes"></em >
                        </div>

                        <div   class="form-group col-md-12">
                            <label for="#"><b><i>Tòa nhà/Tên đường</i></b></label>
                            <input type="text" id="street_names"  class="form-control" placeholder="--Tòa nhà/Tên đường--">
                            <em style="color:red" id="error-street_names" class="error-street_names"></em >
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                <a href="javascript:;" class="btn btn-info" onclick="checkout.save_address()" >Lưu</a>
            </div>
        </div>
    </div>
</div>
