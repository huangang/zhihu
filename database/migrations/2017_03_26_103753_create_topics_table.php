<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id')->comment('话题id');
            $table->string('name')->comment('话题名');
            $table->text('bio')->nullable()->comment('话题简介');
            $table->integer('questions_count')->default(0)->comment('问题数量');
            $table->integer('followers_count')->default(0)->comment('关注者数量');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
