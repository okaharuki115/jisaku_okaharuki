<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;// 追記【退会処理】

class Post extends Model
{
    //データ書きかえを許可するための記述(6-2P10参照)
    protected $fillable = ['title', 'anount', 'content','image'];

    // テーブル結合(user_idとid)--PostsテーブルとUsersテーブル（？） 
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    //モデルとの関連性を記述(Postモデルと各データの紐づけを行う）(6-4P10参照)
    public function violation(){
        return $this->hasMany('App\Violation');
    }

    //【退会処理】
    use SoftDeletes;// 論理削除を使う
    protected $dates = ['deleted_at'];// 日付型として扱う(deleted_atカラムに日付が入ってたらそのレコード(User)は表示しない)
}
