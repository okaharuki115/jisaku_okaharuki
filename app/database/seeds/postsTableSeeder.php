<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;//「Carbon::now()」を使用する為の記述

class postsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //runの中身がシーディング時に行われる内容
        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'タイトル１',
            'amount' => 100,
            'content' => '内容１', 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
