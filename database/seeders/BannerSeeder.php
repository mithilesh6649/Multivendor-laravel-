<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannderRecords = [
        ['id'=>1,'image'=>'banner_1.png','link'=>'spring-collection','title'=>'Spring Collection','alt'=>'Spring Collection','status'=>1],
        ['id'=>2,'image'=>'banner_2.png','link'=>'tops','title'=>'Tops Collection','alt'=>'Tops Collection','status'=>1]
        ];
    }
}
