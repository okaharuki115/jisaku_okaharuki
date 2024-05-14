<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;//use宣言
use App\Violation;
use App\User;

class AdminController extends Controller
{
    //22.管理者画面を表示(管理者ログインをして、URLが「localhost/admin」になったとき)
    public function admin(){

        $post = new Post;
        $violation = new Violation;
        $user = new User;

        //▼ユーザー一覧を表示
        //
        $userlists = User::withCount(['post' => function ($query) {
                                    $query->where("status", "=", 3);
                                    }])
                                    ->orderBy('post_count', 'desc')->limit(10)->get()->toArray();
        //dd($userlists);

        //▼投稿一覧を表示
        //リレーションのカウント(violationの数)を降順に取得(上位20個) （userテーブル内のユーザー名も表示させるためにwithメソッドでuserもくっつけてる）
        $postlists = Post::withCount('violation')->with('user')->orderBy('violation_count', 'desc')->limit(20)->get()->toArray();
        //                       　     ↑このviolationは、Post.phpで書いたhasManyの処理名

        return view('admin',[
            'userlists' => $userlists,
            'postlists' => $postlists,
        ]);
    }

    //22.管理者画面→23.投稿表示停止画面へ　(at 22.管理者画面)投稿一覧の「停止」を押したとき
    public function postStop(int $postStopId){

        //statusが３の場合は停止中ですっていう画面を表示させたい
        $post = new Post;
        $stopPost = $post->find($postStopId);
        if($stopPost->status==3){
            return view('administer/stopNow',[
            ]);
        }
        //statusが３の場合は停止中ですっていう画面を表示させたい

        else{
            return view('administer/postDisplayStop',[
                'postStopId' => $postStopId,
            ]);
        }
    }

    //(at 23.投稿表示停止画面)この投稿を停止させますかで「はい」を押したときの処理
    public function postStopComplete(int $postStopCompleteId){

        $post = new Post;
        $stopPost = $post->find($postStopCompleteId);//停止させるPostのデータを取得
        $stopPost->status = 3;//停止させるPostのstatusを3(停止中)にする
        $stopPost->save();

        return redirect('/admin');//処理が終わったら管理者画面に戻る
    }

    //22.管理者画面→24.ユーザー停止画面へ　(at 22.管理者画面)ユーザー一覧の「停止」を押したとき
    public function userStop(int $userStopId){

            return view('administer/userStop',[
                'userStopId' => $userStopId,
            ]);
    }
    

    
}
