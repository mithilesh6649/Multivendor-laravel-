<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
         $this->call(VendorsTableSeeder::class);
        $this->call(VendorsBusinessDetailsTableSeeder::class);    
        $this->call(VendorsBankDetailsTableSeeder::class);    
    }
}
