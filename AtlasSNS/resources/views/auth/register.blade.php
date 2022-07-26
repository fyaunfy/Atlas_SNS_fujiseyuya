@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/register', 'class' => 'login-contents']) !!}
{{Form::token()}}
<div class="login-box">
    <h2 class="login-welcom">新規ユーザー登録</h2>

    <div class="login-input-contents">
        {{ Form::label('ユーザー名') }}
        {{ Form::text('username',null,['class' => 'input']) }}

        @if ($errors->has('username'))
            <p>{{$errors->first('username')}}</p>
        @endif

        {{ Form::label('メールアドレス') }}
        {{ Form::text('mail',null,['class' => 'input']) }}

        @if ($errors->has('mail'))
            <p>{{$errors->first('mail')}}</p>
        @endif

        {{ Form::label('パスワード') }}
        {{ Form::text('password',null,['class' => 'input']) }}

        @if ($errors->has('password'))
            <p>{{$errors->first('password')}}</p>
        @endif

        {{ Form::label('パスワード確認') }}
        {{ Form::text('password_confirmation',null,['class' => 'input']) }}

        @if ($errors->has('password'))
            <p>{{$errors->first('password')}}</p>
        @endif
    </div>
    {{ Form::submit('登録',['class' => 'login-submit']) }}

    <p><a class="login-register" href="/login">ログイン画面へ戻る</a></p>
</div>
{!! Form::close() !!}


@endsection
