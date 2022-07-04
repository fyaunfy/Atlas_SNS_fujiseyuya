<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// フォロー機能 こちらを追加 モデル
use App\User;
use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }


    // フォロー機能
    public function follow(User $user) {
        $follow = FollowUser::create([
            // フォローするのは当然自分なので(Auth)認証ユーザー＝フォローユーザー
            'following_id' => \Auth::user()->id,
            // 暗黙の結合などを使ってフォローされる相手のIDを$user->idで取得できるようにする
            'followed_id' => $user->id,
        ]);

        // フォローされているユーザーの数をcountして取得
        $followCount = count(FollowUser::where('followed_id', $user->id)->get());
        return response()->json(['followCount' => $followCount]);
    }

    // unfollowはFollowインスタンスを取得して削除する機能
    public function unfollow(User $user) {
        $follow = FollowUser::where('following_id', \Auth::user()->id)->where('followed_id', $user->id)->first();
        $follow->delete();
        $followCount = count(FollowUser::where('followed_id', $user->id)->get());

        return response()->json(['followCount' => $followCount]);
    }


}
