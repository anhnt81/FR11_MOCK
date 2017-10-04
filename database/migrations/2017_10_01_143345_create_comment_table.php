<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uid');
            $table->unsignedInteger('pid');
            $table->string('content');
            $table->integer('status');
            $table->float('rate');
            $table->timestamps();
            $table->foreign('uid')->references('id')->on('tb_user')->onDelete('cascade');
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
        Schema::dropIfExists('tb_comment');
    }
}
