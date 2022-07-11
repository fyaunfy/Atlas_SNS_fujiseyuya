<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'username' => 'required|string|max:6',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }
    // $this->validator($data); にまとめてあるものにあたる

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // 新規登録 DBに情報を送る
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            // bcrypt [暗号学的ハッシュ関数]、セキュリティ対策
            'password' => bcrypt($data['password']),
        ]);
    }



    // バリデーション
    public function register(Request $request){
        if($request->isMethod('post')){

            // 空の$dataに inputで入力した値を入れる
            $data = $request->input();
            
            // バリデーションメソッドを$validatorの変数に入れる
            $validator = $this->validator($data);
     
            // もし$validatorの値のルールと送られていた値が違ったらregisterに返す。
            // エラー文も送る。
            if ($validator->fails()) {
                return redirect('/register')
                    ->withErrors($validator)
                    ->withInput();
            }

            // 新規登録を実行
            $this->create($data);


            // 登録したユーザー名を変数に入れる
            $username = $request->input('username');
            // widthメソッドでControllerからviewへの変数の受け渡しをする。
            return view('auth.added')->with('username',$username);

        }

        // この処理をregisterに出力する
        return view('auth.register');

    }



    // addedを表示する。
    public function added(){

        return view('auth.added');
    }

}
