<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // public function posts()
    // {
    //     //リレーション
    //     // postとuserを結びつける
    //     // ユーザー（投稿者）は複数の記事を投稿できる。
    //     // 「１対多」の「多」側 → メソッド名は複数形
    //     return $this->hasMany('App\Post')->orderBy('created_at', 'desc');
    // }

}
