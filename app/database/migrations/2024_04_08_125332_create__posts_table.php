<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            //↓ここにPostテーブルに必要なカラムを追加する
            $table->bigIncrements('id');//AUTO_INCREMENT
            $table->integer('user_id');
            $table->string('title',100);
            $table->integer('amount');
            $table->string('content',500);
            $table->string('image',100)->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();//←このtimestampsだけでcreated_atもupdated_atも含まれてるしnullが許容される状態になってる
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Posts');
    }
}

