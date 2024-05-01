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

//11.（新規投稿画面の）確認画面へ　【post】
Route::post('/confirmPost',[RegistrationController::class,'confirmPost'])->name('confirm.post');

//(at 10.新規投稿画面)「投稿」ボタンを押したとき【post】
Route::post('/completePost',[RegistrationController::class,'completePost'])->name('complete.post');

//12.(マイページの)編集画面へ
Route::get('/editMypage',[RegistrationController::class,'editMypage'])->name('editMypage');
//（at 12.マイページ編集画面）「変更」ボタンを押したとき
Route::post('/editMypage',[RegistrationController::class,'editFinish']);

//13.退会画面へ
Route::get('/withdraw',[RegistrationController::class,'withdraw'])->name('withdraw');
