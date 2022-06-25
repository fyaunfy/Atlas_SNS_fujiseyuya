<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// これがないとコントローラーでAuthは使えない。
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // 初期の関数
    // public function index(){
    //     return view('posts.index');
    // }
    public function index(){

        //一つはデータベースからデータを取りにいく記述
        // postsテーブルからすべてのレコード情報をゲットする
        // desc で投稿の順を新しいものが上に表示する
        $list = \DB::table('posts')
        // 第一引数は結合したいテーブル
        ->join('users','posts.user_id','=','users.id')
        ->orderBy('posts.created_at', 'desc')
        ->select('posts.id','posts.user_id','users.id')
        ->get();
        // $list = \App\Post::all();

        return view('posts.index')->with('list',$list);

        // postsディレクトリにあるindex.blade.phpに渡す
        // return view('posts.index',['list'=>$list]);
    }
    // public function orderBy(){

    //     //一つはデータベースからデータを取りにいく記述
    //     // postsテーブルからすべてのレコード情報をゲットする
    //     // desc で投稿の順を新しいものが上に表示する
    //     $list = \DB::table('posts')
    //     ->orderBy('posts.created_at', 'desc')
    //     ->get();

    //     // postsディレクトリにあるindex.blade.phpに渡す
    //     return view('posts.index',['list'=>$list]);
    // }




        /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // バリデーションメソッドの作成 ルール定義
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'post' => 'required|string|max:150',
        ]);
    }
    // $this->validator($data); にまとめてあるものにあたる



    // ブラウザに表示されない、登録処理だけを行う
    public function post(Request $request)
    {
        if($request->isMethod('post')){

            // ユーザーIDを取得
            $user_id = Auth::id();
            // フォームで取った値を$postに入れる
            $post = $request->input('newPost');


            \DB::table('posts')
            ->insert([
                'post' => $post,
                'user_id' => $user_id
            ]);

            // view〜だとindexメソッドで書いた処理をこちらにも書かなくてはいけないから
            // redirectで省略する
            return redirect('/top');
        }

    }

    public function delete($id)
    {

        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }




}
