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


    // // 1対多の多側 メソッド名は複数形
    // public function posts()
    // {
    //   return $this->hasMany('App\Post');
    // }



        // 多対多　リレーション設定
        // 第一引数には使用するモデル
        // 第二引数には使用するテーブル名
        // 第三引数にはリレーションを定義しているモデルの外部キー名
        // 第四引数には結合するモデルの外部キー名

        // フォロワー　→ フォロー
        public function followers()
        {
            return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
        }
        // フォロー -> フォロワー
        public function follows()
        {
            return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
        }


            // フォローする
        public function follow(Int $user_id) 
        {
            return $this->follows()->attach($user_id);
        }

        // フォロー解除する
        public function unfollow(Int $user_id)
        {
            return $this->follows()->detach($user_id);
        }

        // フォローしているか
        public function isFollowing(Int $user_id) 
        {
            return (boolean) $this->follows()->where('follows.followed_id', $user_id)->first(['users.id']);
        }

        // フォローされているか
        public function isFollowed(Int $user_id) 
        {
            return (boolean) $this->followers()->where('follows.following_id', $user_id)->first(['users.id']);
        }

}
