@extends('layouts.login')

@section('content')


{!! Form::open(['url' => 'search']) !!}
     <div class="form-group">
         <input type="search" class="form-control mr-sm-2 search-input" name="search"  value="{{request('search')}}" placeholder="ユーザー名">
         <button type="submit" class="search-submit"><img src="{{ asset('images/post.png')}}"></button>

         <p>{{ $result }}</p>
     </div>

 {!! Form::close() !!}




<div class="search-box">
@foreach ($list as $list)
<ul class="search-table">
    <!-- ログインしているユーザーのIDとuserのIDが一緒ではない場合 -->
    @if (Auth::user()->id  != $list->id)
        <li class="search-list-name" ><img class="logo" src="{{ \Storage::url($list->images) }}">{{ $list->username }}</li>
    <!-- ログインしているユーザーが他のユーザーをフォローしている時 -->
        @if (Auth::user()->isFollowing($list->id))
        <li class="follow-btn-list"><div class="unfollow-btn"><a href="/search/{{$list->id}}/unfollow">フォロー解除</a></div></li>        
        @else
        <li><a class="follow-btn" href="/search/{{$list->id}}/follow">フォローする</a></> 
        @endif

    @endif
</ul>   
@endforeach

</div>


@endsection