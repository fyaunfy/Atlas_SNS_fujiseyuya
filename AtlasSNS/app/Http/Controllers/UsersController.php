<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// バリデーションを使用するときに記述
use Illuminate\Support\Facades\Validator;

use App\User; //  userモデルを使用するときに必要

// これがないとコントローラーでAuthは使えない。
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage; // Storageの機能を使用することができる

// use App\Models\Memo;
// use DB;

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
        // $user->password = bcrypt($request->input('password'));
        // 上記のようにすると、更新するたびにパスワードが変更される。
        $user->password = $request->input('password');
        $user->bio = $request->input('bio');


        // 画像がstorageに入っていればtrueを返す。
        // isset 値が入っているかを判断する関数 NULLも入れてしまうため、注意。
        if(isset($request->images)) {
            // storage/app/public配下にアップロード
            $user->images = $request->images->store('public/images'); 
            // dd($request->images);
        } 

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

    



    // ユーザーページ
    public function users(){

        //一つはデータベースからデータを取りにいく記述
        // usersテーブルからすべてのレコード情報をゲットする
        $list = \DB::table('users')
        ->get();
        // usersディレクトリにあるusers.blade.phpに渡す
        return view('users.search',['list'=>$list]);
    }

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


}


// @if (isset($request->images))
// <img class="logo" src="{{ \Storage::url($list->images) }}">
// @endif