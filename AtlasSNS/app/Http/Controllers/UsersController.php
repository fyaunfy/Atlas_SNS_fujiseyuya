<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Post; // こちらを追加 UsercontrollerでPostモデルを使うよと宣言

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    // public function index(){

    //     //一つはデータベースからデータを取りにいく記述
    //     // postsテーブルからすべてのレコード情報をゲットする
    //     // desc で投稿の順を新しいものが上に表示する
    //     // $list = \DB::table('posts')
    //     // ->join('users', 'posts.user_id', '=', 'users.id')
    //     // ->orderBy('posts.created_at', 'desc')
    //     // ->get();

    //     $list = \DB::table('users')
    //     // ->join('users', 'posts.user_id', '=', 'users.id')
    //     // ->orderBy('posts.created_at', 'desc')
    //     ->get();

    //     // postsディレクトリにあるindex.blade.phpに渡す
    //     return view('posts.index',['list'=>$list]);
    // }


    // ユーザーページ
    public function search(){

        //一つはデータベースからデータを取りにいく記述
        // usersテーブルからすべてのレコード情報をゲットする
        $list = \DB::table('users')
        ->get();
        // usersディレクトリにあるusers.blade.phpに渡す
        return view('users.search',['list'=>$list]);
    }

    // ブラウザに表示されない、登録処理だけを行う
    public function users(Request $request)
    {
        if($request->isMethod('post')){

            // キーワード受け取り
            $keyword = $request->input('keyword');
            
            // クエリ生成
            $query = User::query();
            
            // もしキーワードがあったら
            if(!empty($keyword))
            {
                $query
                ->where('username','like','%'.$keyword.'%');
            }
            
            // ページネーション
            $data = $query->orderBy('created_at','desc')->paginate(10);
            return view('users.search')->with('data',$data)
            ->with('keyword',$keyword)
            ->with('message','ユーザーリスト');

            // return redirect('search');
        }

    }


}
