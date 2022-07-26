@extends('layouts.login')

@section('content')


<div class="others-profile-contents">
    @foreach ($list as $list)
    @if ($list->id)
    <div><figure><img class="logo" src="{{ \Storage::url($list->images) }}"></figure></div>

    <ul class="others-profile-lists">
        <li><p class="others-profile-class">{{ Form::label('name') }}</p><p class="others-profile-class2">{{ $list->username }}</p></li>
        <li><p class="others-profile-class">{{ Form::label('bio') }}</p><p class="others-profile-class2">{{ $list->bio }}</p></li>
    </ul>

    
        <!-- ログインしているユーザーが他のユーザーをフォローしている時 -->
        @if (Auth::user()->isFollowing($list->id))
        <div class="others-btn"><a class="unfollow-btn" href="/search/{{$list->id}}/unfollow">フォロー解除</a></div>        
        @else
        <div class="others-btn"><a class="follow-btn" href="/search/{{$list->id}}/follow">フォローする</a></div> 
        @endif
    
    @endif
    @endforeach
</div>

<ul>
@foreach ($followList as $followList)

@if ($followList->id)
<li class="follow-list-box"><figure><img class="logo" src="{{ \Storage::url($followList->images) }}"></figure>
<div><p>{{ $followList->username }}：</p><br><br>
<p>{{ $followList->post }}：</p>
</div> 
<p class="follow-created">{{ $followList->created_at }}</p> 

</li>
@endif

@endforeach
</ul>

@endsection