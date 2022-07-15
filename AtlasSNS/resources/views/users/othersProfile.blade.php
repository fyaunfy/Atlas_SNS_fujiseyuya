@extends('layouts.login')

@section('content')

<p>他のユーザーのプロフィール</p>


<table>
    @foreach ($images as $images)
    @if ($images->id)
    <tr>
    <td><figure><img class="logo" src="{{ \Storage::url($images->images) }}"></figure></td>
    <td>{{ $images->username }}:</td>
    <td>{{ $images->bio }}</td>
    
        <!-- ログインしているユーザーが他のユーザーをフォローしている時 -->
        @if (Auth::user()->isFollowing($images->id))
        <td><a href="/search/{{$images->id}}/unfollow">フォロー解除</a></td>        
        @else
        <td><a href="/search/{{$images->id}}/follow">フォローする</a></td> 
        @endif
    
    </tr>
    @endif
    @endforeach
</table>


@foreach ($list as $list)
<table>
@if ($list->user_id)
<tr>
<td><figure><img class="logo" src="{{ \Storage::url($list->images) }}"></figure></td>
<td><p>{{ $list->username }}：</p></td> 
<td><p>{{ $list->post }}：</p></td> 
</tr>
@endif
</table>
@endforeach


@endsection