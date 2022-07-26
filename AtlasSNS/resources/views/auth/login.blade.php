@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/login', 'class' => 'login-contents']) !!}
{{Form::token()}}
<div class="login-box">
    <p class="login-welcom">AtlasSNSへようこそ</p>

    <div class="login-input-contents">
        {{ Form::label('mail adress') }}
        {{ Form::text('mail',null,['class' => 'input']) }}

        @if ($errors->has('mail'))
            <p>{{$errors->first('mail')}}</p>
        @endif

        {{ Form::label('password') }}
        {{ Form::password('password',['class' => 'input']) }}

        @if ($errors->has('password'))
            <p>{{$errors->first('password')}}</p>
        @endif
    
    </div>

    {{ Form::submit('LOGIN',['class' => 'login-submit']) }}
    <p><a class="login-register" href="/register">新規ユーザーの方はこちら</a></p>
</div>
{!! Form::close() !!}

@endsection