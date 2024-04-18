<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;//「Carbon::now()」を使用する為の記述

class violationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //runの中身がシーディング時に行われる内容
        DB::table('violations')->insert([
            'user_id' => 1,
            'post_id' => 1,
            'comment' => 'コメント１', 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
