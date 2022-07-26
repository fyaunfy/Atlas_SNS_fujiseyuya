@extends('layouts.login')

@section('content')

<!--ファサード
第一引数：name属性の値
第二引数：value属性の値
第三引数：「class」「placeholder」など追加の属性 -->
{!! Form::open(['url' => '/profile', 'method' => 'PUT' ,'enctype' => 'multipart/form-data']) !!}
{{Form::token()}}


<ul class="profile-contens">

<div class="profile-logo">
<img class="logo" src="{{ \Storage::url(Auth::user()->images) }}">
</div>

@foreach ($list as $list)
@if (Auth::user()->id  == $list->id)

<li class="username-list">

{{ Form::label('ユーザー名') }}
<!-- 入力値を表示 -->
<input type="text" class="input-text" name="username" value="{{ $list->username }}" />
</li>
@if ($errors->has('username'))
    <p>{{$errors->first('username')}}</p>
@endif

<li class="mail-list">
{{ Form::label('メールアドレス') }}

<input type="text" class="input-text" name="mail" value="{{ $list->mail }}" />

</li>
@if ($errors->has('mail'))
    <p>{{$errors->first('mail')}}</p>
@endif

<li class="pass-list">
{{ Form::label('パスワード') }}

<input type="password" class="input-text" name="password" value="" />

</li>
@if ($errors->has('password'))
    <p>{{$errors->first('password')}}</p>
@endif

<li class="pass-confirmation-list">
{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',['class' => 'input-text']) }}
</li>
@if ($errors->has('password'))
    <p>{{$errors->first('password')}}</p>
@endif

<li class="bio-list">
{{ Form::label('bio') }}
{{ Form::text('bio', $list->bio ,['class' => 'input-text']) }}
</li>
@if ($errors->has('bio'))
    <p>{{$errors->first('bio')}}</p>
@endif

<li class="images-list">
{{ Form::label('images') }}
<div class="images-label">
    <input class="input-images" id="images" name="images" type="file" value="$list->images">
    <div>
        <p>ファイルを選択</p>   
    </div> 
</div>
</li>
@if ($errors->has('images'))
    <p>{{$errors->first('images')}}</p>
@endif

@endif
@endforeach

{{ Form::submit('更新',['class' => 'profile-submit']) }}

</ul>

{!! Form::close() !!}

@endsection