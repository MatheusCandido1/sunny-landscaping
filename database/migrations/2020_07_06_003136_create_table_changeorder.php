<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChangeorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->float('discount');
            $table->float('subtotal');
            $table->float('original_contract_amount');
            $table->float('change_order_amount');
            $table->float('revised_contract_amount');
            $table->boolean('status');
            $table->integer('visit_id')->unsigned();
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
        Schema::dropIfExists('change_orders');

    }
}
