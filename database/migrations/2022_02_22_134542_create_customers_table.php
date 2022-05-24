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
            $table->string('company_name')->nullable();
            $table->string('credit_limit')->nullable();
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
            $table->string('gst_no_third_img')->nullable();
            $table->string('sales_persone_id');
            $table->bigInteger('balance_amount')->nullable();
            //$table->bigInteger('total_fund')->nullable();
            $table->decimal('total_fund', 10, 2)->nullable();
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
