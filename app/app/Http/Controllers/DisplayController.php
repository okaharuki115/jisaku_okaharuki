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

        //postテーブル内のstatusが3でないレコードに絞って、userテーブルと結合させて取得、配列化
        $allPost_allUser = Post::where('status', '!=', 3)-> with('user')->get()->toArray();
        //dd($allPost_allUser);

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

        //memo：$allPost_allUser = Post::where('status', '!=', 3)-> with('user')->get()->toArray();

        //▼自分の投稿履歴を表示させるための記述
        //ログイン中のユーザーが登録した、Postテーブルのデータでstatusが3でないものに絞って取得して配列化したものを$loginPostDataとする
        $loginPostData = Auth::user()->post()->where('status', '!=', 3)->get()->toArray();
        //dd($loginPostData);



        //▼依頼した履歴一覧を表示させるための記述
        //$makeRequestData = Application::where('user_id', \Auth::user()->id)->with('post')->where('status', '!=', 3)->get()->toArray();
        
        //（ログイン中ユーザーによる(←これできてる？)）依頼にpostテーブルのデータを結合させて、postテーブル内のstatusが3でないものに絞って取得、配列化
        $makeRequestData = Application::whereHas('post', function ($query) {
                                    $query->where('status', '!=', 3);
                                    })->with('post')->get()->toArray();
        //dd($makeRequestData);
        

        //▼依頼された履歴一覧を表示させるための記述
        //ログイン中のユーザーによる投稿の中で、statusが１(依頼中)のものを取得、配列化
        $receiveRequestData = Auth::user()->post()->where('status', '=', 1)->get()->toArray();
        //dd($receiveRequestData);

        return view('mypage/myPage',[
            'loginPostData' => $loginPostData,
            'makeRequestData' => $makeRequestData,
            'receiveRequestData' => $receiveRequestData,
        ]);
    }

    
    //7.(他ユーザーの)投稿詳細画面へ     //↓ルートモデルバインディング適用する？「int $otherId」じゃなくて「Post $post」？
    public function otherDetail(int $otherId){
        
        $Post = new Post;
        $User = new User;

        //$Postにusersテーブルの情報を結合させて、特定のIDのレコードを取得、配列化
        $Post_with_User = $Post->with('user')->find($otherId)->toArray();
        //dd($Post_with_User);

        //【いいね機能】
        $like_model = new Like;
        $post_like = Post::withCount('like')->find($otherId);
        //dd($post_like);

        return view('detail/otherDetail',[
            'Post_with_User' => $Post_with_User,
            'otherId' => $otherId,
            'like_model' => $like_model,
            'post_like' => $post_like,
        ]);
    }

    //【いいね機能】
    public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = new Like;
        $post = Post::findOrFail($post_id);

        // 空でない（既にいいねしている）なら
        //Like.phpのlike_existの処理を実行
        if ($like->like_exist($id, $post_id)) {
            //likesテーブルのレコードを削除(既にあるから削除)
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
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
