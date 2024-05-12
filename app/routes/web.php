<?php

//Controllerのuse宣言
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth内で定義されているルーティングを呼び出す/ログイン機能がないと使えないようにする？
Auth::routes();

//6-4 P8 Route::groupによってルーティングをグループ化し、そこにミドルウェアを適用(Route::groupに中に入れるものには共通の設定を作る)


//↓トップページに来た際に使用するControllerとメソッドの宣言→1.トップ画面表示
//(//localhostと打った時だけでなくlogoクリック時にもtop.phpを表示させたいので、move.topというルート名を追加してルーティングできるようにした)
Route::get('/',[DisplayController::class,'index'])->name('move.top');


//7.(他ユーザーの)詳細画面へ
Route::get('/other/{id}/detail',[DisplayController::class,'otherDetail'])->name('other.detail');

//【管理者画面】
//下記を追記
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::view('/home', 'home')->middleware('auth');//homeのままでいい？
//↓元々「Route::view('/admin', 'admin');」やけどこのままではadmin.blade.phpというviewを表示して終わりになるので、controllerの情報を追加して、get処理を行うルーティングに変更した
Route::get('/admin', [AdminController::class,'admin']);
//上記までを追記

//→ログイン中ならページを表示、そうでなければログイン画面を表示(←Authの中身が)
Route::group(['middleware' => 'auth'], function(){

    //6.マイページへ
    Route::get('/mypage',[DisplayController::class,'mypage']);

    //8.投稿検索画面へ　
    Route::get('/searchPost',[RegistrationController::class,'searchPost'])->name('searchPost');

    //8.投稿検索画面→9.検索結果表示画面へ（(at 8.投稿検索画面)「検索」を押したとき）
    Route::post('/searchPostResult', [RegistrationController::class, 'postSearch'])->name('postSearch');

    //10.新規投稿画面へ
    Route::get('/newPost',[RegistrationController::class,'newPost'])->name('newPost');

    //10.新規投稿画面→11.（新規投稿画面の）確認画面へ　【post】
    Route::post('/confirmPost',[RegistrationController::class,'confirmPost'])->name('confirm.post');

    //(at 11.新規投稿確認画面)「投稿」ボタンを押したとき【post】
    Route::post('/completePost',[RegistrationController::class,'completePost'])->name('complete.post');

    //▼下２つ：ルートの名前は同じだが、ルーティングが機能するタイミング・処理内容は全く違う
    //12.(マイページの)編集画面へ
    Route::get('/editMypage',[RegistrationController::class,'editMypage'])->name('editMypage');
    
    //（at 12.マイページ編集画面）「変更」ボタンを押したとき
    Route::post('/editMypage',[RegistrationController::class,'editFinish']);

    //13.退会画面へ
    Route::get('/withdraw',[RegistrationController::class,'withdraw'])->name('withdraw');

    //(at 13.退会画面)退会しますかで「はい」を押したとき【退会処理】
    // 退会ページ（退会処理）                              ↓TestControllerをRegistrationControllerに変更済
    Route::delete('/userDelete', [RegistrationController::class,'destroyUserDelete'])->name('destroyUserDelete')->middleware('verified');//middleware('verified')はメール認証していないとアクセス不可という意味
    //Route::delete('/userDelete', 'App\Http\Controllers\RegistrationController@destroyUserDelete')->name('destroyUserDelete')->middleware('verified');//middleware('verified')はメール認証していないとアクセス不可という意味

    //6.マイページ→14.（自分の）投稿詳細画面へ　
    Route::get('/my/{id}/detail',[DisplayController::class,'myDetail'])->name('myDetail');

    //14.（自分の）投稿詳細画面→15.（自分の投稿の）編集画面へ   
    Route::get('/edit/{id}/MyPost',[RegistrationController::class,'editMyPost'])->name('editMyPost');

    //(at 15.（自分の投稿の）編集画面)「編集」ボタンを押したとき    
    Route::post('/completeEdit/{id}/Mypost',[RegistrationController::class,'completeEditMypost'])->name('editMypost.complete');

    //14.(自分の)投稿詳細画面→16.削除画面に飛ぶ　（１回目の「削除」ボタンを押したとき）        
    Route::get('/delete/{id}/post',[RegistrationController::class,'postDelete'])->name('post.delete');

    //(at 16.削除画面)「削除」ボタンを押したとき
    Route::get('/delete/{id}/complete',[RegistrationController::class,'deleteComplete'])->name('delete.complete');

    //6.マイページ→17.依頼（した）詳細画面へ（（at 6.マイページ）依頼した履歴の「詳細」を押したとき） 
    Route::get('/makeRequest/{id}/detail',[RegistrationController::class,'makeRequestDetail'])->name('makeRequestDetail');

    //17.依頼（した）詳細→18.依頼修正画面に飛ぶ     
    Route::get('/iraiModification/{id}',[RegistrationController::class,'iraiModification'])->name('iraiModification');
    //(at 18.依頼修正画面)「登録」ボタンを押したときのpost処理
    Route::post('/iraiModification/{id}',[RegistrationController::class,'iraiModificationComplete']);

    //6.マイページ→19.依頼（された）詳細画面へ（（at 6.マイページ）依頼された履歴の「詳細」を押したとき） 
    Route::get('/receiveRequest/{id}/detail',[RegistrationController::class,'receiveRequestDetail'])->name('receiveRequestDetail');

    //(at 19.依頼（された）詳細画面)「完了」ボタンを押したときの処理(get)
    Route::get('/requestComplete/{id}',[RegistrationController::class,'requestComplete'])->name('requestComplete');

    //7.（他ユーザーの）投稿詳細→20.依頼登録画面に飛ぶ
    Route::get('/irai/{id}',[RegistrationController::class,'irai'])->name('irai');
    //(at 20.依頼登録画面)「登録」ボタンを押したときのpost処理
    Route::post('/irai/{id}',[RegistrationController::class,'iraiRegistration']);

    //7.（他ユーザーの）投稿詳細→21.違反登録画面に飛ぶ
    Route::get('/ihan/{id}',[RegistrationController::class,'ihan'])->name('ihan');
    //(at 21.違反登録画面)「報告」ボタンを押したときのpost処理
    Route::post('/ihan/{id}',[RegistrationController::class,'ihanRegistration']);

    //6.マイページ→22.管理者画面へ飛ぶ 
    Route::get('/administer',[RegistrationController::class,'administer'])->name('administer');

});