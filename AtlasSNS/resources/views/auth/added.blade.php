@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="login-contents">
    <div class="login-box">
      <p class="login-welcom">{{ $username }}さん。</p>
      <p class="login-welcom">ようこそ！AtlasSNSへ！</p>
      <p class="login-register">ユーザー登録が完了しました。<br>
      早速ログインをしてみましょう。
      </p>
      <p class="add-btn"><a href="/login">ログイン画面へ</a></p>
    </div>
  </div>




</div>

@endsection