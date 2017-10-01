<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_product', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cid');
            $table->unsignedInteger('bid');
            $table->string('name');
            $table->string('description');
            $table->string('images');
            $table->integer('qty');
            $table->double('price');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('cid')->references('id')->on('tb_category')->onDelete('cascade');
            $table->foreign('bid')->references('id')->on('tb_brand')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_product');
    }
}
