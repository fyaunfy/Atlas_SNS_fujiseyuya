@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'top']) !!}

     <div class="form-group">
        <img class="logo" src="{{ \Storage::url(Auth::user()->images) }}">
         {!! Form::input('text', 'newPost', null, ['required', 'class' => 'post-input' ,'placeholder' => '投稿内容を入力してください']) !!}
         <button type="submit" class="post-submit"><img src="{{ asset('images/post.png')}}"></button>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

     </div>

 {!! Form::close() !!}



 @foreach ($list as $list)


    <!-- フォローしているユーザーとログインしているユーザーだけ表示 -->
    @if (Auth::user()->isFollowing($list->user_id) || Auth::user()->id == $list->user_id)
    <ul class="post-contents">
        <li class="post-content1"><figure><img class="logo" src="{{ \Storage::url($list->images) }}"></figure></li>
        <li class="post-content2">
            <p>{{ $list->username }}</p>
            <p>{{ $list->post }}</p>
        </li>

        <li class="post-content3">
            <p>{{ $list->created_at }}</p>
        <!-- ログインしているユーザーのIDとuser_idは一緒の場合削除ボタンを表示 -->
        @if (Auth::user()->id  == $list->user_id)

            <div class="edit-box">
                <!-- モーダルを開くボタン -->
                <div>
                <!-- 投稿の編集ボタン -->
                    <a class="js-modal-open" href="/top/{{$list->id}}/update-form" post="{{ $list->post }}" post_id="{{ $list->id }}">
                    <img src="{{ asset('images/edit.png')}}">
                    </a>
                </div>
                    <!-- 削除ボタン -->
                <div>
                    <a class="trash" href="/top/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
                    <img src="{{ asset('images/trash-h.png')}}">
                    </a>
                </div> 
            </div>
        </li>
        @endif
        </ul>
    @endif


@endforeach

   <!-- モーダルの中身 -->
   <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            {!! Form::open(['url' => 'update']) !!}
            <div class="textbox">
                <textarea name="upPost" class="modal_post"></textarea>
                <!-- 値を渡す時にはvalue nameは紐付け -->
                <input type="hidden" name="id" class="modal_id" value="">
            
                <input type="image" src="{{ asset('images/edit.png')}}" name="submit" value="更新" class="up-submit">
            </div>
            {!! Form::close() !!}
           <a class="js-modal-close" href="">✖︎</a>
        </div>
    </div>

@endsection