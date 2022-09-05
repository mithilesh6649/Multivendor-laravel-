<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;
use Carbon\Carbon;


class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             // VendorsBankDetail::truncate();
        $vendorBankRecords = [
          ['id'=>1 , 'vendor_id'=>1, 'account_holder_name'=>'John','bank_name'=>'UCO Bank','account_number'=>'1400600450646678','bank_ifsc_code'=>'UCBN0045','created_at'=>Carbon::now(),'updated_at'=>Carbon::now(), ] 
        ];

        VendorsBankDetail::insert($vendorBankRecords);
    }
}
