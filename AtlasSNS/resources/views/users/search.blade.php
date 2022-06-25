@extends('layouts.login')

@section('content')

<p>ユーザー検索入力フォーム</p>

{!! Form::open(['url' => 'search']) !!}
     <div class="form-group">
         {!! Form::input('text', 'newPost', null, [ 'placeholder' => 'ユーザー名']) !!}
     </div>
     <button type="submit">送信</button>
 {!! Form::close() !!}



 <table>
@foreach ($list as $list)
    <tr>
        <td>{{ $list->username }}</td>
    </tr>
@endforeach
</table>



@endsection