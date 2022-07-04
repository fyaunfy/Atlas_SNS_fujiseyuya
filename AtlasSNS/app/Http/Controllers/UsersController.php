<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




use App\User; //  userモデルを使用するときに必要

class UsersController extends Controller
{
    //プロフィールを表示
    public function profile(){
        return view('users.profile');
    }

    public function profileOld(){
        $list = \DB::table('users')
        ->get();

        return view('users.profile')->with('list',$list);
    }





    public function showUsers() {
       
        $users = User::where("id" , "!=" , Auth::user()->id);

        return view('users.search', compact('users'));
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
            

            // クエリ生成 <- よう勉強。
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
