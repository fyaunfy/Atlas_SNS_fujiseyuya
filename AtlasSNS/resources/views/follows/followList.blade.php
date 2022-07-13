@extends('layouts.login')

@section('content')

<ul>

   <p>フォローリスト</p>
@foreach ($list as $list)

    <li>
    <!-- フォローしているユーザーのアイコン一覧 -->
    @if (Auth::user()->isFollowing($list->id))
        <a href="/profile/{{$list->id}}/others-profile">
        <figure><img class="logo" src="{{ \Storage::url($list->images) }}"></figure>
        </a> 
    @endif
    </li>
@endforeach
</ul>
<ul>
@foreach ($followList as $followList)

    <li>
    @if (Auth::user()->isFollowing($followList->user_id)) 
        <a href="/profile/{{$list->id}}/others-profile">
        <figure><img class="logo" src="{{ \Storage::url($followList->images) }}"></figure>
        </a> 
        <p>{{ $followList->username }}：</p>   
        <p>{{ $followList->post }}：</p>   
    @endif
    </li>
    
@endforeach
</ul>

@endsection