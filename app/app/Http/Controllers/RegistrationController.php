<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;//use宣言

class RegistrationController extends Controller
{
    //3.新規ユーザー登録画面へ
    public function userRegistration(){
        return view('register/userRegistration',[
        ]);
    }

        //新規ユーザー登録
        public function userRegistrationForm(Request $request){

            $User = new User;
            $User->name =$request->name;
            $User->email =$request->email;
            //ここにアイコン登録の記述書く
            $User->password =$request->password;
            $User->save();//インスタンスを保存することでDBへの登録を完了

            return redirect('/');//INSERT処理が完了したらリダイレクトを返す
        }
}
