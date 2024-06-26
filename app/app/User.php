<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;// 追記【退会処理】

class User extends Authenticatable
{ 
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //データ書きかえを許可するための記述(6-2P10参照)
    protected $fillable = [
        'name', 'email', 'password','icon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //モデルとの関連性を記述(Userモデルと各データの紐づけを行う）(6-4P10参照)
    public function post(){
        return $this->hasMany('App\Post');
    }

    //モデルとの関連性を記述(Userモデルと各データの紐づけを行う）(6-4P10参照)
    public function application(){
        return $this->hasMany('App\Application');
    }

    //モデルとの関連性を記述(Userモデルと各データの紐づけを行う）(6-4P10参照)
    public function violation(){
        return $this->hasMany('App\Violation');
    }

    //モデルとの関連性を記述(Postモデルと各データの紐づけを行う）(6-4P10参照)
    public function like(){
        return $this->hasMany('App\Like');
    }

    //【退会処理】
    //モデルが論理削除フラグを使えるようにする
    use SoftDeletes;
    protected $dates = ['deleted_at'];// 日付型として扱う(deleted_atカラムに日付が入ってたらそのレコード(User)は表示しない)

}
