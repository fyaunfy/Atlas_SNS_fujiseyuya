@extends('layouts.login')

@section('content')

<p>ユーザー検索入力フォーム</p>

{!! Form::open(['url' => 'search']) !!}
     <div class="form-group">
         
         <input type="search" class="form-control mr-sm-2" name="search"  value="{{request('search')}}" placeholder="キーワードを入力">
     </div>
     <button type="submit">送信</button>
 {!! Form::close() !!}



 <table>

 <p>検索したワードを表示</p>
    <p>{{ $result }}</p>
    <br>
    <p>ユーザー検索結果一覧</p>
@foreach ($list as $list)
    <tr>
    <!-- ログインしているユーザーのIDとuserのIDが一緒ではない場合 -->
    @if (Auth::user()->id  != $list->id)
        <td>{{ $list->username }}</td>
    @endif
    </tr>
    
@endforeach
</table>



@endsection