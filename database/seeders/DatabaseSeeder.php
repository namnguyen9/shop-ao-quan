<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
      $this->call([
        AdminTableSeeder::class,
        // CategoryTableSeeder::class,
        // BrandTableSeeder::class,
        // ProductTableSeeder::class,
        Provinces_and_citiesTableSeeder::class,
        DistrictTableSeeder::class,
        // SeoMetaBrandTable::class,
        // SeoMetaCategoryTable::class
      ]);
        
    }
}
