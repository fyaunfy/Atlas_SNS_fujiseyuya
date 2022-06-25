<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    // フォロー、フォロワー数を取得

    // public function getFollowCount()
    // {
    //     return DB::table('follows')
    //         ->selectRaw('COUNT(following_id) AS count_follow')
    //         ->get();
    // }



    // public function getFollowerCount($user_id)
    // {
    //     return $this->where('followed_id',  $user_id)->count();
    // }
}
