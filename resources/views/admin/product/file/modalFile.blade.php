  <!-- Modal create -->
  <div class="modal fade" id="modal-file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align: center" id="exampleModalLabel">Thêm hình ảnh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  enctype="multipart/form-data">
                    @csrf
                    <div  class="row">
                    <input type="hidden" id="product-Id" name="product-Id" >
                        <div id="upload"  class="form-group col-md-12">
                            <label for="#"><b><i>Hình ảnh</i></b></label>
                            <input type="file" id="images" hi name="file[]" onchange="product.loadFile()"  class="form-control" multiple >
                            <em style="color:red" id="errors-images" class="errors-images"></em >
                             <div>
                            <span id ='Image_preview'></span>
                            </div>
                            <label  style="text-align: center;color:red" hidden id="msg"><b><i>Nhấn vào ảnh để xóa</i></b></label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                <a href="javascript:;" class="btn btn-info" onclick="product.save_file()" >Lưu</a>
            </div>
        </div>
    </div>
</div>
