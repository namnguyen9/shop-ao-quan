<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->id = 1;
        $category->name = 'Đồ Nam';
        $category->desc = "Đẹp";
        $category->status = 1;
        $category->save();

        $category = new Category();
        $category->id= 2;
        $category->name = 'Đồ Nữ';
        $category->desc= "Đẹp";
        $category->status = 1;
        $category->save();

        $category = new Category();
        $category->id = 3;
        $category->name = 'Áo Khoác';
        $category->desc= "Đẹp";
        $category->status = 1;
        $category->save();

        $category = new Category();
        $category->id = 4;
        $category->name = 'Đồ thể thao';
        $category->desc= "Đẹp";
        $category->status = 1;
        $category->save();
    }
}
