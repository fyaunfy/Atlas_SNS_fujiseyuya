<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['following_id', 'followed_id'];
    // テーブル
    protected $table = 'follows';


    // public function getFollowCount($id)
    // {
    //     return $this->where('following_id', $id)->count();
    // }

    // public function getFollowerCount($id)
    // {
    //     return $this->where('followed_id', $id)->count();
    // }
    
}
