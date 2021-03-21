  <!-- Modal create -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align: center" id="exampleModalLabel">Thêm danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="Form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="productId" name="productId" value="0">
                    <div id="get-file" class="row"></div>
                    <div id="get-product" class="row">
                        <div id = "div_name" class="form-group col-md-8">
                            <label for="#"><b><i>Tên sản phẩm</i></b></label>
                            <input type="text" id="name" name="name" class="form-control" >
                            <em style="color:red"  class="errors-name"></em >
                        </div>

                        <div id="div_status" class="form-group col-md-4">
                            <label for="#"><b><i>Trạng thái</i></b></label>
                            <select  style="width:100%" class="form-control"  id="status" name="status" >      
                                    <option selected ></option>
                                    <option value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                            </select>
                            <em style="color:red" class="errors-status"></em>
                        </div>

                        <div  class="form-group col-md-8">
                            <label for="#"><b><i>Chất liệu</i></b></label>
                            <input type="text" id="fabric_material" name="fabric_material" class="form-control" >
                            <em style="color:red"  class="errors-fabric_material"></em >
                        </div>

                        <div class="form-group col-md-4">
                            <label for="#"><b><i>Thuộc danh mục</i></b></label>
                                <select style="width:100%" class="form-control" name="category_id" id="category_id">
                                <option  hidden selected></option>
                                </select>
                            <em style="color:red"  class="errors-category_id"></em >
                        </div>

                        <div  class="form-group col-md-8">
                            <label for="#"><b><i>Màu sản phẩm</i></b></label>
                            <input type="text" id="color" name="color" class="form-control" >
                            <em style="color:red"  class="errors-color"></em >
                        </div>

                        <div class="form-group col-md-4">
                            <label for="#"><b><i>Thuộc thương hiệu</i></b></label>
                            <select style="width:100%" class="form-control" name="brand_id" id="brand_id">
                                <option  hidden selected></option>
                            </select>
                            <em style="color:red"  class="errors-brand_id"></em >
                        </div>

                        <div class="form-group col-md-12">
                            <label for="#"><b><i>Giá sản phẩm</i></b></label>
                            <input type="text" id="price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" name="price" class="form-control" >
                            <em style="color:red"  class="errors-price"></em >
                        </div>

                        <div  class="form-group col-md-12">
                            <label for="#"><b><i>Phong cách</i></b></label>
                            <input type="text" id="style" class="form-control" >
                            <em style="color:red"  class="errors-style"></em >
                        </div>

                        
                        <div  class="form-group col-md-12">
                            <label for="#"><b><i>Size</i></b></label>
                            <input type="text" id="size" class="form-control" >
                            <em style="color:red"  class="errors-size"></em >
                        </div>

                         
                        <div  class="form-group col-md-12">
                            <label for="#"><b><i>Xuất xứ</i></b></label>
                            <input type="text" id="origin" class="form-control" >
                            <em style="color:red"  class="errors-origin"></em >
                        </div>

                        <div class="form-group col-md-12">
                            <label for="#"><b><i>Mô tả</i></b></label>
                            <textarea name="desc" class="form-control" value="" cols="30" rows="10" id="desc" ></textarea>
                            <em style="color:red" class="errors-desc"></em >
                        </div>
                      
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                <a href="javascript:;" class="btn btn-info" onclick="product.save()"  >Lưu</a>
            </div>
        </div>
    </div>
</div>
