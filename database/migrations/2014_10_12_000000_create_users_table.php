<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('用户id');
            $table->string('name')->unique()->comment('用户名');
            $table->string('email')->unique()->comment('电子邮件');
            $table->string('password')->comment('密码');
            $table->string('avatar')->comment('头像');
            $table->string('confirmation_token')->comment('确认token');
            $table->smallInteger('is_active')->default(0)->comment('是否激活');
            $table->integer('questions_count')->default(0)->comment('问题次数');
            $table->integer('answers_count')->default(0)->comment('回答次数');
            $table->integer('comments_count')->default(0)->comment('评论次数');
            $table->integer('favorites_count')->default(0)->comment('喜欢次数');
            $table->integer('likes_count')->default(0)->comment('被点赞次数');
            $table->integer('followers_count')->default(0)->comment('被关注次数');
            $table->integer('followings_count')->default(0)->comment('关注次数');
            $table->json('settings')->nullable()->comment('设置');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
