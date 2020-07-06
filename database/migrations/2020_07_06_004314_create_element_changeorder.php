<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementChangeorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_changeorder', function (Blueprint $table) {
            $table->integer('changeorder_id')->unsigned();
            $table->integer('element_id')->unsigned();
            $table->foreign('changeorder_id')->references('id')->on('changeorders')->onDelete('cascade');
            $table->foreign('element_id')->references('id')->on('elements')->onDelete('cascade');
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
        //
    }
}
