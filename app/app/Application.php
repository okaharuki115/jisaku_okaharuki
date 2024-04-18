<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //テーブル結合(user_idとid) 
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
    //テーブル結合(post_idとid) 
    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }
}
