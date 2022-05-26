<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //作りたいテーブル等を作成
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id', 11); //increments INT型でオートインクリメントでPKになる
            $table->foreign('user_id', 11)->references('id')->on('users'); // 外部キー
            $table->string('post', 400); //string 文字数指定のvarchar型
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // postsテーブルを削除をするという命令
        Schema::drop('posts');
    }
}
