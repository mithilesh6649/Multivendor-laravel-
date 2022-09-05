<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->mediumText('address',250)->nullable();
            $table->string('city',85)->nullable(); 
            $table->string('state',85)->nullable();
            $table->string('country',85)->nullable();
            $table->string('pincode',85)->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->integer('country_code')->nullable();
            $table->string('email',85)->unique()->nullable();
            $table->tinyInteger('status')->nullable();     
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
        Schema::dropIfExists('vendors');
    }
}
