<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('gender');
            $table->string('address');
            $table->string('cross_street1')->nullable();
            $table->string('cross_street2')->nullable();
            $table->string('gate_code')->nullable();
            $table->string('state');
            $table->string('zipcode')->nullable();
            $table->string('phone');
            $table->boolean('cellphone');
            $table->string('email')->unique();;
            $table->string('parcel_number');
            $table->boolean('company');
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_zipcode')->nullable();
            $table->integer('referral_id')->unsigned();
            $table->foreign('referral_id')->references('id')->on('referrals')->onDelete('cascade');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
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
