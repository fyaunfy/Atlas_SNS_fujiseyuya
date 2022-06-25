@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'top']) !!}
     <div class="form-group">
         {!! Form::input('text', 'newPost', null, ['required', 'placeholder' => '投稿内容']) !!}
     </div>
     <button type="submit">投稿</button>
 {!! Form::close() !!}

<table>

@foreach ($list as $list)
    <tr>
    

        <td>{{ $list->username }}</td>
        <td>{{ $list->post }}</td>
        <td>{{ $list->created_at }}</td>
        <!-- ログインしているユーザーのIDとuser_idは一緒の場合削除ボタンを表示 -->
        @if (Auth::user()->id  == $list->user_id)
        <td><a href="/top/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td> 
        @endif
 
    </tr>
@endforeach

</table>

@endsection