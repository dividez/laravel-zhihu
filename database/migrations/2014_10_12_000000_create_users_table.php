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
            $table->increments('id')->comment('user table');
            $table->string('name')->unique()->comment('user name');
            $table->string('email')->unique()->comment('user email');
            $table->string('password')->comment('user password');
            $table->string('avatar')->comment('user avatar');
            $table->string('confirmation_token')->comment('user 激活用的token');
            $table->smallInteger('is_active')->default(0)->comment('user 是否激活');
            $table->integer('questions_count')->default(0)->comment('user 提问数量');
            $table->integer('answers_count')->default(0)->comment('user 回答数量');
            $table->integer('comments_count')->default(0)->comment('user 留下的评论数量');
            $table->integer('favorites_count')->default(0)->comment('user 收藏数量');
            $table->integer('likes_count')->default(0)->comment('user 点赞数量');
            $table->integer('followers_count')->default(0)->comment('user 关注数量');
            $table->integer('followerings_count')->default(0)->comment('user 被关注数量');
            $table->json('settings')->nullabel();
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
