<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //作りたいテーブル等を作成
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', 11); //increments INT型でオートインクリメントでPKになる
            $table->string('username', 255); //string 文字数指定のvarchar型
            $table->unique('mail', 255); //string 文字数指定のvarchar型
            $table->string('password', 255); //string 文字数指定のvarchar型
            $table->string('bio', 400)->nullable(); //string 文字数指定のvarchar型 nullがYES
            $table->string('images', 255); //string 文字数指定のvarchar型
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
        // usersテーブルを削除をするという命令
        Schema::drop('users');
    }
}
