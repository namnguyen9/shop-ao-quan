<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoMetaBrand;

class SeoMetaBrandTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seo_meta_brand = new SeoMetaBrand();
       $seo_meta_brand->id =  1;
       $seo_meta_brand->meta_keywords = "Áo Quần Bape";
       $seo_meta_brand->meta_desc = "Mua bape giao tận nơi và tham khảo thêm nhiều sản phẩm khác. Miễn phí vận chuyển toàn quốc cho mọi đơn hàng . Đổi trả dễ dàng. Thanh toán bảo mật.";
       $seo_meta_brand->brand_id  = 2;
       $seo_meta_brand->save();

        $seo_meta_brand= new SeoMetaBrand();
       $seo_meta_brand->id =  2;
       $seo_meta_brand->meta_keywords = "Áo Quần Adidas";
       $seo_meta_brand->meta_desc = "Mẫu mã đa dạng phong phú với nguồn hàng quảng châu giá rẻ chuyên đổ sỉ cho các shop online. Uy tín , chất lượng, giá rẻ luôn mang lại sự tin tưởng cho khách với nguồn hàng giá rẻ.";
       $seo_meta_brand->brand_id  = 1;
       $seo_meta_brand->save();

        $seo_meta_brand= new SeoMetaBrand();
       $seo_meta_brand->id =  3;
       $seo_meta_brand->meta_keywords = "Áo Quần Gucci";
       $seo_meta_brand->meta_desc = "Thời trang Gucci cao cấp chính hãng Ý. Áo thiết kế đẹp đường may tỉ mỉ, chất liệu Cotton 100% thoải mái dễ chịu. Áo phông, áo thun sành điệu cá tính.";
       $seo_meta_brand->brand_id  = 3;
       $seo_meta_brand->save();

        $seo_meta_brand= new SeoMetaBrand();
       $seo_meta_brand->id =  4;
       $seo_meta_brand->meta_keywords = "Quần Áo Nike   ";
       $seo_meta_brand->meta_desc = "Mua online Áo Khoác Nike , Áo thun Nike , Nón - Mũ Nike @Cửa hàng trực tuyến Nike Việt Nam ✓ Mã giảm giá Nike Vietnam ✓ Đổi trả dễ dàng ✓ Thanh toán ...";
       $seo_meta_brand->brand_id  = 4;
       $seo_meta_brand->save();
    }
}
