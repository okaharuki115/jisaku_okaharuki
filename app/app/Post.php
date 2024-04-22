<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //テーブル結合(user_idとid) 
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    
}
