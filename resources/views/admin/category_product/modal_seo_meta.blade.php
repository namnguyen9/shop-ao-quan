<!-- Modal -->
<div class="modal fade" id="SeoMetaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="text-align: center">Thêm Seo Meta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form >
                <input type="hidden" id="seo-Id" name="seo-Id" value="0">
                <input type="hidden" id="cate-Id" name="cate-Id" value="0">
                <div class="row">
                    <div id = "div_name" class="form-group col-md-12">
                        <label for="#"><b><i>Từ khóa</i></b></label>
                        <input type="text" id="meta_keywords" name="meta_keywords" class="form-control" >
                        <em style="color:red" class="errors-meta_keywords"></em>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="#"><b><i>Mô tả</i></b></label>
                        <textarea name="category_meta_desc" class="form-control"  cols="30" rows="10" id="category_meta_desc" ></textarea>
                        <em style="color:red" class="errors-meta_desc"></em>
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          <a href="javascript:;" onclick="category_product.save_SeoMeta()" class="btn btn-primary">Lưu</a>
        </div>
      </div>
    </div>
  </div>