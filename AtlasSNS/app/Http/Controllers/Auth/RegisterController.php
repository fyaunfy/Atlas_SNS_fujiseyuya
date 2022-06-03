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
    // バリデーションメソッドの作成 定義
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:6',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // 新規登録
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }



    // バリデーション
    public function register(Request $request){
        if($request->isMethod('post')){

            // 空の$dataに inputで入力した値を入れる
            $data = $request->input();
            // $requestの中に$dataの中身が入る
            
            // バリデーションメソッドを$validatorの変数に入れる
            $validator = $this->validator($data);
     
            // もし$validatorの値のルールと送られていた値が違ったらregisterに返す。
            // エラー文も送る。
            if ($validator->fails()) {
                return redirect('/register')
                    ->withErrors($validator)
                    ->withInput();
            }

            $this->create($data);
        
            //全ての処理が終わったらURLのaddedに移行
            return redirect('added');

        }

        return view('auth.register');
    }
    // 処理が終わったらaddedに返す。
    public function added(){
        return view('auth.added');
    }


}
