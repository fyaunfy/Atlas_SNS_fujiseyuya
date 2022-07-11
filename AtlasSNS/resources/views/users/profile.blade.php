@extends('layouts.login')

@section('content')

<!--ファサード
第一引数：name属性の値
第二引数：value属性の値
第三引数：「class」「placeholder」など追加の属性 -->
{!! Form::open(['url' => '/profile', 'method' => 'PUT' ,'enctype' => 'multipart/form-data']) !!}
{{Form::token()}}
<h2>プロフィール画面</h2>

@foreach ($list as $list)
@if (Auth::user()->id  == $list->id)
{{ Form::label('ユーザー名') }}

<!-- 入力値を表示 -->
<input type="text" name="username" value="{{ $list->username }}" />

@if ($errors->has('username'))
    <p>{{$errors->first('username')}}</p>
@endif


{{ Form::label('メールアドレス') }}

<input type="text" name="mail" value="{{ $list->mail }}" />

@if ($errors->has('mail'))
    <p>{{$errors->first('mail')}}</p>
@endif

{{ Form::label('パスワード') }}

<input type="text" name="password" value="" />

@if ($errors->has('password'))
    <p>{{$errors->first('password')}}</p>
@endif


{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

@if ($errors->has('password'))
    <p>{{$errors->first('password')}}</p>
@endif


{{ Form::label('bio') }}
{{ Form::text('bio', $list->bio ,['class' => 'input']) }}

@if ($errors->has('bio'))
    <p>{{$errors->first('bio')}}</p>
@endif

{{ Form::label('images') }}
<input class="input" id="images" name="images" type="file" value="$list->images">

@if ($errors->has('images'))
    <p>{{$errors->first('images')}}</p>
@endif

@endif
@endforeach

{{ Form::submit('更新') }}



{!! Form::close() !!}



@endsection