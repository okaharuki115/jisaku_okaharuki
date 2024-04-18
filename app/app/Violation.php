<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    //テーブル結合(user_idとid)    
                   //↓関数の名前なので何でも良い(分かりやすいようにテーブルの名前から取ってる)
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
                                //↑「app＞User.phpとの結合」
    }

    //テーブル結合(post_idとid) 
    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }
}
