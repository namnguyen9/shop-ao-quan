<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

class Provinces_and_citiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('provinces_and_cities')->insert([
            'name' => 'An Giang'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bà Rịa - Vũng Tàu'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bắc Giang'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bắc Kạn'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bạc Liêu'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bắc Ninh'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bến Tre'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bình Định'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bình Dương'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bình Phước'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Bình Thuận'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Cà Mau'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Cao Bằng'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Đắk Lắk'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Đắk Nông'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Điện Biên'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Đồng Nai'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Đồng Tháp'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Gia Lai'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Hà Giang'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Hà Nam'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Hà Tĩnh'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Hải Dương'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Hậu Giang'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Hòa Bình'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Hưng Yên'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Khánh Hòa'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Kiên Giang'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Kon Tum' 
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Lai Châu'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Lâm Đồng'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Lạng Sơn'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Lào Cai'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Long An'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Nam Định'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Nghệ An'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Ninh Bình'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Ninh Thuận'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Phú Thọ'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Quảng Bình'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Quảng Nam'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Quảng Ngãi'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Quảng Ninh'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Quảng Trị'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Sóc Trăng'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Sơn La'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Tây Ninh'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Thái Bình'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Thái Nguyên'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Thanh Hóa'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Thừa Thiên Huế',
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Tiền Giang'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Trà Vinh'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Tuyên Quang'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Vĩnh Long'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Vĩnh Phúc'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Yên Bái'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Phú Yên'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Cần Thơ'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Đà Nẵng'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Hải Phòng'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'Hà Nội'
        ]);
        DB::table('provinces_and_cities')->insert([
            'name' => 'TP HCM'
        ]);
    }
}