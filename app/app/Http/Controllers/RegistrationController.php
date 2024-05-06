<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;//use宣言
use App\Application;
use App\User;
use App\Violation;
use Illuminate\Support\Facades\Auth;//Authを使うときはこれを書く


class RegistrationController extends Controller
{
        //footer→8.投稿検索画面に飛ぶ
        public function searchPost(){

            return view('fromFooter/postSearch',[
            ]);
        }

        //footer→10.新規投稿画面に飛ぶ
        public function newPost(){
            
            return view('fromFooter/newPost',[
            ]);
        }

        //10.新規投稿画面→11.確認画面に飛ぶ
        public function confirmPost(Request $request){

            $confirmData = $request;

            //【画像を登録するための記述】
            // 拡張子つきでファイル名を取得
            $imageName = $request->file('image')->getClientOriginalName();

            // 拡張子のみ
            $extension = $request->file('image')->getClientOriginalExtension();

            // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
            $newImageName = pathinfo($imageName, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;

            //tmpフォルダに上記の画像ファイルを移動する
            $request->file('image')->move(public_path() . "/img/tmp", $newImageName);
            $image = "/img/tmp/" . $newImageName;
           
            return view('fromFooter/confirmPost',[
                'newData' => $confirmData,
                'image'        => $image,
                'newImageName' => $newImageName,
            ]);
        }

        //(at 11.新規投稿確認画面)「投稿」ボタンを押したときの処理
        public function completePost(Request $request){

            $Post = new Post;
            $Post->title =$request->title;
            $Post->amount =$request->amount;
            $Post->content =$request->content;
            $Post->image = $request->image;//【画像登録の記述】
            Auth::user()->post()->save($Post);

            //▼【画像登録の記述】
            // レコードを挿入したときのIDを取得
            $lastInsertedId = $Post->id;

            // ディレクトリを作成（public/imgの配下に名前のidと同じフォルダを生成）
            if (!file_exists(public_path() . "/img/" . $lastInsertedId)) {
                mkdir(public_path() . "/img/" . $lastInsertedId, 0777);
            }

            // 一時保存から本番の格納場所へ移動（tmpフォルダから上記のフォルダへ移動）
            rename(public_path() . "/img/tmp/" . $request->image, public_path() . "/img/" . $lastInsertedId . "/" . $request->image);

            // 一時保存の画像を削除（tmpフォルダを空にする）
            \File::cleanDirectory(public_path() . "/img/tmp");

            //▲【画像登録の記述】

            return redirect('/mypage');//INSERT処理が完了したらマイページ画面に飛ぶ
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

        //14.（自分の）投稿詳細画面→15.（自分の投稿の）編集画面に飛ぶ(14.（自分の投稿の）詳細画面で「編集」を押したときのpost処理)　
        public function editMyPost(int $editMypostId){

            $post = new Post;
            $editData = $post->find($editMypostId);
            //dd($editData);

            return view('detail/editMypost',[
                'editData' => $editData,
                'editMypostId' => $editMypostId,
            ]);
        }

        //(at 15.自分の投稿の編集画面)「編集」ボタンを押したときのpost処理
        public function completeEditMypost(int $completeEditMypostId, Request $request){

            $Post = new Post;
            $record = $Post->find($completeEditMypostId);

            $record->title =$request->title;
            $record->amount =$request->amount;
            $record->content =$request->content;
            //ここに画像登録の記述書く
            Auth::user()->post()->save($record);

            return redirect('/mypage');//INSERT処理が完了したらマイページ画面に飛ぶ
        }

        //(at 14.(自分の)投稿詳細画面)「削除」ボタンを押して→16.削除画面に飛ぶ  
        public function postDelete(int $postDeleteId){

            $post = new Post;
            $deletePost = $post->find($postDeleteId);

            return view('detail/delete',[
                'deletePost' => $deletePost,
                'postDeleteId' => $postDeleteId,
            ]);
        }

        //(at 16.削除画面)「削除」ボタン押したときの記述
        public function deleteComplete(int $deleteCompleteId){

            $post = new Post;
            $deletePost = $post->find($deleteCompleteId);
            
            $deletePost->delete();

            return redirect('/mypage');
        }

        //7.（他ユーザーの）投稿詳細→20.依頼登録画面に飛ぶ
        public function irai(int $iraiId){

            return view('requestViolation/requestRegistration',[
               'iraiId' => $iraiId,
            ]);
        }

        //(at 20.依頼登録画面)「登録」ボタンを押したときのpost処理     
        public function iraiRegistration(Request $request,int $iraiRegistrationId){

            $application = new Application;
            $application->content =$request->content;
            $application->tel =$request->tel;
            $application->email =$request->email;
            $application->limit =$request->limit;
            $application->post_id =$iraiRegistrationId;

            Auth::user()->application()->save($application);

            return redirect('/');
        }

        //7.（他ユーザーの）投稿詳細→21.違反登録画面に飛ぶ
        public function ihan(int $ihanId){

            $Post = new Post;
            $User = new User;

            //$Postにusersテーブルの情報を結合させて、特定のIDのレコードを取得、配列化
            $Post_with_User = $Post->with('user')->find($ihanId)->toArray();
            //dd($Post_with_User);
            
            return view('requestViolation/violationRegistration',[
               'ihanId' => $ihanId,
               'Post_with_User' => $Post_with_User,
            ]);
        }

        //(at 21.違反登録画面)「報告」ボタンを押したときのpost処理  
        public function ihanRegistration(Request $request,int $ihanRegistrationId){

            $violation = new Violation;
            $violation->comment =$request->comment;
            $violation->post_id =$ihanRegistrationId;

            Auth::user()->violation()->save($violation);

            return redirect('/');
        }

        //6.マイページ→17.依頼（した）詳細画面へ（（at 6.マイページ）依頼した履歴の「詳細」を押したとき）
        public function makeRequestDetail(int $makeRequestId){

            $post = new Post;
            $application = new Application;

            //$applicationにpostテーブルの情報を結合させて、特定のIDのレコードを取得、配列化
            $makeRequestData = $application->with('post')->find($makeRequestId)->toArray();

            //ログイン中のユーザーが登録したapplicationテーブルとpostテーブルの情報を結合(postテーブルの中のtitleをmypageで表示させるため)
            //$application_with_post = Auth::user()->application()->with('post')->get();
            //↑を配列化
            //$makeRequestData = $application_with_post ->toArray();
            //dd($makeRequestData);
            
            return view('requestViolation/makeRequest',[
               'makeRequestId' => $makeRequestId,
               'makeRequestData' => $makeRequestData,
            ]);
        }

        //17.依頼（した）詳細→18.依頼修正画面に飛ぶ                
        public function iraiModification(int $iraiModificationId){

            $application = new Application;
            $iraiModificationData = $application ->find($iraiModificationId)->toArray();
            //dd($iraiModificationData);
            
            return view('requestViolation/requestModification',[
               'iraiModificationId' => $iraiModificationId,
               'iraiModificationData' => $iraiModificationData,
               
            ]);
        }

        //(at 18.依頼修正画面)「登録」ボタンを押したときのpost処理  
        public function iraiModificationComplete(int $iraiModificationCompleteId, Request $request){

            $application = new Application;
            $iraiModificationRecord = $application->find($iraiModificationCompleteId);

            $iraiModificationRecord->content =$request->content;
            $iraiModificationRecord->tel =$request->tel;
            $iraiModificationRecord->email =$request->email;
            $iraiModificationRecord->limit =$request->limit;
            
            Auth::user()->application()->save($iraiModificationRecord);

            return redirect('/mypage');//INSERT処理が完了したらマイページ画面に飛ぶ
        }

}
