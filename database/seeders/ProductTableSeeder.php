<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Product::truncate();
        $ProductRecords = [
               ['id'=>1,'section_id' =>2,'category_id' =>5,'brand_id' =>7,'vendor_id' =>1,'admin_id' =>2,'admin_type' =>'vendor','product_name' =>'Redmi Note 11','product_code' =>'RN11','product_color' =>'Blue','product_price' =>15000,'product_discount' =>10,'product_weight' =>500,'product_image' =>'','product_video' =>'','description' =>'','meta_title' =>'','meta_description' =>'','meta_keywords' =>'','is_featured' =>'Yes','status' =>1] ,

               ['id'=>2,'section_id' =>1,'category_id' =>6,'brand_id' =>2,'vendor_id' =>0,'admin_id' =>1,'admin_type' =>'superadmin','product_name' =>'Red Casual T-shirt','product_code' =>'RC001','product_color' =>'Blue','product_price' =>15000,'product_discount' =>10,'product_weight' =>500,'product_image' =>'','product_video' =>'','description' =>'','meta_title' =>'','meta_description' =>'','meta_keywords' =>'','is_featured' =>'Yes','status' =>1] 
        
        ];

        Product::insert($ProductRecords);
    }
}
