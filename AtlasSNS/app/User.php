<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // 画像アップロードにもこちらは重要
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



        // 多対多
        // 第一引数には使用するモデル
        // 第二引数には使用するテーブル名
        // 第三引数にはリレーションを定義しているモデルの外部キー名
        // 第四引数には結合するモデルの外部キー名

        // フォロー→フォロワー
        public function following()
        {
            return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
        }
    
        // フォロワー→フォロー
        public function followed()
        {
            return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
        }

}
