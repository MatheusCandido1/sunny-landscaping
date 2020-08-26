<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_key');
            $table->float('discount');
            $table->float('total');
            $table->float('subtotal');
            $table->float('accepting_proposal');
            $table->float('down_payment');
            $table->boolean('status');
            $table->float('final_balance');
            $table->text('notes');
            $table->date('approved_on')->nullable();
            $table->date('not_approved_on')->nullable();
            $table->date('sent_proposal_on')->nullable();
            $table->date('waiting_on')->nullable();
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
        Schema::dropIfExists('services');
    }
}
