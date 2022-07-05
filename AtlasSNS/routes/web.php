<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


// middlewareはログインしているかをチェックする。 
// ->name()で名前をつけることができる ルーティングの処理が変わっても名前は変わらないので影響はない。
// nameにloginとすることで未認証の場合loginに返す
// guestはログインしていない時 未認証
Route::group(['middleware' => 'guest'], function() {
//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

});



// middlewareはログインしているかをチェックする。
// authはログインしているとき 認証
Route::group(['middleware' => 'auth'], function() {

// 登録後のページ・ログインはしていない。
Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');

// 削除ボタン
Route::get('/top/{id}/delete','PostsController@delete');
// 投稿
Route::post('/top','PostsController@post');

//update
Route::post('/update', 'PostsController@update');


Route::get('/profile','UsersController@profile');

Route::get('/profile','UsersController@profileOld');

// ユーザー検索
Route::get('/search','UsersController@users');
Route::post('/search','UsersController@search');
Route::get('/search','UsersController@search');


Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');



Route::get('/logout', 'Auth\LoginController@logout');

});


