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
                <form id="Form">
                    <input type="hidden" id="category_productId" name="category_productId" value="0">
                    <div class="row">
                        <div id = "div_name" class="form-group col-md-8">
                            <label for="#"><b><i>Tên danh mục</i></b></label>
                            <input type="text" id="category_name" name="category_name" class="form-control" >
                            <em style="color:red"  class="errors-name"></em >
                        </div>

                        <div id="div_status" class="form-group col-md-4">
                            <label for="#"><b><i>Trạng thái</i></b></label>
                            <select  style="width:100%" class="js-example-basic-single js-states form-control"  id="category_status" name="category_status" >      
                                    <option selected  id="category_status"></option>
                                    <option value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                            </select>
                            <em style="color:red" class="errors-status"></em>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="#"><b><i>Mô tả</i></b></label>
                            <textarea name="category_desc" class="form-control"  cols="30" rows="10" id="category_desc" ></textarea>
                            <em style="color:red" class="errors-desc"></em >
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                <a href="javascript:;" class="btn btn-info" id="add" onclick="category_product.save()">Lưu</a>
            </div>
        </div>
    </div>
</div>