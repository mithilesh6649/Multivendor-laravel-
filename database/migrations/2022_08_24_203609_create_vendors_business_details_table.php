<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsBusinessDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors_business_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade')->onUpdate('cascade');
            $table->string('shop_name');
            $table->mediumText('shop_address');
            $table->string('shop_city');
            $table->string('shop_state');
            $table->string('shop_country');
            $table->string('shop_pincode');
            $table->string('shop_mobile');
            $table->string('shop_website')->nullable();
            $table->string('shop_email')->nullable();;
            $table->string('address_proof');
            $table->string('address_proof_image');
            $table->string('business_license_number')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_business_details');
    }
}
