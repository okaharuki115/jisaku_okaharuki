<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;//「Carbon::now()」を使用する為の記述

class applicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //runの中身がシーディング時に行われる内容
        DB::table('applications')->insert([
            'user_id' => 1,
            'post_id' => 1,
            'content' => '内容１',
            'tel' => '08012345678',
            'email' => 'test1@gmail.com',
            'limit' => '2024-04-11', 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
