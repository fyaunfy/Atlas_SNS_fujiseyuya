<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// validator
use Illuminate\Support\Facades\Validator;
// これがないとコントローラーでAuthは使えない。
use Illuminate\Support\Facades\Auth;

use App\Post; //  postモデルを使用するときに必要

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
        ->select('posts.*','posts.user_id','users.username')
        ->get();

        // postsディレクトリにあるindex.blade.phpに渡す
        return view('posts.index')->with('list',$list);
    }

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
            'post' => 'required|string|max:6',
        ]);
    }
    // $this->validator($data); にまとめてあるものにあたる


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Post
     */
    // 新規登録 DBに情報を送る
    protected function create(array $data)
    {
        return Post::create([
            'post' => $data['post'],
        ]);
    }


    // ブラウザに表示されない、登録処理だけを行う
    public function post(Request $request)
    {
        
        if($request->isMethod('post')){
            // 空の$dataに inputで入力した値を入れる
            // $data = $request->input();
            
            // フォームで取った値を$postに入れる
            $data = $request->input('newPost');
            
            // ユーザーIDを取得
            $user_id = Auth::id();

            // // バリデーションメソッドを$validatorの変数に入れる
            // $validator = $this->validator($data);

            // dd($validator);
            
            // // もし$validatorの値のルールと送られていた値が違ったらtopに返す。
            // // エラー文も送る。
            // if ($validator->fails()) {
            //     return redirect('/top')
            //         ->withErrors($validator)
            //         ->withInput();
            // }

            // // 新規登録を実行
            // $this->create($data);

            \DB::table('posts')
            ->insert([
                'post' => $data,
                'user_id' => $user_id
            ]);

            // view〜だとindexメソッドで書いた処理をこちらにも書かなくてはいけないから
            // redirectで省略する
            return redirect('/top');
        }


    }

    public function updateForm($id)
    {
        $list = \DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.index', compact('post'));
    } 
    
    //{!! Form::hidden('id', $post->id, ['required', 'class' => 'modal_id']) !!}
    //{!! Form::input('textarea', 'upPost', $post->post, ['required', 'class' => 'modal_id']) !!}
    public function update(Request $request)
    {
        
        $id = $request->input('id');
        // $id = $request->id;
        dd($id);
        // name属性が「upPost」「id」で指定されているフォームのテキストを、別々の変数で取得
        $up_post = $request->input('upPost');
        
        // 「\DB::~~」と書かれている箇所です。改行されていますが、最後に「->update();」と書かれているので、postsテーブルのレコードをここで更新
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['post' => $up_post]
            );

        return redirect('/top');
    }

    // 削除機能
    public function delete($id)
    {

        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }




}
