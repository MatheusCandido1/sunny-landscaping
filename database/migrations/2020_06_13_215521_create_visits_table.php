<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('seller');
            $table->dateTime('date');
            $table->integer('call_costumer_in')->nullable();
            $table->boolean('hoa')->nullable();
            $table->boolean('water_smart_rebate')->nullable();
            $table->integer('costumer_id')->unsigned();
            $table->foreign('costumer_id')->references('id')->on('costumers')->onDelete('cascade');
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
        Schema::dropIfExists('visits');
    }
}
