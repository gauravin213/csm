<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('mobile');
            $table->string('email');
            $table->string('profile_image')->nullable();
            $table->string('pan_no');
            $table->string('pan_no_front_img')->nullable();
            $table->string('pan_no_back_img')->nullable();
            $table->string('aadhar_no');
            $table->string('aadhar_no_front_img')->nullable();
            $table->string('aadhar_no_back_img')->nullable();
            $table->string('gst_no');
            $table->string('gst_no_front_img')->nullable();
            $table->string('gst_no_back_img')->nullable();
            $table->string('sales_persone_id');
            $table->bigInteger('balance_amount')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
