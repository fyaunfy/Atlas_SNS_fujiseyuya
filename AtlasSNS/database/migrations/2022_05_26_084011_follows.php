<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Follows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //作りたいテーブル等を作成
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id', 11); //increments INT型でオートインクリメントでPKになる
            $table->integer('following_id', 11);
            $table->integer('followed_id', 11);
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
        // followsテーブルを削除をするという命令
        Schema::drop('follows');
    }
}
