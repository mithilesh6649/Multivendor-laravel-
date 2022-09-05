<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;
use Carbon\Carbon;


class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              // VendorsBusinessDetail::truncate();
        $vendorBusinessRecords = [
          ['id'=>1,'vendor_id'=>1 ,'shop_name'=>'John Electronics Store','shop_address'=>'Gayatri nagar near lal gunj','shop_city'=>'Gorakhpur','shop_state'=>'Uttar Pardesh','shop_country'=>'India','shop_pincode'=>'27008','shop_mobile' => '9875674564','shop_website' =>'null','shop_email' =>'john@admin.com','address_proof' =>'Passport','address_proof_image'=>'null','business_license_number' =>'JQFPRTY89','gst_number' =>'GJIJOIE54','pan_number' =>'OTJOT989KL','created_at'=>Carbon::now(),'updated_at'=>Carbon::now(), ] 
        ];

        VendorsBusinessDetail::insert($vendorBusinessRecords);
    }
}
