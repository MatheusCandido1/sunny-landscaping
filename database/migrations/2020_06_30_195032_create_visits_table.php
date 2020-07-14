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
            $table->dateTime('date');
            $table->integer('call_customer_in')->nullable();
            $table->boolean('hoa')->nullable();
            $table->boolean('water_smart_rebate')->nullable();
            $table->string('invoice_number')->nullalbe();
            $table->string('payment_amout')->nullalbe();
            $table->date('contract_date')->nullalbe();
            $table->date('board_date')->nullalbe();
            $table->date('waiver_date')->nullalbe();
            $table->date('proposal_date')->nullalbe();
            $table->string('project_name')->nullalbe();
            $table->string('parties')->nullalbe();
            $table->boolean('has_services');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
