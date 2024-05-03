<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;//use宣言
use App\User;
use Illuminate\Support\Facades\Auth;//Authを使うときはこれを書く

class DisplayController extends Controller
{
    //DBのデータを抽出してviewに返す
    public function index(){

        $Post = new Post;//Postを使えるようにする
        $User = new User;

        $allPost = $Post->all()->toArray();//Postモデルから全レコードを取得、配列化
        $pre_allPost_allUser = $Post -> with('user')->get();//$Postにusersテーブルのデータを結合させて$pre_allPost_allUserとする
        $allPost_allUser = $pre_allPost_allUser ->toArray();
        
        //top.blade.phpに情報を渡す
        return view('top',[
            'posts' => $allPost,
            //'users' => $allUser,
            'posts_users' =>$allPost_allUser,
        ]);
    }

    //2.ログイン画面へ
    public function loginDisplay(){
        return view('login',[
        ]);
    }

    //4.パスワード再設定画面へ
    public function rePassword(){
        return view('register/resettingPW',[
        ]);
    }

    //マイページへ
    public function mypage(){

        //ログイン中のユーザーが登録した、Postテーブルのデータを取得して配列化したものを$loginPostDataとする
        $loginPostData = Auth::user()->post()->get()->toArray();
        //dd($loginPostData);

        return view('mypage/myPage',[
            'loginPostData' => $loginPostData,
            
        ]);
    }

    
    //7.(他ユーザーの)投稿詳細画面へ     //↓ルートモデルバインディング適用する？「int $otherId」じゃなくて「Post $post」？
    public function otherDetail(int $otherId){
        
        $Post = new Post;
        $User = new User;

        //$allPost = $Post->all()->toArray();//Postモデルから全レコードを取得、配列化
        // $pre_allPost_allUser = $Post -> with('user')->get();
        // $allPost_allUser = $pre_allPost_allUser ->toArray();

        //$Postにusersテーブルの情報を結合させて、特定のIDのレコードを取得、配列化
        $Post_with_User = $Post->with('user')->find($otherId)->toArray();


        return view('detail/otherDetail',[
            'Post_with_User' => $Post_with_User,
            'otherId_detail' => $otherId,
        ]);
    }

    //14.(自分の)投稿詳細画面へ     //↓ルートモデルバインディング適用する？「int $myId」じゃなくて「Post $post」？
    public function myDetail(int $myId){
        
        $Post = new Post;
        $User = new User;

        //$Postにusersテーブルの情報を結合させて、特定のIDのレコードを取得、配列化
        $Post_with_User = $Post->with('user')->find($myId)->toArray();

        return view('detail/myDetail',[
            'Post_with_User' => $Post_with_User,
            'myId_detail' => $myId,
        ]);
    }

    

    
    
    



}
