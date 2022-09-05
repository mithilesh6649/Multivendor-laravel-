<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Carbon\Carbon;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        $adminRecords = [
          ['id'=>1 , 'name'=>'Super Admin' , 'type'=>'superadmin' ,'vendor_id' => 0,'mobile' => '9875674564','country_code'=>'91' ,'email' =>'admin@admin.com','password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','image'=>'','status' =>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now(),  ],
           ['id'=>2 , 'name'=>'John' , 'type'=>'vendor' ,'vendor_id' => 1,'mobile' => '9875674564','country_code'=>'91' ,'email' =>'vendor@vendor.com','password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','image'=>'','status' =>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now(),  ] 
        ];

        Admin::insert($adminRecords);
    }
}
