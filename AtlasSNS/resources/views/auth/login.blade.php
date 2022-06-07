@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/login']) !!}
{{Form::token()}}
<p>AtlasSNSへようこそ</p>

{{ Form::label('e-mail') }}
{{ Form::text('mail',null,['class' => 'input']) }}

@if ($errors->has('mail'))
    <p>{{$errors->first('mail')}}</p>
@endif

{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

@if ($errors->has('password'))
    <p>{{$errors->first('password')}}</p>
@endif

{{ Form::submit('ログイン') }}

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection