<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['id','user_id','post'];
    
    // //リレーション
    // // postとuserを結びつける
    // // １つの記事の投稿者は１人しか存在しない。
    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }

}
