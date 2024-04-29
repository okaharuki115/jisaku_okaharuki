<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //データ書きかえを許可するための記述(6-2P10参照)
    protected $fillable = ['title', 'anount', 'content','image'];

    //テーブル結合(user_idとid) 
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
