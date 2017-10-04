<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('oid');
            $table->unsignedInteger('pid');
            $table->integer('qty');
            $table->double('total');
            $table->timestamps();
            $table->foreign('oid')->references('id')->on('tb_order')->onDelete('cascade');
            $table->foreign('pid')->references('id')->on('tb_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_bill_detail');
    }
}
