<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use Carbon\Carbon;
class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             // Vendor::truncate();
        $vendorRecords = [
          ['id'=>1 , 'name'=>'John' , 'address'=>'Gayatri nagar near lal gunj','city'=>'Gorakhpur','state'=>'Uttar Pardesh','country'=>'India','pincode'=>'27008','mobile' => '9875674564','country_code'=>'91' ,'email' =>'vendor@vendor.com' ,'status' =>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now(), ] 
        ];

        Vendor::insert($vendorRecords);
    }
}
