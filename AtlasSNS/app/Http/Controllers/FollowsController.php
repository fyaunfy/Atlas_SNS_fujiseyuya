<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// これがないとコントローラーでAuthは使えない。
use Illuminate\Support\Facades\Auth;

// フォロー機能 こちらを追加 モデル
use App\User;
use App\Follow;



// 中間テーブル 誰が誰をフォローしているか/されているかの関係性をデータとして登録するために必要なテーブル
class FollowsController extends Controller
{
    //フォローリスト
    public function followList(){

        $list = \DB::table('users')
        ->get();

        //一つはデータベースからデータを取りにいく記述
        // postsテーブルからすべてのレコード情報をゲットする
        // desc で投稿の順を新しいものが上に表示する
        $followList = \DB::table('posts')
        // 第一引数は結合したいテーブル
        ->join('users','posts.user_id','=','users.id')
        ->orderBy('posts.created_at', 'desc')
        ->select('posts.*','posts.user_id','users.username','users.images')
        ->get();
      
        return view('follows.followList',['list'=>$list, 'followList'=>$followList]);
    }


    //フォロワーリスト
    public function followerList(){
        $list = \DB::table('users')
        ->get();

        $followList = \DB::table('posts')
        // 第一引数は結合したいテーブル
        ->join('users','posts.user_id','=','users.id')
        ->orderBy('posts.created_at', 'desc')
        ->select('posts.*','posts.user_id','users.username','users.images')
        ->get();

        return view('follows.followerList',['list'=>$list, 'followList'=>$followList]);
    }



    // フォロー機能
    public function follow(User $user,$id) {
        // $userにデータを渡す
        $user = User::find($id); 
        // dd($user);

        // フォローするのはログインユーザーのため、ログインユーザーの情報を代入
        $follower = Auth::user();
        // dd($follower);

        // followsテーブルのfollowing_idなどに入れたいため userのIDを入れなくてはならない。
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        // dd($user->id);


        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return redirect('/search');
        }

        // フォローされているユーザーの数をcountして取得
        // $followCount = count(Follow::where('followed_id', $user->id)->get());
        return redirect('/search');
    }

    // unfollowはFollowインスタンスを取得して削除する機能
    // フォロー解除
    public function unfollow(User $user,$id) {

        // $userにデータを渡す
        $user = User::find($id); 

        $follower = Auth::user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return redirect('/search');
        }
        return redirect('/search');
    }

}
