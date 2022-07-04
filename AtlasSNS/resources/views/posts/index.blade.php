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
        @if ($errors->has('post'))
        <p>{{$errors->first('post')}}</p>
        @endif
        <td>{{ $list->created_at }}</td>
        <!-- ログインしているユーザーのIDとuser_idは一緒の場合削除ボタンを表示 -->
        @if (Auth::user()->id  == $list->user_id)
        <!-- <td><a href="/top/{{$list->id}}/update">更新</a></td> -->

        <!-- モーダルを開くボタン -->
        <td><div class="content">
        <!-- 投稿の編集ボタン -->
        <a class="js-modal-open" href="/top/{{$list->id}}/update-form" post="{{ $list->post }}" id="{{ $list->id }}">編集</a>
        </div></td>
        <!-- 削除ボタン -->
        <td><a href="/top/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td> 
        @endif
 
    </tr>
@endforeach

   <!-- モーダルの中身 -->
   <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            {!! Form::open(['url' => 'top']) !!}

                <textarea name="upPost" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
            
                <input type="submit" value="更新">

            {!! Form::close() !!}
           <a class="js-modal-close" href="">閉じる</a>
        </div>
    </div>

</table>

@endsection