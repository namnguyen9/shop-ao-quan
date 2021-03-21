<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoMetaCategory;

class SeoMetaCategoryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $seo_meta_category = new SeoMetaCategory();
        $seo_meta_category->id =  1;
        $seo_meta_category->meta_keywords = "Áo Khoác";
        $seo_meta_category->meta_desc = "Cập nhật xu hướng Áo khoác đẹp nhất hiện nay. Các loại áo khoác jean, áo khoác dù, áo khoác kaki, áo khoác đôi luôn được nhiều bạn trẻ đón nhận.";
        $seo_meta_category->category_id = 3;
        $seo_meta_category->save();

        
        $seo_meta_category = new SeoMetaCategory();
        $seo_meta_category->id =  2;
        $seo_meta_category->meta_keywords = "Quần Áo Nam";
        $seo_meta_category->meta_desc = "Shopping các mẫu quần áo nam từ thời trang CANIFA để phái mạnh tự tin với diện mạo mới của mình. ✓ Bền đẹp ✓ Tốt cho da ✓ Ship toàn quốc.";
        $seo_meta_category->category_id = 1;
        $seo_meta_category->save();

        
        $seo_meta_category = new SeoMetaCategory();
        $seo_meta_category->id =  3;
        $seo_meta_category->meta_keywords = "Quần Áo Nữ";
        $seo_meta_category->meta_desc = "Mua quần áo nữ giao tận nơi và tham khảo thêm nhiều sản phẩm khác. Miễn phí vận chuyển toàn quốc cho mọi đơn hàng . Đổi trả dễ dàng. Thanh toán bảo ...";
        $seo_meta_category->category_id = 2;
        $seo_meta_category->save();

        
        $seo_meta_category = new SeoMetaCategory();
        $seo_meta_category->id =  4;
        $seo_meta_category->meta_keywords = "Quần Áo thẻ Thao";
        $seo_meta_category->meta_desc = "Rất Nhiều Mẫu Bộ Quần Áo Thể Thao Nam Adidas, Nike Cao Cấp - Chính Hãng ✓ Nhiều Người Tin Dùng ✓ Giá Rẻ Khuyến Mãi ✓ Ship Cod Tận Nơi ✓ Mọi ...";
        $seo_meta_category->category_id = 4;
        $seo_meta_category->save();
        //
    }
}
