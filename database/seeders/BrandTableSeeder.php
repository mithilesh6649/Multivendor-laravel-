<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Brand::truncate();
          $BrandsRecords = [
            ['id'=>1 ,'name'=>'Arrow','status'=>1],
            ['id'=>2 ,'name'=>'Gap','status'=>1],
            ['id'=>3 ,'name'=>'Lee','status'=>1],
            ['id'=>4 ,'name'=>'Samsung','status'=>1],
            ['id'=>5 ,'name'=>'LG','status'=>1],
            ['id'=>6 ,'name'=>'Lenovo','status'=>1],
            ['id'=>7 ,'name'=>'MI','status'=>1],

         ];

         Brand::insert($BrandsRecords);
    }
}
