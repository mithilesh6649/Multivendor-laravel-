<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $categoryRecords = [
          ['id'=>1 , 'parent_id'=>0 , 'section_id'=>1 ,'category_name' =>'Men','category_image' => '','category_discount'=>0 ,'description' =>'','url'=>'men ','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status' =>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now(),],

          ['id'=>2 , 'parent_id'=>0 , 'section_id'=>1 ,'category_name' =>'Women','category_image' => '','category_discount'=>0 ,'description' =>'','url'=>'women ','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status' =>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now(),],

          ['id'=>3 , 'parent_id'=>0 , 'section_id'=>1 ,'category_name' =>'Kids','category_image' => '','category_discount'=>0 ,'description' =>'','url'=>'kids ','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status' =>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now(),],
           
        ];

        Category::insert($categoryRecords);
    }
}
