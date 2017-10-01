<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_view', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pid');
            $table->date('date');
            $table->integer('view');
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
        Schema::dropIfExists('tb_view');
    }
}
