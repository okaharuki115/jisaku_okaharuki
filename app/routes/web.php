<?php

//Controllerのuse宣言
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;

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

//↓トップページに来た際に使用するControllerとメソッドの宣言→1.トップ画面表示
Route::get('/',[DisplayController::class,'index']);


//7.(他ユーザーの)詳細画面へ
Route::get('/other/{id}/detail',[DisplayController::class,'otherDetail'])->name('other.detail');

//6.マイページへ
Route::get('/mypage',[DisplayController::class,'mypage']);

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

//7.（他ユーザーの）投稿詳細→20.依頼登録画面に飛ぶ
Route::get('/irai/{id}',[RegistrationController::class,'irai'])->name('irai');
//(at 20.依頼登録画面)「登録」ボタンを押したときのpost処理
Route::post('/irai/{id}',[RegistrationController::class,'iraiRegistration']);

//7.（他ユーザーの）投稿詳細→21.違反登録画面に飛ぶ
Route::get('/ihan/{id}',[RegistrationController::class,'ihan'])->name('ihan');
//(at 21.違反登録画面)「報告」ボタンを押したときのpost処理
Route::post('/ihan/{id}',[RegistrationController::class,'ihanRegistration']);

//6.マイページ→17.依頼（した）詳細画面へ（（at 6.マイページ）依頼した履歴の「詳細」を押したとき） 
Route::get('/makeRequest/{id}/detail',[RegistrationController::class,'makeRequestDetail'])->name('makeRequestDetail');

//17.依頼（した）詳細→18.依頼修正画面に飛ぶ     
Route::get('/iraiModification/{id}',[RegistrationController::class,'iraiModification'])->name('iraiModification');
//(at 18.依頼修正画面)「登録」ボタンを押したときのpost処理
Route::post('/iraiModification/{id}',[RegistrationController::class,'iraiModificationComplete']);
