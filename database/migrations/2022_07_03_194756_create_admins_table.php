<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
             $table->id();
             $table->string('name','85')->nullable();
             $table->string('type','10')->nullable();
             $table->integer('vendor_id')->nullable();
            // $table->foreignId('vender_id')->nullable()->constrained('vendors')->onDelete('cascade')->onUpdate('cascade');
             $table->bigInteger('mobile')->nullable();
             $table->integer('country_code')->nullable();
             $table->string('email',85)->unique()->nullable();
             $table->string('password',85)->nullable();
             $table->string('image',100)->nullable();  
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
        Schema::dropIfExists('admins');
    }
}
