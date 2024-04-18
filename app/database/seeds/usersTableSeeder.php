<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;//「Carbon::now()」を使用する為の記述

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //runの中身がシーディング時に行われる内容
        DB::table('users')->insert([
            'name' => 'おか',
            'email' => 'test1`gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password(ハッシュ化された文字列を使用する(じゃないとログインできない))
            'created_at' => Carbon::now(),//Carbonというライブラリを使用して現在の日時を入れる
            'updated_at' => Carbon::now(),
        ]);
    }
}
