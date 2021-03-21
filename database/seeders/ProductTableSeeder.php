<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->id = 1;
        $product->name = 'Áo khoác nhẹ';
        $product->desc = "Sản phẩm đến từ thương hiệu rất nổi tiếng BAPE - Mang hoạ tiết đặc trưng của Bape là hoạ tiết Camo rất đẹp- Sản phẩm có 2 màu: Tím và Đen";
        $product->size = "M";
        $product->origin = "Nhật Bản";
        $product->fabric_material = "Thun";
        $product->style = "Đẹp";
        $product->color = "Tím và đẹn";
        $product->price = "780000";
        $product->status = 1;
        $product->category_id  = 3;
        $product->brand_id = 3;
        $product->save();

        $product = new Product();
        $product->id = 2;
        $product->name = 'Áo Khoác Thể Thao Nike Thời Trang 2020 Cho Nữ';
        $product->desc = "Hoan nghênh các Nhà bán lẻ / Bán sỉ đến đàm phán.Chúng tôi sẽ cung cấp những sản phẩm chất lượng nhất * ^ ____ ^ *【Thông tin chi tiết sản phẩm】Chất liệu: CottonLoại sản phẩm: Áo khoác ngoài Kích thước: Liên hệ với chúng tôi hoặc xem bảng kích thướcThích hợp cho: Người lớn📏Kích thước được đo lường thủ công, xin vui lòng cho phép sai số 1-3 cm!";
        $product->size = "S,M,L";
        $product->origin = "chưa rõ";
        $product->fabric_material = "Thun";
        $product->style = "cá tính";
        $product->color = "Đen";
        $product->price = "880000";
        $product->status = 1;
        $product->category_id  = 1;
        $product->brand_id = 4;
        $product->save();

        
        $product = new Product();
        $product->id = 3;
        $product->name = 'NIKE Áo Nỉ Nữ Dài Tay Cổ Tròn Thời Trang Hàn';
        $product->desc = "Welcome Retailer / Wholesales come to negotiate.We will provide the best quality products * ^ ____ ^ *【Product Details】Material: CottonType: OuterwearSize: Contact us or view the size chartApplicable : Adults📏Measure the size manually, please allow an error of 1-3 cm!";
        $product->size = "S,M,L";
        $product->origin = "chưa rõ";
        $product->fabric_material = "Thun";
        $product->style = "cá tính";
        $product->color = "Đen";
        $product->price = "424200";
        $product->status = 1;
        $product->category_id  = 2;
        $product->brand_id = 4;
        $product->save();

          
        $product = new Product();
        $product->id = 4;
        $product->name = 'LEGGING JEAN GUCCI';
        $product->desc = "💎 LEGGING JEAN LƯNG MÀU về hàng 😘
        🔥 Đẹp lung linh không cần đi thả thính, giá lại giật mình 😆. 
        🍉 150k/ 1 cái, mua 2c Freeship nội thành Sài Gòn
        🍉 2 màu: ĐEN - XANH ĐEN
        🍉 Size: M: 38-45kg, L: 45-52kg, Xl: 52-60kg, 2Xl: 60-68kg, 3Xl: 68-72kg
        🎁Cực hót khi #MUA_5_TẶNG_1 ❤ mua càng nhiều giá càng ưu đãi 👏👏";
        $product->size = "S,M,L";
        $product->origin = "chưa rõ";
        $product->fabric_material = "Thun";
        $product->style = "Quần leggings";
        $product->color = "Đen";
        $product->price = "150000";
        $product->status = 1;
        $product->category_id  = 1;
        $product->brand_id = 3;
        $product->save();

            
        $product = new Product();
        $product->id = 5;
        $product->name = 'Quần Áo Thể Thao Tay Dài Adidas';
        $product->desc = "Quý khách vui lòng nhắn tin cho shop trong vòng 1 ngày sau khi nhận được hàng để được hỗ trợ trong trường hợp cần xuất hóa đơn đỏ (VAT) cho sản phẩm đã mua tại Shopee.
        Quá thời gian nhận được hàng đã nêu, shop xin được phép không hỗ trợ dù trong bất kỳ trường hợp nào.
        Mẫu quần thể thao này được may bằng vải jersey co giãn trong một phong cách thanh thoát và đơn giản. Quần được trau chuốt với phong cách hiện đại nhờ các dải logo quấn quanh ống quần. Kiểu dáng ôm sát đem lại vẻ ngoài thanh thoát hiện đại.
        - Kiểu dáng ôm sát ở hông và đùi, ống đứng
        - Gấu bo co giãn
        - Vải jersey dệt đơn làm từ 88% polyester và 12% elastane";
        $product->size = "S,M,L";
        $product->origin = "chưa rõ";
        $product->fabric_material = "Thun";
        $product->style = "Quần leggings";
        $product->color = "Đen";
        $product->price = "1300000";
        $product->status = 1;
        $product->category_id  = 4;
        $product->brand_id = 1;
        $product->save();

              
        $product = new Product();
        $product->id = 6;
        $product->name = 'Áo Phông Bape Graphic Print T-Shirt Màu Đen';
        $product->desc = "Áo Phông Bape Graphic Print T-Shirt Màu Đen được làm bằng chất liệu cotton cao cấp, không bị bai, xù,giãn, thấm hút mồ hôi tốt cho những hoạt động thể thao ngoài trời.
        Áo cổ tròn, tay ngắn với họa tiết phía trước bắt mắt tạo điểm nhấn nổi bật. 
        Form áo chuẩn đẹp từng đường kim mũi chỉ làm hài lòng ngay cả với khách hàng khó tính.
        Với nhiều áo phông thời trang này bạn có thể kết hợp với nhiều trang phục khác nhau theo sở thích của bản thân. Mang lại phong cách trẻ trung, năng động, tự tin khi dạo phố, đi chơi, gặp gỡ bạn bè...
        Không có bất cứ nghi ngờ nào nếu nói Bape là một trong những thương hiệu trào lưu nổi trội hiện tại, luôn kề vai sát cánh cùng Supreme là 1 trong những thương hiệu phong cách “đường phố” nổi tiếng.";
        $product->size = "S,M,L";
        $product->origin = "Nhật Bản";
        $product->fabric_material = "Cotton";
        $product->style = "Hiện đại, trẻ trung";
        $product->color = "Đen";
        $product->price = "3250000";
        $product->status = 1;
        $product->category_id  = 1;
        $product->brand_id = 2;
        $product->save();

               
        $product = new Product();
        $product->id = 7;
        $product->name = 'Áo Polo Gucci Ss2020 Màu Đen Size M';
        $product->desc = "Áo Polo Gucci Ss2020 Màu Đen được thiết kế cổ bẻ, tay ngắn, có họa tiết GG ở vai áo đặc trưng của Gucci tạo nên sự năng động, trẻ trung cho người mặc nhưng cũng không kém phần lịch lãm, sang trọng.";
        $product->size = "S,M,L";
        $product->origin = "Nhật Bản";
        $product->fabric_material = "Cotton";
        $product->style = "Hiện đại, trẻ trung";
        $product->color = "Đen";
        $product->price = "15490000";
        $product->status = 1;
        $product->category_id  = 1;
        $product->brand_id = 3;
        $product->save();
                 
        $product = new Product();
        $product->id = 8;
        $product->name = 'TENNIS ÁO POLO TENNIS TOP SOLID HEAT.RDY Nam Màu đen FT6765';
        $product->desc = "Quý khách vui lòng nhắn tin cho shop trong vòng 1 ngày sau khi nhận được hàng để được hỗ trợ trong trường hợp cần xuất hóa đơn đỏ (VAT) cho sản phẩm đã mua tại Shopee.
        Quá thời gian nhận được hàng đã nêu, shop xin được phép không hỗ trợ dù trong bất kỳ trường hợp nào.
        Nắng nóng oi ả giữa trưa dội xuống mặt sân bê tông. Nhưng bạn không vì vậy mà dọn đồ đi về. Vì thế adidas đã tạo ra chiếc áo polo tennis này. Chất vải mềm mại, thoáng mát giúp bạn tiếp tục với niềm đam mê của mình. Thiết kế dành riêng cho môn tennis tăng thêm độ rộng ở vai để bạn thoải mái thực hiện mọi cú đánh.
        - Ôm vừa
        - Cổ polo ba khuy có gân sọc
        - Công nghệ HEAT.RDY mát mẻ, thoáng khí
        - Áo polo tennis mặc trên sân
        - Đường xẻ hai bên
        - Thiết kế hỗ trợ chuyển động đặc trưng của bộ môn tennis.";
        $product->size = "S,M,L";
        $product->origin = "Nhật Bản";
        $product->fabric_material = "Cotton";
        $product->style = "Hiện đại, trẻ trung";
        $product->color = "Đen";
        $product->price = "1200000";
        $product->status = 1;
        $product->category_id  = 4;
        $product->brand_id = 1;
        $product->save();

                   
        $product = new Product();
        $product->id = 9;
        $product->name = 'adidas NOT SPORTS SPECIFIC Áo phông Verbiage Nam Màu trắng ';
        $product->desc = "Quý khách vui lòng nhắn tin cho shop trong vòng 1 ngày sau khi nhận được hàng để được hỗ trợ trong trường hợp cần xuất hóa đơn đỏ (VAT) cho sản phẩm đã mua tại Shopee.
        Quá thời gian nhận được hàng đã nêu, shop xin được phép không hỗ trợ dù trong bất kỳ trường hợp nào.
        Họa tiết góc cạnh và phông chữ ngoại cỡ cho chiếc áo phông này vẻ ngoài ấn tượng, đột phá. Cổ tròn có gân tăng cường độ bền và tạo chút sần mềm mại. Chất vải jersey cotton mềm mại cho cảm giác êm ái, thoải mái.
        - Kiểu dáng ôm vừa dễ mặc hàng ngày
        - Cổ tròn có gân
        - Cộc tay
        - Vải jersey một mặt phải làm từ 100% cotton";
        $product->size = "S,M,L";
        $product->origin = "Nhật Bản";
        $product->fabric_material = "Cotton";
        $product->style = "Hiện đại, trẻ trung";
        $product->color = "Đen";
        $product->price = "750000";
        $product->status = 1;
        $product->category_id  = 4;
        $product->brand_id = 1;
        $product->save();

                        
        $product = new Product();
        $product->id = 10;
        $product->name = 'Áo Phông Bape Shark Print T-Shirt M11005XDBKC Màu Đen';
        $product->desc = "Áo Phông Bape Shark Print T-Shirt M11005XDBKC Màu Đen được làm từ chất vải 100% cotton thoáng mát, thấm hút mồ hôi hiệu quả.
        Họa tiết in hình con cá làm điểm nhấn độc - lạ so với những chiếc áo phông thông thường. Áo thiết kế cổ tròn, tay ngắn năng động, trẻ trung giúp bạn có thể dễ dàng kết hợp với các trang phục khác nhau.
        Đường may của áo vô cùng tinh tế và tỉ mỉ từng chi tiết, làm hài lòng ngay cả với khách hàng khó tính. 
        Mặc chiếc áo phông Bape với quần jean và giày thể thao cho bạn một phong cách năng động, thoải mái, tự tin trên đường phố. Áo phù hợp mặc trong nhiều hoàn cảnh khác nhau.";
        $product->size = "S,M,L";
        $product->origin = "Nhật Bản";
        $product->fabric_material = "Cotton";
        $product->style = "Hiện đại, trẻ trung";
        $product->color = "Đen";
        $product->price = "3250000";
        $product->status = 1;
        $product->category_id  = 1;
        $product->brand_id = 2;
        $product->save();
    }
}
