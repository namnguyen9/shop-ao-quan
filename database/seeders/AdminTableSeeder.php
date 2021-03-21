<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new Admin();
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('8888');
        $admin->name = 'Nguyễn Thanh Nam';
        $admin->phone = '0366240143';
        $admin->save();

    }
}
