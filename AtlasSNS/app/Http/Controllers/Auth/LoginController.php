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

    // ログインの処理
    public function login(Request $request){
        if($request->isMethod('post')){

            // mail,passwordだけ空の$dataに入れる。
            $data=$request->only('mail','password');

            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){

                // 認証に成功したらtopページにいく
                return redirect('/top');
            }
        }
        // 処理が終わったらloginページに表示する。
        return view("auth.login");
    }


    // ログアウトした時はloginページに飛ぶ
    protected function loggedOut(\Illuminate\Http\Request $request) {
        return redirect('login');
        }
}
