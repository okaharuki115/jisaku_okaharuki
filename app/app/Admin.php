<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;//追記
use Illuminate\Foundation\Auth\User as Authenticatable;//追記

//class Admin extends Model
class Admin extends Authenticatable//追記
{
    use Notifiable;//追記

    protected $guard = 'admin';//追記

    protected $fillable = [//追記
        'name', 'password',//追記
    ];

    protected $hidden = [//追記
        'password', 'remember_token',//追記
    ];
}
