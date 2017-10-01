<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_slide', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pid');
            $table->integer('ordinal');
            $table->timestamps();
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
        Schema::dropIfExists('tb_slide');
    }
}
