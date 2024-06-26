<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;//use宣言
use App\User;
use App\Like;
use App\Application;
use Illuminate\Support\Facades\Auth;//Authを使うときはこれを書く

class DisplayController extends Controller
{
    //1.トップ画面へ
    public function index(){

        $Post = new Post;//Postを使えるようにする
        $User = new User;
        if(Auth::user()){
            //postテーブル内の,statusが3でない+user_idがログイン中のidでないレコードに絞って、userテーブルと結合させて取得、配列化
            $id = Auth::id();
            $allPost_allUser = Post::where('status', '!=', 3)->where('user_id', '!=' ,$id)-> with('user')->get()->toArray();
        }else{
            //postテーブル内のstatusが3でないレコードに絞って、userテーブルと結合させて取得、配列化
            $allPost_allUser = Post::where('status', '!=', 3)-> with('user')->get()->toArray();
            //dd($allPost_allUser);
        }

        //top.blade.phpに情報を渡す
        return view('top',[
            //'posts' => $allPost,
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

    //6.マイページへ
    public function mypage(){

        //▼自分の投稿履歴を表示させるための記述
        //ログイン中のユーザーが登録した、Postテーブルのデータでstatusが3でないものに絞って取得して配列化したものを$loginPostDataとする
        $loginPostData = Auth::user()->post()->where('status', '!=', 3)->get()->toArray();
        //dd($loginPostData);

        //▼お気に入り投稿履歴を表示させるための記述
        $favoritePostData = Auth::user()->like()->whereHas('post', function ($query) {
                                    $query->where('status', '!=', 3);
                                    })->with('post')->get()->toArray();
        //dd($favoritePostData);


        //▼依頼した履歴一覧を表示させるための記述
        //$makeRequestData = Application::where('user_id', \Auth::user()->id)->with('post')->where('status', '!=', 3)->get()->toArray();
        
        //（ログイン中ユーザーによる(←これできてる？)）依頼にpostテーブルのデータを結合させて、postテーブル内のstatusが3でないものに絞って取得、配列化
        $makeRequestData = Auth::user()->application()->whereHas('post', function ($query) {
                                    $query->where('status', '!=', 3);
                                    })->with('post')->get()->toArray();
        //dd($makeRequestData);
        

        //▼依頼された履歴一覧を表示させるための記述
        //ログイン中のユーザーによる投稿の中で、statusが１(依頼中)のものを取得、配列化
        $receiveRequestData = Auth::user()->post()->where('status', '=', 1)->get()->toArray();
        //dd($receiveRequestData);

        return view('mypage/myPage',[
            'loginPostData' => $loginPostData,
            'favoritePostData' => $favoritePostData,
            'makeRequestData' => $makeRequestData,
            'receiveRequestData' => $receiveRequestData,
        ]);
    }

    
    //7.(他ユーザーの)投稿詳細画面へ     
    public function otherDetail(int $otherId){
        
        $Post = new Post;
        $User = new User;

        //$Postにusersテーブルの情報を結合させて、特定のIDのレコードを取得、配列化
        $Post_with_User = $Post->with('user')->find($otherId)->toArray();

        //【いいね機能】
        $like_model = new Like;//Likeモデルのデータ取得
        $post_like = Post::withCount('likes')->find($otherId);//？？？Postテーブル内の、idが$otherIdのレコードに絞る？

        return view('detail/otherDetail',[
            'Post_with_User' => $Post_with_User,
            'otherId' => $otherId,
            'like_model' => $like_model,
            'post_like' => $post_like,
        ]);
    }

    //【いいね機能】
    //web.phpのルーティングによってajaxlikeメソッドが実行される（？）
    public function ajaxlike(Request $request)
    {
        //dd($request);
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = new Like;
        $post = Post::findOrFail($post_id);

        // 空でない/いいね済(Likeテーブル内にlike_exist($id, $post_id)が存在する場合（？）)なら
        if ($like->like_exist($id, $post_id)) {
            //likesテーブルのレコードを削除(既にあるから削除)(いいね済→いいね未にする)
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        //空/いいね未なら
        } else {
            //likesテーブルに新しいレコードを作成する(いいね未→いいね済にする)
            $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }
        
        //postーlike間のリレーション数をカウントして、それをいいね数($postLikesCount)として取得
        //(loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合いいねの総数）)
        $postLikesCount = $post->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる(今回ぐらい少ない時は別にまとめんくてもいい)
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }

    
    //14.(自分の)投稿詳細画面へ     //↓ルートモデルバインディング適用する？「int $myId」じゃなくて「Post $post」？
    public function myDetail(int $myId){
        
        $Post = new Post;
        $User = new User;

        //$Postにusersテーブルの情報を結合させて、特定のIDのレコードを取得、配列化
        $Post_with_User = $Post->with('user')->find($myId)->toArray();
        //dd($Post_with_User);

        return view('detail/myDetail',[
            'Post_with_User' => $Post_with_User,
            'myId' => $myId,
        ]);
    }
    

    
    
    



}
