<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //22.管理者画面を表示(管理者ログインをして、URLが「localhost/admin」になったとき)
    public function admin(){
       
        return view('admin',[
            
        ]);
    }
}
