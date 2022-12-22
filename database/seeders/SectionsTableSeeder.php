<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $sectionsRecords = [
            ['id'=>1 ,'name'=>'Clothing','status'=>1],
            ['id'=>2 ,'name'=>'Electronics','status'=>1],
            ['id'=>3 ,'name'=>'Appliances','status'=>1],
         ];

         Section::insert($sectionsRecords);
    }
}
