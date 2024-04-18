<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;//「Carbon::now()」を使用する為の記述

class likesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //runの中身がシーディング時に行われる内容
        DB::table('likes')->insert([
            'user_id' => 1,
            'post_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
