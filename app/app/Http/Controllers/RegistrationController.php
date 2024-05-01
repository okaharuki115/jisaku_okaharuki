<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;//use宣言
use Illuminate\Support\Facades\Auth;//Authを使うときはこれを書く


class RegistrationController extends Controller
{
        //footer→10.新規投稿画面に飛ぶ
        public function newPost(){

            return view('fromFooter/newPost',[
            ]);
        }

        //10.新規投稿画面→11.確認画面に飛ぶ
        public function confirmPost(Request $request){

            //$Post = new Post;
            //渡すデータの記述（Postテーブルから特定のIDのレコードを取得）
            //$newPostData = $Post ->find($newPostId) ->toArray();

            $confirmData = $request;
            //dd($confirmData);

            return view('fromFooter/confirmPost',[
                'newData' => $confirmData,
            ]);
        }

        //(at 10.新規投稿画面)「投稿」ボタンを押したときの処理
        public function completePost(Request $request){

            $Post = new Post;
            $Post->title =$request->title;
            $Post->amount =$request->amount;
            $Post->content =$request->content;
            //ここに画像登録の記述書く
            Auth::user()->post()->save($Post);

            return redirect('/');//INSERT処理が完了したらリダイレクトを返す
        }

        //6.マイページ→12.編集画面に飛ぶ(6.マイページで「編集」を押したときのget処理)　
        public function editMypage(){

            $editData = Auth::user();//特定のユーザーのレコードを取得して$editDataとする

            return view('mypage/editMypage',[
                'editData' => $editData,
            ]);
        }

        //（at 12.マイページ編集画面）「変更」を押したときのget処理
        // public function editFinish(){
            
        //     return view('mypage/Mypage',[
        //     ]);
        // }

        //（at 12.マイページ編集画面）「変更」を押したときのpost処理
        public function editFinish(Request $request){
            $editData = Auth::user();//ログイン中の、userテーブルのレコードを取得
            $editData->name = $request->name;
            $editData->email = $request->email;
            //ここにアイコン版記述
            $editData->save();

            return redirect('/mypage');//マイページに戻りたい → マイページを表示させるためのURLを記述する
        }

        //6.マイページ→13.退会画面に飛ぶ　　
        public function withdraw(){
            return view('mypage/withdraw',[
            ]);
        }

}
