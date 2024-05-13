<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;//use宣言
use App\Violation;

class AdminController extends Controller
{
    //22.管理者画面を表示(管理者ログインをして、URLが「localhost/admin」になったとき)
    public function admin(){

        $post = new Post;
        $violation = new Violation;

        //id=1の中にviolationは何件あるのか  ↓このviolationは、Post.phpで書いたhasManyの処理名
        $postpost = Post::withCount('violation')->orderBy('violation_count', 'desc')->limit(3)->get();
        dd($postpost);

        $allPost = $post->all()->toArray();//Postモデルから全レコードを取得、配列化
        $allPost_allViolation = $post -> with('violation')->get()->toArray();//$postにviolationテーブルのデータを結合したデータを取得、配列化
        $allPost_allUser = $post -> with('user')->get()->toArray();//$postにuserテーブルのデータを結合したデータを取得、配列化
        dd($allPost_allViolation);

        return view('admin',[

        ]);
    }
}
