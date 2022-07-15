<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// バリデーションを使用するときに記述
use Illuminate\Support\Facades\Validator;

use App\User; //  userモデルを使用するときに必要
use App\Follow;

// これがないとコントローラーでAuthは使えない。
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage; // Storageの機能を使用することができる

class UsersController extends Controller
{

    // プロフィール表示
    //既存の情報を入力フォームの初期値に設定
    public function profile(){
        $list = \DB::table('users')
        ->get();
        return view('users.profile')->with('list',$list);
    }

    // //アップロード
    public function profileUp(Request $request){

        $user = Auth::user();

        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->password = bcrypt($request->input('password'));

        // 画像がstorageに入っていればtrueを返す。
        // isset 値が入っているかを判断する関数 NULLも入れてしまうため、注意。
        if(isset($request->images)) {
            // storage/app/public配下にアップロード
            $user->images = $request->images->store('public/images'); 
            // dd($request->images);
        } 

        $user->bio = $request->input('bio');

        $rules = [
            // バリデーションルール定義
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40',
            'password' => 'required|string|min:4|max:20|confirmed',
            'bio' => 'max:150',
            'images' => 'file|mimes:png,jpg,bmp,gif,svg',
              ];
        // 引数の値がバリデートされればリダイレクト、されなければ引き続き処理の実行
        $this->validate($request, $rules);
        
        $user->save();

        return redirect('profile');
    }

    // $id,
    // $user_id
    public function othersProfile($id,$user_id){

        $images = \DB::table('users')
        ->where('id',$id)
        // 一つの情報だけを取得する場合はfindを使う。
        ->get();

       

        $list = \DB::table('posts')
        // 第一引数は結合したいテーブル
        ->join('users','posts.user_id','=','users.id')
        ->where('user_id',$user_id)
        ->orderBy('posts.created_at', 'desc')
        ->select('posts.*','posts.user_id','users.username','users.images')
        ->get();

      

        return view('users.othersProfile',['list'=>$list, 'images' => $images]);
        // return view('users.othersProfile',['images' => $images]);
        // return view('users.othersProfile',['list' => $list]);
    }

    // <table>
    // @foreach ($images as $images)
    // @if ($images->id)
    // <tr>
    // <td><figure><img class="logo" src="{{ \Storage::url($images->images) }}"></figure></td>
    // <td>{{ $images->username }}:</td>
    // <td>{{ $images->bio }}</td>
    
    //     <!-- ログインしているユーザーが他のユーザーをフォローしている時 -->
    //     @if (Auth::user()->isFollowing($images->id))
    //     <td><a href="/search/{{$images->id}}/unfollow">フォロー解除</a></td>        
    //     @else
    //     <td><a href="/search/{{$images->id}}/follow">フォローする</a></td> 
    //     @endif
    
    // </tr>
    // @endif
    // @endforeach
    // </table>

// @foreach ($list as $list)
// <table>
// @if ($list->user_id)
// <tr>
// <td><figure><img class="logo" src="{{ \Storage::url($list->images) }}"></figure></td>
// <td><p>{{ $list->username }}：</p></td> 
// <td><p>{{ $list->post }}：</p></td> 
// </tr>
// @endif
// </table>
// @endforeach
    

    // ブラウザに表示されない、登録処理だけを行う
    public function search(Request $request)
    {
            // ismethodを使わないでしたらできました。
            // inputで送られてきた情報を＄search に代入。
            $search = $request->input('search');
            
             // userモデル使用
            $query = User::query();
            
            // もし$searchが空ではない場合
            if(!empty($search))
            {
                // 曖昧検索 whereでどれかを指定
                $query->where('username','like','%'.$search.'%');
            }
            // $listに$queryで取得したデータを代入
            $list = $query->get();

            // 検索した結果を表示 
            $result = $request->input('search');
            //viewで表示。
            return view('users.search',['list'=>$list])->with('result',$result);
    }


    // public function count(Follow $user_id) {
        
    //     $follow_count = $follower->getFollowCount($user->id);
    //     $follower_count = $follower->getFollowerCount($user->id);

    //     return view('layouts.login', ['follow_count'   => $follow_count,'follower_count' => $follower_count]);
    // }

}