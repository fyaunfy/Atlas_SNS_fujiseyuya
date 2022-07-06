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

    //アップロード
    public function profileUp(Request $request){

        // $id = $request->input('id');
        // $username = $request->input('username');
        // $mail = $request->input('mail');
        // $password = $request->input('password');
        // $password_confirmation = $request->input('password_confirmation');
        // $bio = $request->input('bio');

          
       

        $user = Auth::user();
        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->password = bcrypt($request->input('password'));
        $user->bio = $request->input('bio');
        // storage/app/public配下にアップロード
        $user->images = $request->images->store('public/images');

        $user->save();



        // // 画像がアップロードされていれば、storageに保存
        if(empty($user->images)) {
            // なければnullを指定して、何も保存しない。
            $user->images = null;
        }

        //もう一つの方法

        // $data = $request->all();
        // $images = $request->file('images');
        // // // dd($images);

        // if($request->hasFile('images')) {
        //     $path = \Storage::put('/public', $images);
        //     $path = explode('/', $path);
        // } else {
        //     $path = null;
        // }

        // $memo_id = Memo::insertGetId([
        //     'images' => $path[1],
        // ]);




        // if ($validator->fails()) {
        //     return redirect('/register')
        //         ->withErrors($validator)
        //         ->withInput();
        // }
       
        // dd($user);

        // $rules = [
        //     // バリデーションルール定義
        //     'username' => 'string|max:6',
        //     'mail' => 'string|email|max:255|unique:users',
        //     'password' => 'string|min:4|confirmed',
        //     'bio' => 'string|max:400',
        //       ];
        // // 引数の値がバリデートされればリダイレクト、されなければ引き続き処理の実行
        // $validator = $this->validate($request, $rules);

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
