<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    //▼ブラウザからアクセスされるときに実行されるメソッド。
    //ビューで現在アクセスしている人のIPアドレスが取得できるようにしている
    public function index(Request $request) {

        return view('like.index')->with('ip', $request->ip());

    }

    //▼Ajaxでユーザーデータを取得するためのメソッド
    public function user_list() {

        return $this->getUsers(); // 全ユーザーを取得

    }

    //▼「いいね！」データを追加するメソッド
    public function like(Request $request) {

        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $result = false;
        $model = \App\User::class;
        $exists = \App\Like::where('model', $model)
            ->where('parent_id', $request->user_id)
            ->where('ip', $request->ip())
            ->exists();

        if(!$exists) {

            $like = new \App\Like();
            $like->model = $model;
            $like->parent_id = $request->user_id;
            $like->ip = $request->ip();
            $result = $like->save();
        }

        return [
            'result' => $result,
            'users' => $this->getUsers() // 全ユーザーを取得
        ];

    }

    //▼LikeController内でユーザーデータを取得する場所が2ヵ所あるのでひとつにまとめた。
    //なお、private functionなのでこのクラスの中からしかアクセスすることはできない。
    private function getUsers() {

        return \App\User::with('likes')
            ->withCount('likes')
            ->get();

    }
}
