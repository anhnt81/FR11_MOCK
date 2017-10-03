<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cid');
            $table->double('total');
            $table->string('note')->nullable();
            $table->integer('status');
            $table->timestamps();
            $table->foreign('cid')->references('id')->on('tb_customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_bills');
    }
}
