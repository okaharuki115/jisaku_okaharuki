<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;//use宣言

class RegistrationController extends Controller
{
        //新規投稿画面に飛ぶ
        public function newPost(){

            return view('fromFooter/newPost',[
            ]);
        }

        //public function newPost(Request $request){
        //     $User = new User;
        //     $User->name =$request->name;
        //     $User->email =$request->email;
        //     //ここにアイコン登録の記述書く
        //     $User->password =$request->password;
        //     $User->save();//インスタンスを保存することでDBへの登録を完了

        //     return redirect('/');//INSERT処理が完了したらリダイレクトを返す
        //}
}
