<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostumerVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costumer_visit', function (Blueprint $table) {
            $table->integer('costumer_id');
            $table->integer('visit_id');
            $table->foreign('costumer_id')->references('id')->on('costumers')->onDelete('cascade');
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
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
        Schema::dropIfExists('costumer_visit');
    }
}
