<?php

use App\Http\Controllers\DisplayController;//Controllerのuse宣言

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

//↓トップページに来た際に使用するControllerとメソッドの宣言→1.トップ画面表示
Route::get('/',[DisplayController::class,'index']);

//2.ログイン画面へ
Route::get('/login',[DisplayController::class,'loginDisplay'])->name('login');

//3.新規ユーザー登録画面へ
Route::get('/userRegistration',[DisplayController::class,'userRegistration'])->name('newRegistration');

//4.パスワード再設定画面へ
Route::get('/resettingPW',[DisplayController::class,'rePassword'])->name('rePassword');
//7.(他ユーザーの)詳細画面へ
Route::get('/other/{id}/detail',[DisplayController::class,'otherDetail'])->name('other.detail');
