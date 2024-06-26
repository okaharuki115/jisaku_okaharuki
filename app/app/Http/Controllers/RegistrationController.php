<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;//use宣言
use App\Application;
use App\User;
use App\Violation;
use Illuminate\Support\Facades\Auth;//Authを使うときはこれを書く

//バリエーションの為のクラス(CreatePostなど)を使用するための記述
use App\Http\Requests\CreatePost;
use App\Http\Requests\CreateEditMypage;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\CreateViolation;


class RegistrationController extends Controller
{
        //footer→8.投稿検索画面に飛ぶ
        public function searchPost(){

            return view('fromFooter/postSearch',[
            ]);
        }

        // 8.投稿検索画面→9.検索結果表示画面へ（(at 8.投稿検索画面)「検索」を押したとき）
        public function postSearch(Request $request){

            //検索フォームに入力された値を受け取る
            $title = $request->input('title');
            $amount1 = $request->input('amount1');
            $amount2 = $request->input('amount2');
            $content = $request->input('content');

            //postデータとuserデータ(username表示させるため)を呼び出す
            $post = new Post;
            $user = new User;

            //$postにuserテーブルの情報を結合させて、$queryとする + where文でstatusが3でないものに絞る
            $query = $post->where('status','!=',3)->with('user');


            //$keywordで何かしらの値を受け取った場合は、if文の中で取得するデータを絞りこむ
            if(!empty($title)) {
                //whereメソッドでLIKE検索を指定し、$titleの両側に%をつけることで、部分一致検索を行う
                $query = $query->where("title", "LIKE", "%${title}%");
            }

            if(!empty($content)) {
                $query = $query->where("content", "LIKE", "%${content}%");
            }

            if(!empty($amount1)) { 
                $query = $query->where("amount", ">", $amount1);
            }

            if(!empty($amount2)) {
                $query = $query->where("amount", "<", $amount2);
            }

            $posts = $query->get();//getの記述は１回だけしか書けない
            //dd($posts);

            //9.検索結果表示画面へ
            return view('fromFooter/searchResult',[
                'posts' => $posts,
            ]);
        }
        
        

        //footer→10.新規投稿画面に飛ぶ
        public function newPost(){
            
            return view('fromFooter/newPost',[
            ]);
        }

        //10.新規投稿画面→11.確認画面に飛ぶ
        public function confirmPost(CreatePost $request){//Request $request→CreatePost $request変更済

            $confirmData = $request;
            //画像はnullでもOKなので、箱を作っておいて、何も選択されなかったときはviewに空の変数が送られるようにする
            $image = '';
            $newImageName = '';

            if($request->file('image')){

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
            }
           
            return view('fromFooter/confirmPost',[
                'newData' => $confirmData,
                'image'        => $image,
                'newImageName' => $newImageName,
            ]);
        }

        //(at 11.新規投稿確認画面)「投稿」ボタンを押したときの処理
        public function completePost(Request $request){//Request $request→CreatePost $requestに変えた

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


        //（at 12.マイページ編集画面）「変更」を押したときのpost処理
        public function editFinish(CreateEditMypage $request){//Request $request→CreateEditMypage $requestに変更済
            $editData = Auth::user();//ログイン中の、userテーブルのレコードを取得
            $editData->name = $request->name;
            $editData->email = $request->email;
            
            //▼【アイコン登録の記述】
            if($request->file('icon')){
                // レコードを挿入したときのIDを取得
                $lastInsertedId = Auth::id();

                // 拡張子つきでファイル名を取得
                $imageName = $request->file('icon')->getClientOriginalName();

                // 拡張子のみ
                $extension = $request->file('icon')->getClientOriginalExtension();

                // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
                $newImageName = pathinfo($imageName, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;

                // ディレクトリを作成（public/imgの配下に名前のidと同じフォルダを生成）
                if (!file_exists(public_path() . "/img/mypage/" . $lastInsertedId)) {
                    mkdir(public_path() . "/img/mypage/" . $lastInsertedId, 0777);
                }

                //フォルダに上記の画像ファイルを移動する
                $request->file('icon')->move(public_path() . "/img/mypage/" . $lastInsertedId, $newImageName);

                $editData->icon =$newImageName;//【アイコン登録】

            }
            //▲【アイコン登録の記述】

            $editData->save();

            return redirect('/mypage');//マイページに戻りたい → マイページを表示させるためのURLを記述する
        }

        //6.マイページ→13.退会画面に飛ぶ　　
        public function withdraw(){
            return view('mypage/withdraw',[
            ]);
        }

        //(at 13.退会画面)退会しますかで「はい」を押したとき【退会処理】
        public function destroyUserDelete(){
            
            $user = Auth::user();// 現在ログインしているユーザーを取得
            $user_id = $user->id;
            $posts = Post::where('user_id', '=', $user_id)->get();
            $applications = Application::where('user_id', '=', $user_id)->get();
            //dd($applications);

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

            return redirect('/');//(at 13.退会画面)で「はい」を押したら(退会したら)top.phpに戻る

            //return redirect()->route('userDeleteComplete');// 退会完了ページへリダイレクト
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
        public function completeEditMypost(int $completeEditMypostId, CreatePost $request){//Request $request→CreatePost $request変更済

            $Post = new Post;
            $record = $Post->find($completeEditMypostId);

            $record->title =$request->title;
            $record->amount =$request->amount;
            $record->content =$request->content;

            if($request->file('image')){
                //▼【画像登録の記述】
                // レコードを挿入したときのIDを取得
                $lastInsertedId = $completeEditMypostId;

                // 拡張子つきでファイル名を取得
                $imageName = $request->file('image')->getClientOriginalName();

                // 拡張子のみ
                $extension = $request->file('image')->getClientOriginalExtension();

                // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
                $newImageName = pathinfo($imageName, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;

                //フォルダに上記の画像ファイルを移動する
                $request->file('image')->move(public_path() . "/img/" . $lastInsertedId, $newImageName);
                // $image = "/img/". $lastInsertedId ."/" . $newImageName;

                //▲【画像登録の記述】

                $record->image =$newImageName;//【画像登録】

            }
            
            Auth::user()->post()->save($record);

            return redirect('/mypage');//INSERT処理が完了したらマイページ画面に飛ぶ
        }

        //(at 14.(自分の)投稿詳細画面)「削除」ボタンを押して→16.削除画面に飛ぶ  
        public function postDelete(int $postDeleteId){

            $post = new Post;
            $deletePost = $post->find($postDeleteId);
            //dd($deletePost);

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
            //dd($makeRequestData['post']['status']);
            // if($makeRequestData['post']['status'] == 0){
            //     $status = '投稿中';
            // }elseif($makeRequestData['post']['status'] == 1){
            //     $status = '依頼中';
            // }elseif($makeRequestData['post']['status'] == 2){
            //     $status = '完了';
            // }elseif($makeRequestData['post']['status'] == 3){
            //     $status = '停止中';
            // }
            
            return view('requestViolation/makeRequest',[
               'makeRequestId' => $makeRequestId,
               'makeRequestData' => $makeRequestData,
               //'status' => $status,
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
        public function iraiModificationComplete(int $iraiModificationCompleteId, CreateRequest $request){//Request $request→CreateRequest $request変更済

            $application = new Application;
            $iraiModificationRecord = $application->find($iraiModificationCompleteId);

            $iraiModificationRecord->content =$request->content;
            $iraiModificationRecord->tel =$request->tel;
            $iraiModificationRecord->email =$request->email;
            $iraiModificationRecord->limit =$request->limit;
            
            Auth::user()->application()->save($iraiModificationRecord);

            return redirect('/mypage');//INSERT処理が完了したらマイページ画面に飛ぶ
        }

        //6.マイページ→19.依頼（された）詳細画面へ（（at 6.マイページ）依頼された履歴の「詳細」を押したとき） 
        public function receiveRequestDetail(int $receiveRequestId){
            
            $post = new Post;
            $application = new Application;

            //$applicationにpostテーブルの情報を結合させて、特定のIDのレコードを取得、配列化(「$postにapplicationテーブルの情報を結合」みたいに逆にしたらエラー出るみたい)
            //$receiveRequestData = $application->where('post_id', '=', $receiveRequestId)->with('post')->get()->toArray();
            //$receiveRequestData = $post->find($receiveRequestId)->with('application')->get();
            
            //dd($receiveRequestData);
            
            $irai_specific = $application->where('post_id', '=', $receiveRequestId)->first();//単一のモデルインスタンスを取得したい場合は、firstメソッドを使用
            $irai_id = $irai_specific->id;
            //dd($irai_id);
            $receiveRequestData = $application->with('post')->find($irai_id)->toArray();
            //dd($receiveRequestData);

            return view('requestViolation/receiveRequest',[
               'receiveRequestId' => $receiveRequestId,
               'receiveRequestData' => $receiveRequestData,
               //'status' => $status,
            ]);
        }

        //(at 19.依頼（された）詳細画面)「完了」ボタンを押したときの処理(get)
        public function requestComplete(int $receiveCompleteId){

                //▼Postテーブルのstatusを2(完了)にする
                $post = new Post;
                $statusChangePost = $post ->find($receiveCompleteId);//statusを変える投稿を抽出
                $statusChangePost->status = 2;//statusを2にする
                $statusChangePost->save();

                return redirect('/mypage');//get処理でもこの記述書いてOK
            }

        //7.（他ユーザーの）投稿詳細→20.依頼登録画面に飛ぶ
        public function irai(int $iraiId){

            return view('requestViolation/requestRegistration',[
               'iraiId' => $iraiId,
            ]);
        }

        //(at 20.依頼登録画面)「登録」ボタンを押したときのpost処理     
        public function iraiRegistration(CreateRequest $request,int $iraiRegistrationId){//Request $request→CreateRequest $request変更済

            $application = new Application;
            $application->content =$request->content;
            $application->tel =$request->tel;
            $application->email =$request->email;
            $application->limit =$request->limit;
            $application->post_id =$iraiRegistrationId;

            Auth::user()->application()->save($application);

            //▼Postテーブルのstatusを１(依頼中)にする
            $post = new Post;
            $statusChangePost = $post ->find($iraiRegistrationId);//statusを変える投稿を抽出
            $statusChangePost->status = 1;//statusを1にする
            $statusChangePost->save();

            return redirect('/mypage');
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
        public function ihanRegistration(CreateViolation $request,int $ihanRegistrationId){//Request $request→

            $violation = new Violation;
            $violation->comment =$request->comment;
            $violation->post_id =$ihanRegistrationId;

            Auth::user()->violation()->save($violation);

            //処理が終わったらotherDetail.phpに戻る
            return redirect()->route('other.detail', ['id' => $ihanRegistrationId]);
        }
        
        //6.マイページ→22.管理者画面へ飛ぶ 
        public function administer(){

            return view('administer/administer',[
            ]);
        }



}
