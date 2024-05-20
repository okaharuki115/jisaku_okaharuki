<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;//use宣言
use App\Violation;
use App\User;
use App\Application;

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

        $post = new Post;
        $stopPost = $post->find($postStopId);
        //dd($stopPost);

        //statusが３の場合は停止中ですっていう画面を表示させたい
        // $post = new Post;
        // $stopPost = $post->find($postStopId);
        // if($stopPost->status==3){
        //     return view('administer/stopNow',[
        //     ]);
        // }
        // else{
        //     return view('administer/postDisplayStop',[
        //         'postStopId' => $postStopId,
        //     ]);
        // }
        //statusが３の場合は停止中ですっていう画面を表示させたい
        return view('administer/postDisplayStop',[
            'postStopId' => $postStopId,
            'stopPost' => $stopPost,
        ]);
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

        $user = new User;
        $stopUser = $user->find($userStopId);
        //dd($stopUser);

        return view('administer/userStop',[
            'userStopId' => $userStopId,
            'stopUser' => $stopUser,
        ]);
    }

    //(at 24.ユーザー停止画面)このユーザーを停止させますかで「はい」を押したとき【ユーザー停止処理】 
    public function userStopComplete(int $userStopCompleteId){
            
        $user_id = $userStopCompleteId;

        $user = User::find($user_id);//「特定のユーザーの」で１つに絞るときはfindを使う(whereを使うと複数データを取得することになる)

        $posts = Post::where('user_id', '=', $user_id)->get();
        $applications = Application::where('user_id', '=', $user_id)->get();

        //ユーザー情報の論理削除
        $user->delete();

        //Post情報の論理削除
        foreach($posts as $post){//postは複数あって、それをまとめて削除はできないのでforeachでばらしてから1個１個削除する
            $post->delete();
        }

        //依頼情報の論理削除
        foreach($applications as $application){
            $post_a = Post::find($application->post_id);//退会するユーザーによる投稿のpost_idに当てはまるPostを取得、$post_aとする
            $post_a->status = 0;//post_idのステータスを０(投稿中)にする(これによって、依頼した側のユーザーのmypageの依頼した投稿にも表示されない)
            $post_a->save();
            $application->delete();
        }

        return redirect('/admin');//(at 24.ユーザー停止画面)で「はい」を押したら(ユーザー停止したら)管理者画面に戻る
    }
    

    
}
