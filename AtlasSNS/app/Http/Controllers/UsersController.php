<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// バリデーションを使用するときに記述
use Illuminate\Support\Facades\Validator;

use App\User; //  userモデルを使用するときに必要

use Illuminate\Support\Facades\Storage; // Storageの機能を使用することができる

class UsersController extends Controller
{
    //プロフィールを表示
    public function profile(){
        return view('users.profile');
    }

    //既存の情報を入力フォームの初期値に設定
    public function profileOld(){
        $list = \DB::table('users')
        ->get();
        return view('users.profile')->with('list',$list);
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



    // \DB::table('users')
    // ->insert([
    //     'username' => $username
    // ]);


}
