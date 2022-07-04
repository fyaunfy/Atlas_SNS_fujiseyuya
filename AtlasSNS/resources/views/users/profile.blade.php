@extends('layouts.login')

@section('content')

<!--ファサード
第一引数：name属性の値
第二引数：value属性の値
第三引数：「class」「placeholder」など追加の属性 -->
{!! Form::open(['url' => '/top']) !!}
{{Form::token()}}
<h2>プロフィール画面</h2>

{{ Form::label('ユーザー名') }}

@foreach ($list as $list)
@if (Auth::user()->id  == $list->id)
<!-- 入力値を表示 -->
<input type="text" name="username" value="{{ $list->username }}" />
@endif
@endforeach

@if ($errors->has('username'))
    <p>{{$errors->first('username')}}</p>
@endif


{{ Form::label('メールアドレス') }}

@foreach ($list as $list)
@if (Auth::user()->id  == $list->id)
<input type="text" name="mail" value="{{ $list->mail }}" />
@endif
@endforeach

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


{{ Form::label('bio') }}
{{ Form::text('bio',null,['class' => 'input']) }}


{{ Form::label('images') }}
{{Form::file('images', ['class'=>'input'])}}


{{ Form::submit('更新') }}

{!! Form::close() !!}

@endsection