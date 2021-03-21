<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = new Brand();
        $brand->id =  1;
        $brand->name = "Adidas";
        $brand->desc = "Đẹp";
        $brand->status =1;
        $brand->save();

        $brand = new Brand();
        $brand->id = 2;
        $brand->name = "Bape";
        $brand->desc = "Đẹp";
        $brand->status =1;
        $brand->save();

        $brand = new Brand();
        $brand->id = 3;
        $brand->name = "Gucci";
        $brand->desc = "Đẹp";
        $brand->status =1;
        $brand->save();

        $brand = new Brand();
        $brand->id = 4;
        $brand->name = "Nike";
        $brand->desc = "Đẹp";
        $brand->status =1;
        $brand->save();

    }
}
