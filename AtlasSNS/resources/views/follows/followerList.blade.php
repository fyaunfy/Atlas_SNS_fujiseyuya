@extends('layouts.login')

@section('content')

<ul class="form-group">

<h3 class="follow-title">Follower List</h3>
   <li class="follow-list-contens">
@foreach ($list as $list)

    <!-- フォローしているユーザーのアイコン一覧 -->
    @if (Auth::user()->isFollowed($list->id))
        <a class="follow-list-images" href="/profile/{{$list->id}}/others-profile">
        <figure><img class="logo" src="{{ \Storage::url($list->images) }}"></figure>
        </a>  
    @endif
  
@endforeach
</li>
</ul>

<ul>
@foreach ($followList as $followList)
    @if (Auth::user()->isFollowed($followList->user_id)) 
    <li class="follow-list-box">
        <a href="/profile/{{$list->id}}/others-profile">
            
        <figure class="post-content1"><img class="logo" src="{{ \Storage::url($followList->images) }}"></figure>
        </a>  
        <div class="follow-user">{{ $followList->username }}<br><br>
        {{ $followList->post }} 
        </div>   
        <p class="follow-created">{{ $followList->created_at }}</p> 
    </li> 
    @endif
@endforeach
</ul>


@endsection