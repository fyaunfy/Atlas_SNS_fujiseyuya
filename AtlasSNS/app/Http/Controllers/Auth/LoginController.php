<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // ログアウト
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }

    // ログインの処理
    public function login(Request $request){
        if($request->isMethod('post')){

            $data=$request->only('mail','password');
     
            // もし$validatorの値のルールと送られていた値が違ったらloginに返す。
            // エラー文も送る。
            if ($data->fails()) {
                return redirect('/login')
                    ->withErrors($data)
                    ->withInput();
            }

            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){

                // 認証に成功したらtopページにいく
                return redirect('/top');
            }
        }
        return view("auth.login");
    }


    // ログアウトした時はloginページに飛ぶ
    protected function loggedOut(\Illuminate\Http\Request $request) {
        return redirect('login');
        }
}
